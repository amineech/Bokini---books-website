<?php 

    // check if the provided reset code is valid 

    session_start();

    // database
    include('../database_auth/database_auth.php');

    include('../functions.php');

    if(isset($_POST['check']) ) {
        //data from the form 
        $reset_code = trim($_POST['reset_code']);
        $email = $_POST['email'];

        if(!filter_var($reset_code, FILTER_VALIDATE_INT)) {
            $_SESSION['error'] = 'Enter your reset code please';
            $_SESSION['email'] = $email;
            redirect("../code-retrieve.php?email=$email"); 
        } else {
            $sql = $mysql->prepare('select * from user where email = ? and reset_code = ?');
            $sql->bind_param('si', $email, $reset_code);
            $sql->execute();
            $row = $sql->get_result();

            if(mysqli_num_rows($row) > 0) {
                // code is correct
                $user = $row->fetch_assoc();
                $sql = $mysql->prepare('update user set reset_code = 0 where idUser = ?');
                $sql->bind_param('i', $user['idUser']);
                $sql->execute();

                $email = $user['email'];
                $id = $user['idUser'];
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $email;
                redirect("../reset-password.php?id=$id&email=$email");
            } else {
                $_SESSION['error'] = 'Reset code incorrect';
                $_SESSION['email'] = $email;
                redirect("../code-retrieve.php?email=$email");
            }
        }
    }

?>