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
            $error_log = '{"Eror": '.$e.', "line": '.__LINE__.'}';
            file_put_contents('./includes/logs/category.txt', $error_log , FILE_APPEND );
        }

    }
}