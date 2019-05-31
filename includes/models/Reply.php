<?php

class Reply extends Model {
    public function addReply($replyData) {
        try{

        // echo '{"status":"1","message":"'.$replyData['content'].$replyData['user_id'].'"}';
        $db = $this->db;
        $sQuery = $db->prepare('INSERT INTO `comments` VALUES (NULL,:content,NULL,NULL,:topic_id,:user_id)');
        // Could not get the last inserted ID when using the stored procedure
        // The procedure code itself has to be updated somehow, but I didnt manage
        // to make it work. - PETER

        $sQuery->bindValue(':content', $replyData['content']);
        $sQuery->bindValue(':topic_id', $replyData['topic_id']);
        $sQuery->bindValue(':user_id', $replyData['user_id']);
        $sQuery->execute();
        if (!$sQuery->rowCount()) {
            echo '{"status": 0, "message": "Sorry, something went wrong when replying."}';
            exit;
        }
        return $db->lastInsertId();

        
        }catch(PDOException $error){
            // TODO: Insert Logger
            echo '{"status": 0, "message": "Are you sure you didn\'t alter the topic ID?"}';
            exit;
        }      
    }
}