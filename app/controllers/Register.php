<?php

use app\core\Controller;
use app\models\User;

class Register extends Controller
{
    public function index()
    {
        $autorizathion = new User();
        if ($autorizathion->loggedVerify()) {
            header("Location: /login");
        } else {
            $userInfo = $_SESSION['userData'];
            $userType = $userInfo['usu_tipo'];
            if ($autorizathion->typeVerify($userType)) {
                $this->view("register/index");
            } else {
                $this->view('error404');
            }
        }

    }

    public function submit()
    {
        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['ra']) && isset($_POST['cpf']) && isset($_POST['nascimento'])) {
            if ($this->verifyInputsForm($_POST['nome'], $_POST['email'], $_POST['ra'], $_POST['cpf'], $_POST['nascimento'])) {

            } else {
                $this->view("register/index", [
                    "error" => "Preencha com valores válidos"
                ]);
            }
        } else {
            $this->view("error404");
        }
    }

    private function verifyInputsForm($nome, $email, $ra, $cpf, $nascimento)
    {
        if (!empty($nome) && !empty($email) && !empty($ra) && !empty($cpf) && !empty($nascimento)) {
            return true;
        }
    }
}