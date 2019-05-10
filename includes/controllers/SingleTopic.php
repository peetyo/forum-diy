<?php

class SingleTopic extends Controller
{
    public static function GetTopic()
    {
        //TODO: Catch if the ID is wrong!!!!

        // Get the ID of the topic, sanatize it
        if (!isset($_GET['id'])) {
            self::CreateView('error', '');
        }
        $iTopicId = $_GET['id'];


        // Check which page is it.
        if (!isset($_GET['page']) || $_GET['page'] == 0) {
            /*
             * OBS: Since we should always start with the page 1, not 0
             * Server is redirecting to the correct page number. s
             */
            $url = $_SERVER['REQUEST_URI'];
            header("location:$url&page=1");
        } else {
            $iPageNumber = $_GET['page'] - 1;
            $iOffset = 5 * $iPageNumber;
        }

        /*
         * Using the model Topics (I think it should
         * be just Topic.
         * And then executing get_topic() function
         * that returns an object, which
         * is saved in $objTopic
         */
        $topic = new Topics();
        $objTopic = $topic->get_topic($iTopicId, $iOffset);
        if ($objTopic == false) {
            self::CreateView('error', '');
        }

        // +1 since we're starting technically with 0 ;P
        $objTopic->currentPage = $iPageNumber + 1;

        /*
         * Current URL is for the pagination,
         * we shouldn't have the static variable since
         * the url might be changed
         * And since user might pass different variables, all we need
         * is just the base url with the id, right?
         */
        $objTopic->currentUri = $_SERVER['REQUEST_URI'];

        // uncomment one below to see what we receive.
        // btw, I recomment some JSON Viewer extension
        //echo json_encode($objTopic);
        //die();


        /*
         * Create a view, pass object.
         * OBS: View is created here instead of routes,
         * otherwise it be impossible/hard to pass additional variables/data
         * Thanks, Peter, for the solution ;)
         *
         */
        self::CreateView('single_topic', $objTopic);

    }

    public static function create_topic_view()
    {

        // Get categories from the database
        $categories = new Categories();
        $objCategories = $categories->get_categories();

        //echo json_encode($objCategories);
        //die;
        self::CreateView('create-topic', $objCategories);

    }

    public static function crete_topic(){

        // Validate all this input
        // NOTE: MATCH THE LENGTHS FROM THE DATABASE
        // $_POST['topic_name'] = 'Test Topic';
        Validation::checkInput($_POST['topic_name'],'string',5,255);
        
        // $_POST['category_id'] = 3;
        // NOTE: the form's option values are strings not integers 
        Validation::checkInput($_POST['category_id'],'string',1,2);
        
        $_POST['user_id'] = (int)$_SESSION['User']['id'] ;
        Validation::checkInput($_POST['user_id'],'integer','','');
        
        // $_POST['content'] = 'Test Topic Test Topic Test Topic Test Topic Test Topic';
        Validation::checkInput($_POST['content'],'string',10,500);
        
        //$token = $_POST['token'];
        $aTopicData = $_POST;
        // echo $aTopicData['topic_name']; works
      


        /*
         *  Pass the token in the function below
         */
       
//        if( BotValidation::Verify($token) == false){
//            echo "Token was invalid";
//            exit();
//        }
        $classTopic = new Topics();
        $classTopic->create_topic($aTopicData);

        /*
         * Please pass id in return as a JSON
         * Structure
         * {"status":1, "message":"optional message", "topic":346}
         * or, when error
         * {"status":0}
         */
    }
}
