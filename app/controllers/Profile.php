<?php

use app\core\Controller;

class Profile extends Controller
{
    public function index()
    {
        $this->view('profile/index');
    }
}