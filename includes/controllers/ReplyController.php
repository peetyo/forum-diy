<?php


class ReplyController extends Controller
{
    public static function addReply()
    {
        //TODO: Catch if the ID is wrong!!!!

        // Get the ID of the topic, sanitize it
        if (!isset($_SESSION['User'])){
            echo '{"status":"0","message":"To add a reply, log in first."}';
            exit;
        }

        if (!hash_equals($_SESSION['key'], $_POST['token'])){
            echo '{"status":"0","message":"Invalid token"}';
            exit;
        }
        
        $_POST['user_id'] = (int)$_SESSION['User']['id'];
        $_POST['topic_id'] = (int)$_POST['topic_id'];
        Validation::checkInput($_POST['user_id'],'integer','','');
        Validation::checkInput($_POST['topic_id'],'integer','','');
        Validation::checkInput($_POST['content'],'string',5,'');
        
        $replyData = $_POST;
        $replyModel = new Reply();
        $newCommentId = $replyModel->addReply($replyData);
        
        $numberOfComments = $_POST['number_of_com'];
        $numberOfPages = ceil(($numberOfComments + 1) / 5);
        
        echo '{"status":"1","message":"Reply added", "location":"topic?id='.$_POST['topic_id'].'&page='.$numberOfPages.'&com='.$newCommentId.'"}';
        
        // echo '{"status":"0","message":"'.$username.'"}';
        // // PETER: Lame check if object topics is actually a string.
        // // the errors are returned as string. the successful response is 
        // // an array. The error responses should be updated and also 
        // //the way we handle them.
        // if(gettype($aTopics)== 'string'){
        //     self::CreateView('error', '');
        // }
        // $data = array();
        // $data['category-name'] = $aTopics[0]['category_name'];
        // $data['category-description'] = $aTopics[0]['category_description'];
        // $data['topics'] = $aTopics;
        // self::CreateView('category', $data);
        
    }
}