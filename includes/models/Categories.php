<?php

class Categories extends Model{
    public function get_categories(){
        try{
            $sQuery = $this->db->prepare('SELECT * FROM categories ');
            $sQuery->execute();
            $categories = $sQuery->fetchAll();
            if (count($categories)) {
                return $categories;
            }
        }catch (PDOException $e){
            date_default_timezone_set("Europe/Copenhagen");
            $error_log = '{"DATE":'.date("Y-m-d").', "TIME": '.date("h:i:sa").' ,"Eror": '.$e.', "line": '.__LINE__.'}';
            file_put_contents('./includes/logs/category.txt', $error_log , FILE_APPEND );
        }

    }
}