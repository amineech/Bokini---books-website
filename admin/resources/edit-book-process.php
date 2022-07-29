<?php 

    session_start();

    //database 
    include("../../database_auth/database_auth.php");

    include("../../functions.php");

    if(isset($_POST['edit'])) {
        //data from the form
        $b_id = $_POST['b_id'];
        $b_name = strtoupper(trim($_POST['b_name']));
        $b_year = trim($_POST['b_year']);
        $b_author = $_POST['b_author'];
        $b_category = $_POST['b_category'];
        $_b_description = trim($_POST['b_description']);

        //recommended field (false by default)
        $b_status = 0;
        if($_POST['status']){ 
            // if checkbox is checked => recommended is true
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
        $_SESSION['book_msg'] = ""; // where error messages are set

        if(intval($b_year) >  intval(date("Y"))) {
            $_SESSION['book_msg'] = 'year of the book is invalid !';
            $invalid = true;
        }

        if(!empty($image_extension)) { // if extension not empty (means that file not empty) 
            if($image_extension !== '.jpg' && $image_extension !== '.jpeg' && $image_extension !== '.png' ){
                if($_SESSION['book_msg'] === "") {
                    $_SESSION['book_msg'] = 'File type is invalid !';
                } else {
                    $_SESSION['book_msg'] .= '<br />File type is invalid !';   
                }            
                $invalid = true;
            }
        }

        if(empty($b_author) || empty($b_category)) {
            if($_SESSION['book_Msg'] === "") {
                $_SESSION['book_msg'] = 'Author and category are required !';
            } else {
                $_SESSION['book_msg'] .= '<br />Author and category are required !';
            }
            $invalid = true;
        }

        // check if some data is invalid 
        if($invalid) {
            $_SESSION['idB'] = $b_id;
            redirect("../edit-book.php?edit=$b_id");
        } else {
                if($_FILES['b_cover']['size']  !== 0){ // if a file is uploaded (new image)
                    //delete old image
                    $sql = $mysql->prepare("select * from book where idBook = ?");
                    $sql->bind_param('i', $b_id);
                    $sql->execute();
                    $row = $sql->get_result();
                    $book = $row->fetch_assoc();
                    $old_image = $book['cover'];
                    $old_image_path = $upload_dir . $old_image;
                    unlink($old_image_path);
        
                    //upload new image to the server
                    move_uploaded_file($_FILES['b_cover']['tmp_name'], $file); 
        
                    //store data in database
                    $sql = $mysql->prepare('update book set nameBook = ?, year = ?, cover = ?, description = ?, author = ?, category = ?, recommended = ? where idBook = ?');
                    $sql->bind_param('sissiiii', $b_name, $b_year, $image_name, $_b_description, $b_author, $b_category,  $b_status, $b_id);
                    $sql->execute();
                    $sql->close();
                    $mysql->close();

                } else { // no file is uploaded (preserve the old image) 
                    //store data in database
                    $sql = $mysql->prepare('update book set nameBook = ?, year = ?, description = ?, author = ?, category = ?, recommended = ? where idBook = ?');
                    $sql->bind_param('sisiiii', $b_name, $b_year, $_b_description, $b_author, $b_category,  $b_status, $b_id);
                    $sql->execute();
                    $sql->close();
                    $mysql->close();
                }

                $_SESSION['book_msg'] = 'Book edited successfully !';
                redirect('../index.php');
        }   
    }
?>