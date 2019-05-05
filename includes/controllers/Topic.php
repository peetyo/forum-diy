<?php

class Topic extends Controller
{
    public function GetTopic()
    {
        //TODO: Catch if the ID is wrong!!!!

        // Get the ID of the topic, sanatize it
        $iTopicId = $_GET['id'];
        // Check which page is it.
        if (!isset($_GET['page']) || $_GET['page'] == 0 ){
            /*
             * OBS: Since we should always start with the page 1, not 0
             * Server is redirecting to the correct page number. s
             */
            $url = $_SERVER['REQUEST_URI'];
            header("location:$url&page=1");
        } else {
            $iPageNumber = $_GET['page'] - 1 ;
            $iOffset = 5 * $iPageNumber;
        }
        // Make a call to the database
        $topic = new Model;
        // Make a SELECT statement here, prepare, and execute
        $sTopicContentQuery = $topic->db->prepare('CALL get_topic_by_id(:topicId)');
        $sTopicContentQuery->bindValue(':topicId', $iTopicId);
        $sTopicContentQuery->execute();
        $topicContent = $sTopicContentQuery->fetchAll();
        // closing the connection HOW? IS IT NEEDED?
        // $sTopicContentQuery = null;
        // check if anything was received
        if (count($topicContent)) {
            // Michal:  If the topic exists, now we retrieve comments
            $comments = new Model;
            $sCommentsQuery = $comments->db->prepare('CALL get_comments_for_the_topic(:topicId, :offset)');
            $sCommentsQuery->bindValue(':topicId', $iTopicId);
            $sCommentsQuery->bindValue(':offset', $iOffset);
            $sCommentsQuery->execute();
            $commentsContent = $sCommentsQuery->fetchAll();
            // closing the connection
            // $sCommentsQuery = null;
            if (count($commentsContent)) {
               // print_r($commentsContent);

                /*
                 * Currently, we have two objects -> $topicContent and $commentsContent
                 * Both are arrays
                 * I suggest merging them into one, so we can pass it as object expected by CreateView
                 */

                // Creating a passing object
                $objTopic = new stdClass();
                $paginationData = new stdClass();
                $objTopic->topicData = $topicContent;
                $objTopic->commentData = $commentsContent;
                // I need overall number of page and a current page


                echo json_encode($objTopic);
                die();

            }


        }
        else{
            echo 'error';
            die();
        }

        /*
         * Create a veiw, pass object.
         * OBS: View is created here instead of routes,
         * otherwise it be impossible/hard to pass additional variables/data
         * Thanks, Peter, for the solution ;)
         *
         */
        self::CreateView('topic', 'topic', '', $objTopic);

    }


}