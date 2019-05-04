<?php

class Topic extends Controller
{


    /**
     *
     */
    public function GetTopic()
    {
        // Get the ID of the topic, sanatize it
        $iTopicId = $_GET['id'];
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
            $sCommentsQuery = $comments->db->prepare('CALL get_comments_for_the_topic(:topicId)');
            $sCommentsQuery->bindValue(':topicId', $iTopicId);
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
                $objTopic =new stdClass();
                $objTopic->topicData = $topicContent;
                $objTopic->commentData = $commentsContent;

            }


        }

        self::CreateView('topic', 'topic', '', $objTopic);

    }


}