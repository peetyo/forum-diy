<?php

class Categories extends Model{
    public function get_categories(){
        $sQuery = $this->db->prepare('SELECT * FROM categories ');
        $sQuery->execute();
        $categories = $sQuery->fetchAll();
        if (count($categories)) {
            return $categories;
        }
    }
}