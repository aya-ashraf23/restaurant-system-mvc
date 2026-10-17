<?php
namespace Aslam\Test\Model;

use Aslam\Test\public\Model;

class Menu extends Model{

    protected $tableName = "menu_list";

    public function getAllMenus(){
        $query = "SELECT * FROM $this->tableName WHERE status = 1 AND delete_flag = 0 ORDER BY name ASC";
        $this->query($query);
        return $this->resultSet();
    }
    public function selectMenuById($id){
        $query = "SELECT * FROM $this->tableName WHERE id = $id";
        $this->query($query);
        return $this->single();
    }
}