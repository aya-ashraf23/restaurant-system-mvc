<?php

namespace Aslam\Test\Controller;
use Aslam\Test\Model\Category as ModelCategory;
use Aslam\Test\View;

class Category{

    private $category;
    public function __construct(){
        $this->category = new ModelCategory;
    }
    public function allCategories(){
        $allCategories = $this->category->getAllCategories();
        View::Render('category.php', ['categoryList' => $allCategories]);
    }
    public function viewCategory($categoryId){
        $selectedCategory =$this->category->selectCategoryById($categoryId);
        View::Render('viewCategory.php',['selectedCategory' => $selectedCategory]);
    }
    public function deleteCategory($id){
        echo $this->category->deleteCategory($id);
    }
}