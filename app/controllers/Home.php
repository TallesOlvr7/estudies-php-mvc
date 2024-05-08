<?php

use app\core\Controller;
use app\classes\Session;
use app\classes\Authorization;

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
            $autorizzthion = new Authorization();

            if($autorizzthion->typeVerify($userType)){
                $this->view('home/adm');
            }else{
                $this->view('home/index');
            }
        }
    }


}