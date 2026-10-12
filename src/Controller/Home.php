<?php

namespace Aslam\Test\Controller;
use Aslam\Test\View;
class Home {
    public function showHome(){
        View::render("home.php");
    }
}