<?php

namespace app\classes;

class Session
{
    public static function start()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public static function destroy()
    {
        self::start();

        if(isset($_SESSION['userData'])){
            unset($_SESSION['userData']);
            session_destroy();
        }
    }

}