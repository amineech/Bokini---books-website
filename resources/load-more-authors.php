<?php 

    // database
    include('../database_auth/database_auth.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // get data from ajax post request
        $last_idAuthor = $_POST['last_idAuthor'];

        // get data from database
        $sql = $mysql->prepare('select * from author where idAuthor > ? order by idAuthor asc limit 5');
        $sql->bind_param('i', $last_idAuthor);
        $sql->execute();
        $authors = $sql->get_result();

        $result = '';

        // display data
        if(mysqli_num_rows($authors) > 0){
            while($row = $authors->fetch_array()){

                // store last idAuthor
                $last_Author = $row['idAuthor'];

                // display query result content (more authors if there is any)
                $result .= '<div class="author">
                                <div class="author-image">
                                    <img src="authorsImgs/' . $row['image'] . '" alt="Author Image">
                                    <div class="hidden-infos">
                                        <h4> ' . $row['firstname'] . ' ' . $row['lastname'] . '</h4>
                                    </div>
                                </div>
                                <div class="outer-show">
                                    <a href="author-overview.php?id=' . $row['idAuthor'] . '">Overview</a>
                                </div>
                            </div>';
            }

            // adding load more button again
            $load = '<div class="load-more-auth">
                        <!-- the input contain the id of the last displayed author -->
                        <button class="load-more-btn">Load more</button>
                        <input type="hidden" value="' . $last_Author . '" class="val_idAuthor">
                    </div>';
        
        
            // create array from result
            $json_response['authors'] = $result;
            $json_response['load'] = $load;

        } else {
            $json_response['authors'] = [];
        }

        // json response on ajax request
        echo json_encode($json_response);

    }

?>