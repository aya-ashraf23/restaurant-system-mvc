<?php
namespace Aslam\Test\Controller;

use Aslam\Test\Model\Category;
use Aslam\Test\Model\Menu;
use Aslam\Test\View;

class Sales {
    private $savedCategories;
    private $savedMenus;
    public function __construct(){
        $this->savedCategories = new Category;
        $this->savedMenus = new Menu;
    }
    public function index(){
        $allCategories = $this->savedCategories->getAllCategories();
        $allMenus = $this->savedMenus->getAllMenus();
        View::render("sales.php" , ['allCategories' => $allCategories , 'allMenus' => $allMenus]);
    }
}