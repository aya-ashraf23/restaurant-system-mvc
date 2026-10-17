<?php

namespace Aslam\Test\Controller;
use Aslam\Test\Model\Menu as ModelMenu;
use Aslam\Test\View;

class Menu{
    private $menu;
    public function __construct(){
        $this->menu = new ModelMenu;
    }
    public function allMenus(){
        $allMenus = $this->menu->getAllMenus();
        View::Render('menus.php', ['menuList' => $allMenus]);
    }
    public function viewMenu($MenuId){
        $selectedMenu =$this->menu->selectMenuById($MenuId);
        View::Render('viewMenu.php',['selectedMenu' => $selectedMenu]);
    }
  
}