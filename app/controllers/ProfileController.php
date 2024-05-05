<?php

use app\core\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $this->view('profile/index');
    }
}