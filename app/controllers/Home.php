<?php

use app\core\Controller;
use app\models\User;

class Home extends Controller
{
    public function index()
    {
        $autorizathion = new User();
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