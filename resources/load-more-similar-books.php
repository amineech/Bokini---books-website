<?php

    // load more books with same category

    //database
    include('../database_auth/database_auth.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // get data from ajax post request
        $last_id = $_POST['last_id'];
        $chosen_idBook= $_POST['chosen_idBook'];
        $last_category = $_POST['last_category'];

        // get data from database
        $books = $mysql->prepare('select * from book where idBook > ? and idBook not in (?) and category = ? order by idBook asc limit 5 ');
        $books->bind_param('iii', $last_id, $chosen_idBook, $last_category);
        $books->execute();
        $loaded_books = $books->get_result();
        $result = '';

        //display data
        if(mysqli_num_rows($loaded_books) > 0) { 
            while($row = $loaded_books->fetch_array()) {

                // store last id book and its category
                $last_id = $row['idBook'];
                $last_category = $row['category'];

                //display query result content (more books if there is any)
                $result .= '
                            <div class="book">
                                <div class="book-image">
                                    <img src="booksImgs/' . $row["cover"] . '" alt="Book Cover">
                                    <div class="hidden-infos">
                                        <h4>'. $row["nameBook"] . '</h4>
                                        <h4>' . $row["year"] . '</h4>
                                    </div>
                                </div>
                                <div class="outer-show">
                                    <a href="book-details.php?id=' . $row['idBook'] . '">Show more</a>
                                </div>
                            </div>';
            }

            //adding the load more button again
            $load = '<div class="load-more2">
                        <button class="load-more-btn">Load more</button>
                        <input type="hidden" value="' . $last_id . '" class="val_idBook"> 
                        <input type="hidden" value="' . $chosen_idBook . '" class="val_chosenBook"> 
                        <input type="hidden" value="' . $last_category . '" class="val_categoryBook"> 
                    </div>';

            // create an array from the result
            $json_response['items'] = $result;
            $json_response['load'] = $load;
    
        } else {
            $json_response['items'] = [];
        }

        // json response on the ajax request
        echo json_encode($json_response);
    }

?>
