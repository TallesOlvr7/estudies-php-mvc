<?php

namespace app\core;

//instanciar cada Model criado

class controller
{
    public function model($model)
    {
        require '../app/models/' . $model . '.php';
        $classe = 'app\\models\\' . $model;
        return new $classe();
    }

    public function view(string $view, $data = [])
    {
        require '../app/views/' . $view . '.php';
    }

    public function pageNotFound()
    {
        $this->view('error404');
    }
}