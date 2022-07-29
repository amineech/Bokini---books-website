<?php 
    session_start();

    //database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if(isset($_POST['edit'])){
        //get data from the form
        $id_auth = $_POST['id'];
        $f_name = strtoupper(trim($_POST['firstname']));
        $l_name = strtoupper(trim($_POST['lastname']));
        $description = trim($_POST['description']);

        //upload infos
        $upload_dir = '../../authorsImgs/';
        $random_number = "img-" . str_eight_random();
        $file = $upload_dir . "$random_number-" . basename($_FILES['image']['name']);
        $image_extension = file_extension($_FILES['image']['name']);
        $image_name = "$random_number-" . $_FILES['image']['name'];

        //data validation
        if(!empty($image_extension)) { // if extension not empty (means that file not empty)
            if($image_extension !== '.jpg' && $image_extension !== '.jpeg' && $image_extension !== '.png' ){
                    $_SESSION['auth_msg'] = 'File type is invalid !';   
                    redirect("../edit-author.php?edit=$id_auth");
            }
        }

        //if image is uploaded => delete old image and store new one along with other author data
        if($_FILES['image']['size'] !== 0) { 
            //delete old image
            $sql = $mysql->prepare("select * from author where idAuthor = ?");
            $sql->bind_param('i', $id_auth);
            $sql->execute();
            $row = $sql->get_result();
            $author = $row->fetch_assoc();
            $old_image = $author['image'];
            $old_image_path = $upload_dir . $old_image;
            unlink($old_image_path);

            //upload new image to the server
            move_uploaded_file($_FILES['image']['tmp_name'], $file);

            //update author
            $sql = $mysql->prepare('update author set firstname = ?, lastname = ?, description = ?, image = ? where idAuthor = ?');
            $sql->bind_param("ssssi", $f_name, $l_name, $description, $image_name, $id_auth);
            $sql->execute();
            $sql->close();
            $mysql->close();
        
        } else { // if image not uploaded update just other author data
            //update author
            $sql = $mysql->prepare('update author set firstname = ?, lastname = ?, description = ? where idAuthor = ?');
            $sql->bind_param("sssi", $f_name, $l_name, $description, $id_auth);
            $sql->execute();
            $sql->close();
            $mysql->close();
        }

        $_SESSION['auth_msg'] = 'Author edited successfully !';
        redirect("../authors.php");
    }
?>