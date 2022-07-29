<?php 

    // database
    include('../database_auth/database_auth.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //data from post request
        $chosen_article = $_POST['chosen_article'];
        $last_article = $_POST['last_idArticle'];

        //query the database
        $sql = $mysql->prepare('select * from articles where idArticle not in(?) and idArticle < ? order by created_at desc, idArticle desc limit 2');
        $sql->bind_param('ii', $chosen_article, $last_article);
        $sql->execute();
        $rows = $sql->get_result();
    
        if(mysqli_num_rows($rows) > 0){
            // display data 
            $result = '';
            while($article = $rows->fetch_array()){

                // store the id of the last displayed article 
                $last_id = $article['idArticle'];

                // display query result content (other articles if there is any)
                $result .= '<div class="title-o">
                                <h4>' .
                                    $article['title'] .
                                '</h4>
                                <div class="read-more">
                                    <a href="article.php?id=' . $article['idArticle'] . '">Read more</a>
                                </div>
                            </div>';
            }
            $load = '<div class="load-more">
                        <button class="load-more-btn">Load more</button>
                        <input type="hidden" value="' . $chosen_article . '" class="chosen_article">
                        <input type="hidden" value="' . $last_id . '" class="val_last_idArticle">
                    </div>';
                
            // create array from the result
            $json_response['articles'] = $result;
            $json_response['load'] = $load;

        } else {
            $json_response['articles'] = [];
        }

        echo json_encode($json_response);
    }
?>