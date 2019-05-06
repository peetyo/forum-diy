<?php


class Topics extends Model
{
    public function get_topic($iTopicId, $iOffset){
        // Make a call to the database
        $topic = new Model;
        // Make a SELECT statement here, prepare, and execute
        $sTopicContentQuery = $topic->db->prepare('CALL get_topic_by_id(:topicId)');
        $sTopicContentQuery->bindValue(':topicId', $iTopicId);
        $sTopicContentQuery->execute();
        $topicContent = $sTopicContentQuery->fetch();
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

                return $objTopic;
                //echo json_encode($objTopic);
                //die();

            }


        }
        else{
            echo 'error';
            die();
        }
    }
}