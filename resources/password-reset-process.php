<?php 

    // update password

    session_start();

    //database
    include('../database_auth/database_auth.php');

    include("../functions.php");

    if(isset($_POST['submit'])) {
        //data from the form
        $password = trim($_POST['new_pass']);
        $confirm_pass = trim($_POST['confirm_pass']);
        $id_user = $_POST['id_user'];

        // //get user
        $sql = $mysql->prepare('select * from user where idUser = ?');
        $sql->bind_param('i', $id_user);
        $sql->execute();
        $row = $sql->get_result();

        // user infos
        $user = $row->fetch_assoc();
        $id = $user['idUser']; 
        $email = $user['email']; 

        //data validation
        if($password !== $confirm_pass) {
            $_SESSION['error'] = 'Confirmation password is incorrect';
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            redirect("../reset-password.php?id=$id&email=$email");
        }
        if(strlen($password) < 6) {
            $_SESSION['error'] = 'Password should be more than 6 characters';
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            redirect("../reset-password.php?id=$id&email=$email");
        }
        if(strlen($password) > 15) {
            $_SESSION['error'] = 'Password should be less than 15 character';
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            redirect("../reset-password.php?id=$id&email=$email");
        }

        // update password
        $sql = $mysql->prepare('update user set password = PASSWORD(?) where idUser = ?');
        $sql->bind_param('si', $password, $id);

        if($sql->execute()) {
            $_SESSION['success'] = 'Password changed successfully';
            $_SESSION['prev_email'] = $email;
            redirect('../login.php');
        } else {
            $_SESSION['error'] = 'something went wrong, try again';
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            redirect("../reset-password.php?id=$id&email=$email");
        }
    }
?>