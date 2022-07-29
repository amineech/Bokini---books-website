<?php 
    // database
    include('../database_auth/database_auth.php');

    include('../functions.php');

    session_start();

    if(isset($_POST['send'])){

        // data from the form
        $firstname =  strtoupper(trim($_POST['firstname']));
        $lastname = strtoupper(trim($_POST['lastname']));
        $email = trim($_POST['email']);
        $tel = $_POST['tel'];
        $message = $_POST['message'];

        // data validation
        if(strlen($firstname) > 30 ||
           strlen($lastname) > 30 || 
           strlen($email) > 50 || 
           strlen($tel) > 15 || 
           !filter_var(intval($tel), FILTER_VALIDATE_INT) || 
           !filter_var($email, FILTER_VALIDATE_EMAIL) ||
           strlen($message) > 200) 
        {
            $_SESSION['msg'] = 'Invalid data entered !';
        } else {
            //send email
            $to = "amineech10@gmail.com"; // email to receive form messages 
            $subject = "Bokini - Contact: $firstname $lastname"; 
            $body = "Tel: $tel\nEmail: $email\nMessage:\n$message";
            $headers ="From: $email";
            if(mail($to, $subject, $body, $headers)) {
                $_SESSION['msg'] = 'your message is sent successfully !';
            } else {
                $_SESSION['msg'] = 'Something went wrong, try again';
            }
        }

        //redirect to contact form
        redirect('../contact.php');
    }

?>