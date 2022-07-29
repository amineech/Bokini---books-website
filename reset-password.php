<?php

    // page: reset password and save

    session_start();

    include('functions.php');

    if(isset($_SESSION['id']) && isset($_SESSION['email'])) {
?>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Main CSS File -->
        <link rel="stylesheet" href="public/css/style.css"/>
        <!-- Rendering All Elements Normal-->
        <link rel="stylesheet" href="public/css/normalize.css"/>
        <!-- Font Awesome Library-->
        <link rel="stylesheet" href="public/css/all.min.css"/>
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;300;400;500;600;700;800;900&display=swap" 
            rel="stylesheet"
        /> 
        <!-- animate on scroll library -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <!-- jquery -->
        <script src="public/js/jquery-3.6.0.min.js"></script>
        <!--  -->
        <title>Bokini - Password reset</title>
    </head>
    <body>
        <!-- nav bar -->
        <?php
            include('includes/nav-bar.php');
        ?>
        <div class="login-form">
            <div class="title">
                <h4>.Password reset.</h4>
            </div>
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="Error">
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php 
                    unset($_SESSION['error']);
                } 
            ?>
            <form action="resources/password-reset-process.php" method="POST" autocomplete="off">
                <input type="password" name="new_pass" placeholder="Enter your new password..." required>
                <input type="password" name="confirm_pass" placeholder="Confirm password..." required>
                <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="id_user">
                <input type="submit" value="Submit" name="submit">
            </form>
        </div>

        <!-- javascript file -->
        <script src="public/js/script.js?v=<?php echo time(); ?>"></script>
    </body>
    </html>
<?php 
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    } else {
        redirect('email-retrieve.php');
    }
?>