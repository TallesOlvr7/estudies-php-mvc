<?php

namespace app\models;

use app\core\Database;
use app\classes\Session;
use PDO;

class User
{
    private $nome;
    private $email;
    private $password;
    private $ra;
    private $cpf;
    private $nascimento;
    private $dataDeCadastro;
    private $userData;

    public function authenticate()
    {
        $db = new Database();
        $userLoginRequest = $db->executeQuerry(
            "SELECT * FROM usuarios WHERE usu_email = :email AND usu_senha = :password",
            array(
                'email' => $this->getEmail(),
                'password' => $this->getPassword()
            )
        );

        if ($userLoginRequest->rowCount() == 1) {
            $this->userData = $userLoginRequest->fetch(PDO::FETCH_ASSOC);
            return true;
        }
    }

    public function registerUser($ra,$cpf)
    {
        if ($this->verifyRa($ra) &&  $this->verifyCpf($cpf) && $this->getNascimento()) {
            $this->setFirstPassword($this->getCpf());

            $db = new Database();
            if (
                $register = $db->executeQuerry("INSERT INTO usuarios(usu_nome_completo,usu_email,usu_senha,usu_ra,usu_cpf,usu_data_nascimento,usu_data_de_criacao)VALUES(:nome,:email,:senha,:ra,:cpf,:dataNascimento,:dataDeCadastro)", array(
                    'nome' => $this->getNome(),
                    'email' => $this->getEmail(),
                    'senha' => md5($this->getPassword()),
                    'ra' => $this->getRa(),
                    'cpf' => md5($this->getCpf()),
                    'dataNascimento' => $this->getNascimento(),
                    'dataDeCadastro' => $this->getDataDeCadastro()
                )
                )
            )
                return true;
        }else{
            return false;
        }
    }

    private function verifyCpf($cpf)
    {
        $cpfSubmited = $cpf;
        $db = new Database();
        $getCpf = $db->executeQuerry("SELECT * FROM usuarios WHERE usu_cpf = :cpf", array(
            'cpf' => $cpfSubmited
        ));

        if ($getCpf->rowCount() < 1) {
            return false;
        }else{
            return true;
        }
    }

    private function verifyRa($ra)
    {
        $raSubmited = $ra;
        $db = new Database();
        $getRa = $db->executeQuerry("SELECT * FROM usuarios WHERE usu_ra = :ra", array(
            'cpf' => $raSubmited
        ));

        if ($getRa->rowCount() < 1) {
            return false;
        }else{
            return true;
        }
    }

    public function typeVerify($type)
    {
        if ($type == "Secretaria") {
            return true;
        } else {
            return false;
        }
    }

    public function loggedVerify()
    {
        Session::start();
        if (!isset($_SESSION['userData'])) {
            return true;
        }
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setFirstPassword($cpf)
    {
        $cpfLimpo = trim($cpf);
        $cpfLimpo = str_replace(array('.', '-', '/'), "", $cpfLimpo);
        $this->password = $cpfLimpo . "sp";
    }

    public function setRa($ra)
    {
        $this->ra = $ra;
    }

    public function setCpf($cpf)
    {
        if (mb_strlen($cpf) == 13) {
            $this->cpf = $cpf;
        } else {
            $this->cpf = false;
        }

    }

    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }

    public function setDataDeCadastro($dataDeCadastro)
    {
        $this->dataDeCadastro = $dataDeCadastro;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRa()
    {
        return $this->ra;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function getDataDeCadastro()
    {
        return $this->dataDeCadastro;
    }

    public function getUserData()
    {
        return $this->userData;
    }
}