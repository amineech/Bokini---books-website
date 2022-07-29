<?php 

    session_start();

    include("../database_auth/database_auth.php");

    include('../functions.php');

    if(isset($_POST['login'])) {
        // data from the form
        $email = $_POST['email'];
        $password = $_POST['psw'];

        $sql = $mysql->prepare('select * from user where email = ?');
        $sql->bind_param('s', $email);
        $sql->execute();
        $row = $sql->get_result();

        if(mysqli_num_rows($row) > 0){

            $sql2 = $mysql->prepare('select * from user where password = PASSWORD(?)');
            $sql2->bind_param('s', $password);
            $sql2->execute();
            $row = $sql2->get_result();

            if(mysqli_num_rows($row) > 0) {
                // email and password are correct
                $user = $row->fetch_assoc();
                $_SESSION['id'] = $user['idUser'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                redirect('../admin/index.php');

            } else {
                // password incorrect
                $_SESSION['prev_email'] = $email;
                $_SESSION['error'] = 'Email or password incorrect';
                redirect('../login.php');
            }
        } else {
            // email incorrect
            $_SESSION['prev_email'] = $email;
            $_SESSION['error'] = 'Email or password incorrect';
            redirect('../login.php');
        }
    }

?>