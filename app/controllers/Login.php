<?php

use app\core\Controller;
use app\models\User;

class Login extends Controller
{

    private $verifiedInfos;

    public function __construct()
    {
        $this->verifiedInfos = false;

    }

    private function getVerified()
    {
        return $this->verifiedInfos;
    }

    private function verify($email, $password)
    {
        if (!empty($email) && !empty($password)) {
            $this->verifiedInfos = true;
        }
    }
    public function sigin()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $user = new User();
            $this->verify($_POST['email'], $_POST['password']);
            if ($this->getVerified() == true) {
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $this->view("login/sigin", [
                    'email' => $user->getEmail(),
                    'password' => $user->getPassword()
                ]);
            } else {
                $this->view('login/index', [
                    'error' => 'E-mail ou Senha não foram inseridos'
                ]);
            }
        }else{
            $this->view('login/index');
        }
    }
    public function index()
    {
        $this->view("login/index");
    }
}