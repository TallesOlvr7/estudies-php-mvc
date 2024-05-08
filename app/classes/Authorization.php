<?php

namespace app\classes;

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
}