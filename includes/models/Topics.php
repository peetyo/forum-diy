<?php


class Topics extends Model
{
    public function get_topic($iTopicId, $iOffset){
        // Make a call to the database
        // Make a SELECT statement here, prepare, and execute
        $sTopicContentQuery = $this->db->prepare('CALL get_topic_by_id(:topicId)');
        $sTopicContentQuery->bindValue(':topicId', $iTopicId);
        $sTopicContentQuery->execute();
        $topicContent = $sTopicContentQuery->fetch();
        // check if anything was received
        if (count($topicContent)) {
            // Michal:  If the topic exists, now we retrieve comments
            // Closing cursor first is to close connection from above
            $sTopicContentQuery->closeCursor();
            $sCommentsQuery = $this->db->prepare('CALL get_comments_for_the_topic(:topicId, :offset)');
            $sCommentsQuery->bindValue(':topicId', $iTopicId);
            $sCommentsQuery->bindValue(':offset', $iOffset);
            $sCommentsQuery->execute();
            $commentsContent = $sCommentsQuery->fetchAll();
            // closing the connection
            // $sCommentsQuery = null;

            if (!empty($commentsContent)) {

                /*
                 * Currently, we have two objects -> $topicContent and $commentsContent
                 * Both are arrays
                 * I suggest merging them into one, so we can pass it as object expected by CreateView
                 */

                // Creating a passing object
                $objTopic = new stdClass();
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

                // Again, closing the connection from abote
                $sCommentsQuery->closeCursor();
                $sNumberOfCommentsQuery = $this->db->prepare('CALL get_number_of_comments(:topicId)');
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
                $objTopic->whats = $topicContent;
                return $objTopic;

            }


        }
        else{
           return false;
        }
    }
    public function create_topic($topicData){
            try{
                $sQuery = $this->db->prepare('CALL create_topic(:topic_name, :category_id, :user_id, :content)');
                $sQuery->bindValue(':topic_name', $topicData['topic_name']);
                $sQuery->bindValue(':category_id', $topicData['category_id']);
                $sQuery->bindValue(':user_id', $topicData['user_id']);
                $sQuery->bindValue(':content', $topicData['content']);
                $sQuery->execute();
                if(!$sQuery->rowCount()){
                  echo "Sorry, something went wrong when creating topic.";
                  exit();
                }
                // Remember to update this echo once its paired with some AJAX
                echo "Topic created";
            }catch(PDOException $error){
                echo "Sorry, something went wrong. Try again later.";
                exit();
            }
    }

}