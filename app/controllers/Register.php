<?php

use app\core\Controller;
use app\models\User;
use app\classes\Date;

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
                $user = new User();
                $user->setNome($_POST['nome']);
                $user->setEmail($_POST['email']);
                $user->setRa($_POST['ra']);
                $user->setCpf($_POST['cpf']);
                $user->setNascimento($_POST['nascimento']);
                $user->setDataDeCadastro(Date::atualDateAndHour());
                if($user->registerUser($_POST['ra'],$_POST['cpf'])){
                    $this->view("register/index", [
                        "success" => "Usuáro cadastrado com sucesso"
                    ]);
                }else{
                    $this->view("register/index", [
                        "success" => "Valores inválidos ou repetidos"
                    ]);
                }
            } else {
                $this->view("register/index", [
                    "error" => "Preencha com valores válidos"
                ]);
            }
        } else {
            $this->view("error404");
        }
    }

    public function subtmitByFile()
    {
        if(isset($_POST['arquivo'])){
            if($this->verifyInputFile($_POST['arquivo'])){

            }else{
                $this->view("register/index", [
                    "error"=>"Envie a planilha de excel"
                ]);
            }
        } else{
            $this->view("error404"); 
        }
    }

    private function verifyInputFile($arquivo)
    {
        return !empty($arquivo);
    }

    private function verifyInputsForm($nome, $email, $ra, $cpf, $nascimento)
    {
        if (!empty($nome) && !empty($email) && !empty($ra) && !empty($cpf) && !empty($nascimento)) {
            return true;
        }
    }
}