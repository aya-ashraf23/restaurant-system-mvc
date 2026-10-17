<?php
namespace Aslam\Test\Model;
use Aslam\Test\public\Model;

class Category extends Model{

    protected $tableName = "category_list";

    public function getAllCategories(){
        $query = "SELECT * FROM $this->tableName WHERE status = 1 AND delete_flag = 0 ORDER BY id ASC";
        $this->query($query);
        return $this->resultSet();
    }
    public function selectCategoryById($id){
        $query = "SELECT * FROM $this->tableName WHERE id = $id";
        $this->query($query);
        return $this->single();
    }
    public function deleteCategory($id){
        $query = "DELETE FROM $this->tableName WHERE id = $id";
        $this->query($query);
        return $this->execute();
    }
    
}