<?php


class Category extends Controller
{
    public static function getCategory()
    {
        //TODO: Catch if the ID is wrong!!!!

        // Get the ID of the topic, sanatize it
        if (!isset($_GET['cat'])){
            header("location: index.php");
        }
        $sCategoryName = $_GET['cat'];

        $topics = new Topics();
        $objTopics = $topics->getTopicsFromCategory($sCategoryName);
      
        self::CreateView('category', '', '', $objTopics);
        
    }
}