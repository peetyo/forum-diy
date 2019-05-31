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
        echo '{"status":"1","message":"all good so far"}';

        // $replyModel = new Reply();
        // $aTopics = $topics->getTopicsFromCategory($iCategoryId);
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