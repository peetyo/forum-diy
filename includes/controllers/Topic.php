<?php

class Topic extends Controller{

//    public static $objTopic;

    public function GetTopic($topicId){
        $dupa = $_GET['dupa'];
        $topicName = "chuj";
        // Get the ID of the topic, sanatize it

//        // Make a call to the database
//        $topic = new Model;
//        // Make a SELECT statement here
//        $sTopicContentQuery = $topic->db->prepare('');
//        $topicContent = $sTopicContentQuery->fetchAll();
//        if ( count ($topicContent) ) {
//            whatever
//        }

        // fetch an object with all the info about the topic
        $objTopic=array("name"=>"test123","content"=>"testContent & test Content");
//        self::$objTopic = 'the fetched object';
//        echo $topicName;

        self::CreateView('topic','topic','', $objTopic);

    }



}