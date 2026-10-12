<?php

namespace Aslam\Test\Controller;
use Aslam\Test\Model\User;
use Aslam\Test\public\Request;
use Aslam\Test\public\Session;
use Aslam\Test\View;

class Login {
    private $loggingUser;
    public function __construct(){
        $this->loggingUser = new User;
    }
    public function showLogin(){
       View::render('login.php');
    }

    public function handleLogin(){
        $credentials = filter_input_array(INPUT_POST) ?: [];
        $checkedUser = $this->loggingUser->Login($credentials);
        if($checkedUser){
            $this->createUserSession($checkedUser);
            Session::setFlash('success', 'You have successfully logged in.');
            Request::redirect("home/showHome");
        }else{
            Session::setFlash('error', 'incorrect username or password');
            Request::redirect("login/showLogin");
        }
    }
    public function createUserSession($user){
        Session::setSession('user_id' , $user->id);
        Session::setSession('user_name' , $user->name);
    }
}