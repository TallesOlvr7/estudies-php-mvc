<?php

use app\core\Controller;
use app\classes\Session;

class Home extends Controller
{
    public function index()
    {
        Session::start();
        if(!isset($_SESSION['userData'])){
            header("Location: /login");
        }else{
            $userInfo = $_SESSION['userData'];
            $userType = $userInfo['usu_tipo'];

            $this->typeVerify($userType);
        }
    }

    private function typeVerify($type)
    {
        if($type == "Secretaria"){
            return $this->view("home/adm");
        }else{
            return $this->view("home/index");
        }
    }
}