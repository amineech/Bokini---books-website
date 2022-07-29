<?php 

    session_start();

    //database
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if(isset($_POST['add'])){
        $b_name = strtoupper(trim($_POST['b_name']));
        $b_year = trim($_POST['b_year']);
        $b_description = trim($_POST['b_description']);
        $b_author = $_POST['b_author'];
        $b_category = $_POST['b_category'];

        //recommended field (false by default)
        $b_status = 0;
        if($_POST['status']){ 
            // if checkbox is checked => turn recommended to true
            $b_status = 1;
        }

        //upload infos
        $upload_dir = '../../booksImgs/';
        $random_number = "img-" . str_eight_random();
        $file = $upload_dir . "$random_number-" . basename($_FILES['b_cover']['name']);
        $image_extension = file_extension($_FILES['b_cover']['name']);
        $image_name = "$random_number-" . $_FILES['b_cover']['name'];

        //data validation
        $invalid = false;
        $_SESSION['book_msg'] = "";

        if(intval($b_year) >  intval(date("Y"))){
            $_SESSION['book_msg'] = 'year of the book is invalid !';
            $invalid = true;
        }

        if($image_extension !== '.jpg' && $image_extension !== '.jpeg' && $image_extension !== '.png'){
            if($_SESSION['book_msg'] === ""){
                $_SESSION['book_msg'] = 'File type is invalid !';
            } else{
                $_SESSION['book_msg'] .= '<br />File type is invalid !';   
            }            
            $invalid = true;
        }

        if(empty($b_author) || empty($b_category)){
            if($_SESSION['book_Msg'] === ""){
                $_SESSION['book_msg'] = 'Author and category are required !';
            } else{
                $_SESSION['book_msg'] .= '<br />Author and category are required !';
            }
            $invalid = true;
        }

        // check if some data is invalid 
        if($invalid){
            redirect("../add-book.php");
        } else{
            // upload image on the server
            if(move_uploaded_file($_FILES['b_cover']['tmp_name'], $file)){ // if file is uploaded successfully
                // store data in database
                $requete = $mysql->prepare('insert into book(nameBook, year, cover, description, author, category, recommended) values(?, ?, ?, ?, ?, ?, ?)');
                $requete->bind_param('sissiii', $b_name, $b_year, $image_name, $b_description, $b_author, $b_category, $b_status);
                $requete->execute();
                $requete->close();
                $mysql->close();

                $_SESSION['book_msg'] = 'Book added successfully !';
                redirect('../index.php');
            } else{
                $_SESSION['book_msg'] = 'We encountered a problem, please try again !';
                redirect("../add-book.php");
            }
        } 
    }

?>