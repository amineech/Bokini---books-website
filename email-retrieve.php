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

        // page: check if email exists in order to send password reset code per email

        session_start();

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
        <form action="resources/email-check.php" method="POST" autocomplete="off">
            <?php if(isset($_SESSION['prev_email'])) { ?>
                <input type="email" name="email" value="<?php echo $_SESSION['prev_email']; ?>" placeholder="Enter your email here..." required>
            <?php 
                unset($_SESSION['prev_email']);
            } else { ?>
                <input type="email" name="email" placeholder="Enter your email here..." required>
            <?php } ?>
            <input type="submit" value="send" name="send">
        </form>
    </div>

    <!-- javascript file -->
    <script src="public/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>