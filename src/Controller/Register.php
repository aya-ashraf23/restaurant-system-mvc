<?php

namespace Aslam\Test\Controller;
use Aslam\Test\View;
use Aslam\Test\Model\User;
use Aslam\Test\public\Request;
use Aslam\Test\public\Session;
use Aslam\Test\public\Validation;

class Register {
    private $newUser;
    public function __construct(){
        $this->newUser = new User;
    }
    public function showRegister(){
        View::render('register.php');
    }

    public function handleRegister(){
        $userData = filter_input_array(INPUT_POST) ?: [];
        foreach ($userData as $field => $value) {
            if (is_string($value) && $field !== 'password') {
                $userData[$field] = trim($value);
            }
        }

        $requiredFields = ['firstname', 'lastname', 'username', 'password'];
        $validationErrors = (new Validation())->validate($userData, $requiredFields);
        if ($validationErrors) {
            Session::setFlash('error', reset($validationErrors));
            Request::redirect('register/showRegister');
        }

        $username = trim($userData['username']);
        if ($this->newUser->findByUsername($username)) {
            Session::setFlash('error', 'That username is already in use.');
            Request::redirect('register/showRegister');
        }

        $hashed_password = password_hash($userData['password'], PASSWORD_BCRYPT);
        $user = [
            'firstname' => trim($userData['firstname']),
            'middlename' => trim($userData['middlename'] ?? ''),
            'lastname' => trim($userData['lastname']),
            'username' => $username,
            'password' => $hashed_password,
        ];

        if($this->newUser->Register($user)){
            Session::setFlash('success', 'Your account was created. You can now sign in.');
            Request::redirect('login/showLogin');
        }else{
            Session::setFlash('error', 'Your account could not be created. Please try again.');
            Request::redirect('register/showRegister');
        }
    }
}

 
