<?php

namespace app\classes;
use app\classes\Session;

class Authorization
{
    public function typeVerify($type)
    {
        if($type == "Secretaria"){
            return true;
        }else{
            return false;
        }
    }
    
    public function loggedVerify()
    {
        Session::start();
        if(!isset($_SESSION['userData'])){
            return true;
        }
    }
}