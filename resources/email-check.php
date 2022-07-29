<?php 

    // check if email exists in database and send reset code per email

    session_start();

    // database
    include('../database_auth/database_auth.php');

    include('../functions.php');

    if(isset($_POST['send'])) {
        
        // data from he form
        $email = trim($_POST['email']);

        $sql = $mysql->prepare('select * from user where email = ?');
        $sql->bind_param('s', $email);
        $sql->execute();
        $row = $sql->get_result();
        if(mysqli_num_rows($row) > 0) {
            // email exists 
            $user = $row->fetch_assoc();
            // random reset code
            $random_reset_code = rand(100000, 1000000);
            // set mail params
            $to = $email;
            $subject = "Bokini - Password reset";
            $body = "Hi, this is your password reset code: $random_reset_code";
            $headers = "From:amineech10@gmail.com";

            //send mail
            if (mail($to, $subject, $body, $headers)) {
                // mail sent
                $sql = $mysql->prepare('update user set reset_code = ? where idUser = ?');
                $sql->bind_param('ii', $random_reset_code, $user['idUser']);
                $sql->execute();
                $mail = $user['email'];
                $_SESSION['success'] = 'Reset code is sent to your email';
                $_SESSION['email'] = $mail;
                redirect("../code-retrieve.php?email=$mail");
            } else {
                // mail sending failed
                $_SESSION['error'] = 'Email not sent, try again !';
            }
            redirect('../email-retrieve.php');
        } else {
            $_SESSION['error'] = 'Email does not exist';
            redirect('../email-retrieve.php');
        }
    }
?>