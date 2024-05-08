<?php

use app\core\Controller;
use app\classes\Session;
use app\classes\Authorization;

class Home extends Controller
{
    public function index()
    {
        $autorizathion = new Authorization();
        Session::start();
        if($autorizathion->loggedVerify()){
            header("Location: /login");
        }else{
            $userInfo = $_SESSION['userData'];
            $userType = $userInfo['usu_tipo'];
            if($autorizathion->typeVerify($userType)){
                $this->view('home/adm');
            }else{
                $this->view('home/index');
            }
        }
    }


}