<?php
namespace Aslam\Test\Model;

use Aslam\Test\public\Model;
use Aslam\Test\public\Request;

class User extends Model {
    protected $tableName = 'users';

    public function findByUsername($userData){
        $query = "SELECT * FROM $this->tableName where username = :username";
        $this->query($query);
        $this->bind(':username' , $userData);
        $row = $this->single();
        return !empty($row) ? true : false;

    }

    public function Register($user){
        $query ="INSERT INTO $this->tableName (firstname , middlename , lastname , username , password) 
        VALUES (:firstname , :middlename , :lastname , :username , :password)";
        $this->query($query);
        $this->bind(':firstname' , $user['firstname']);
        $this->bind(':middlename' , $user['middlename']);
        $this->bind(':lastname' , $user['lastname']);
        $this->bind(':username' , $user['username']);
        $this->bind(':password' , $user['password']);
        return $this->execute() ? true : false ;
    }

    public function Login ($credentials){
        $query = "SELECT * FROM $this->tableName where username = :username";
        $this->query($query);
        $this->bind(':username' , $credentials['username']);
        $row = $this->single();   //this is user's data coming from DB
        if($row){
            $hashed_password = $row->password;
            $plain_password = $credentials['password'];
            if(password_verify($plain_password, $hashed_password)){
                return $row;
            }else return false;
        }else{
            return false;
        }
    }
}