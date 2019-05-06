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

                /*
                 * Calculate number of pages by dividing total
                 * number of pages by number of results, which is 5
                 * If you want to change that, please contact
                 * the database administrator ;)
                 * AKA change in the routines
                 *
                 * So I figured that count($commentsContent) is always returning 5...
                 * obviously, therefore I need to make another quick call to the database
                 * to ask how many comments there are
                 *
                 * IF YOU HAVE ANOTHER IDEA, YOU'RE WELCOME TO TRY IT OUT
                 *
                 */

                $numberOfComments = new Model;
                $sNumberOfCommentsQuery = $numberOfComments->db->prepare('CALL get_number_of_comments(:topicId)');
                $sNumberOfCommentsQuery->bindValue(':topicId', $iTopicId);
                $sNumberOfCommentsQuery->execute();
                /*
                 * That technically should return something since it passed
                 * check if any comments already.
                 */
                $numberOfComments = $sNumberOfCommentsQuery->fetch();
                $iNumberOfComments = $numberOfComments['totalComments'];

                $iNumberOfPages = ceil($iNumberOfComments/5);
                $objTopic->numberOfComments = $iNumberOfComments;
                $objTopic->numberOfPages = $iNumberOfPages;
                
                return $objTopic;

            }


        }
        else{
           return false;
        }
    }
}