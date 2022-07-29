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
    <title>Bokini - Login</title>
</head>
<body>
    <!-- nav bar -->
    <?php

        session_start();

        include('includes/nav-bar.php');
    
    ?>
    <div class="login-form">
        <div class="title">
            <h4>.Login.</h4>
        </div>
        <?php if(isset($_SESSION['success'])) { ?>
            <div class="success">
                <?php echo $_SESSION['success']; ?>
            </div>
        <?php 
                unset($_SESSION['success']);
            } 
        ?>
        <?php if(isset($_SESSION['error'])) { ?>
            <div class="Error">
                <?php echo $_SESSION['error']; ?>
            </div>
        <?php 
                unset($_SESSION['error']);
            } 
        ?>
        <form action="resources/login-process.php" method="POST" autocomplete="off">
            <?php if(isset($_SESSION['prev_email'])) { ?>
                <input type="email" name="email" value="<?php echo $_SESSION['prev_email']; ?>" placeholder="Email" required>
            <?php 
                unset($_SESSION['prev_email']);
            } else { ?>
                <input type="email" name="email" placeholder="Email" required>
            <?php } ?>
            <input type="password" name="psw" placeholder="Password" required>
            <input type="submit" value="login" name="login">
        </form>
        <div class="forgot_pass">
            <!-- forgotten passowrd link -->
            <a href="email-retrieve.php">forgot password ?</a>
        </div>
    </div>

    <!-- javascript file -->
    <script src="public/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>