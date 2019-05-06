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

        /*
         * Using the model Topics (I think it should
         * be just Topic.
         * And then executing get_topic() function
         * that returns an object, which
         * is saved in $objTopic
         */
        $topics = new Topics();
        $objTopics = $topics->getTopicsFromCategory($sCategoryName);

      
        self::CreateView('category', '', '', $objTopics);

    }


}