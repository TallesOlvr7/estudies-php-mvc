<?php

namespace app\models;

use app\core\Database;
use PDO;

class User 
{
    private $email;
    private $password;
    private $userData;
   
    public function authenticate($email,$password)
    {
        $db = new Database();
        $userLoginRequest = $db->executeQuerry("SELECT * FROM usuarios WHERE usu_email = :email AND usu_senha = :password",array(
            'email'=>$email,
            'password'=>$password
        ));

        if($userLoginRequest->rowCount() == 1){
            $this->userData = $userLoginRequest->fetch(PDO::FETCH_ASSOC);
            return true;
        }
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUserData()
    {
        return $this->userData;
    }
}