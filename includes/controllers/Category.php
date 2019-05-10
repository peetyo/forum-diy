<?php


class Category extends Controller
{
    public static function getCategory()
    {
        //TODO: Catch if the ID is wrong!!!!

        // Get the ID of the topic, sanitize it
        if (!isset($_GET['cat'])|| $_GET['cat'] == null || $_GET['cat'] == 0){
            header("location: index.php");
        }

        $iCategoryId = $_GET['cat'];

        $topics = new Topics();
        $aTopics = $topics->getTopicsFromCategory($iCategoryId);
        // PETER: Lame check if object topics is actually a string.
        // the errors are returned as string. the successful response is 
        // an array. The error responses should be updated and also 
        //the way we handle them.
        if(gettype($aTopics)== 'string'){
            self::CreateView('error', '');
        }
        $data = array();
        $data['category'] = $iCategoryId;
        $data['topics'] = $aTopics;
        self::CreateView('category', $data);
        
    }
}