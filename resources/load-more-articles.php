<?php 

    // database
    include('../database_auth/database_auth.php');

    include('../functions.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // data from the request
        $last_idArticle = $_POST['last_idArticle'];

        // get data from database
        $sql = $mysql->prepare('select * from articles where idArticle < ? order by created_at desc, idArticle desc limit 6');
        $sql->bind_param('i', $last_idArticle);
        $sql->execute();
        $articles = $sql->get_result();

        if(mysqli_num_rows($articles) > 0) {
            // display data
            $result = '';
            while($article = $articles->fetch_array()) {

                // store last_idArticle
                $last_id = $article['idArticle'];

                // display query result content (more articles if there is any)
                $result .=  '<div class="article">
                                <div class="title">
                                    <h2>
                                        <!-- article title --> ' .
                                            (strlen($article['title']) > 25 ? (cut_title($article['title']) . '...') : $article['title']) .
                                    '</h2>
                                </div>
                                <div class="text-description">
                                    <p>
                                        <!-- article content -->' .
                                            (strlen($article['description']) > 120 ? cut_article($article['description']) : $article['description']) .
                                    '</p>
                                    <div class="read-more">
                                        <a href="article.php?id=' . $article['idArticle'] . '">Read more</a>
                                    </div>
                                </div>
                            </div>';
            }

            // add load more button
            $load = '<div class="load-more">
                        <button class="load-more-btn">Load more</button>
                        <input type="hidden" value="' . $last_id . '" class="val_idArticle">
                    </div>';

            // create array from the result
            $json_response['articles'] = $result;
            $json_response['load'] = $load;

        } else {
            $json_response['articles'] = [];
        }

        // json response
        echo json_encode($json_response);
    }
?>