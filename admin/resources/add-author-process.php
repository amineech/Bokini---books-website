<?php 
    session_start();

    // database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if(isset($_POST['add'])){
        $f_name = strtoupper(trim($_POST['firstname']));
        $l_name = strtoupper(trim($_POST['lastname']));
        $description = trim($_POST['description']);
        
        // upload infos
        $upload_dir = '../../authorsImgs/';
        $random_number = "img-" . str_eight_random();
        $file = $upload_dir . "$random_number-" . basename($_FILES['image']['name']);
        $image_extension = file_extension($_FILES['image']['name']);
        $image_name = "$random_number-" . $_FILES['image']['name'];
        
        // check the extension of the image
        if($image_extension !== '.jpg' && $image_extension !== '.png' && $image_extension !== '.jpeg'){
            $_SESSION['auth_msg'] = 'File type is invalid !';
            redirect('../add-author.php');
        } else{
            //upload the image on the server
            if(move_uploaded_file($_FILES['image']['tmp_name'], $file)){ // if file is uploaded successfully
                    //store data in database
                    $requete = $mysql->prepare('insert into author(firstname, lastname, description, image) values(?, ?, ?, ?)');
                    $requete->bind_param('ssss', $f_name, $l_name, $description, $image_name);
                    $requete->execute();
                    $requete->close();
                    $mysql->close();
        
                    $_SESSION['auth_msg'] = 'Author added successfully !';
                    redirect('../authors.php');
            } else{
                $_SESSION['auth_msg'] = 'We encountered a problem, please try again !';
                redirect("../add-author.php");
            }
        }
    }


?>