<!DOCTYPE html>
<html lang="en">
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
    <title>Bokini - Contact</title>
</head>
<body>
    <?php
        session_start();
        include('includes/nav-bar.php');
    ?>
    <div class="contact">
        <form action="resources/contact_process.php" method="POST">
            <div class="contactus">
                <h4>Contact us</h4>
            </div>
            <div class="error">
                <h6>
                    <?php 
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                    ?>
                </h6>
            </div>
            <div class="line">
                <input type="text" name="firstname" placeholder="First name" require>
                <input type="text" name="lastname" placeholder="Last name" require>
            </div>
            <div class="line">
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="tel" placeholder="Telephone" required>
            </div>
            <div class="line">
                <textarea name="message" cols="20" rows="6" placeholder="Your message here..."></textarea>
            </div>
            <div class="line">
                <input class="submit" type="submit" value="Send" name="send">
            </div>
    </form>
    </div>

    <!-- footer -->
    <?php
        include('includes/footer.php');
    ?>
    
    <!-- js file -->
    <script src="public/js/script.js" ></script>
</body>
</html>