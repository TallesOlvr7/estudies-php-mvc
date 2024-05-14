<?php

namespace app\classes;

class Date
{
    public static function atualDateAndHour()
    {
        date_default_timezone_set('America/Sao_Paulo');
        return date("Y-m-d H:i:s");
    }
}