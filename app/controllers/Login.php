<?php

use app\core\Controller;
use app\classes\Session;
use app\models\User;

class Login extends Controller
{
    public function index()
    {
        $this->view("login/index");
    }
    
    public function sigin()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            if ($this->verify($_POST['email'], $_POST['password'])) {
                $user = new User();
                $user->setEmail($_POST['email']);
                $user->setPassword(md5(($_POST['password'])));
                if ($user->authenticate()) {
                    Session::start();
                    $_SESSION['userData'] = $user->getUserData();
                    header("Location: /");
                } else {
                    $this->view('login/index', [
                        'error' => 'E-mail ou senha incorretos'
                    ]);
                }
            } else {
                $this->view('login/index', [
                    'error' => 'E-mail ou senha não foram inseridos'
                ]);
            }
        } else {
            $this->view('login/index');
        }
    }

    public function logout()
    {
        Session::destroy();
        header("Location: /");
    }

    private function verify($email, $password)
    {
        if (!empty($email) && !empty($password)) {
            return true;
        }
    }
}