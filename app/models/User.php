<?php

namespace app\models;

use app\core\Database;
use PDO;

class User 
{
    private $id;
    private $nomeCompleto;
    private $email;
    private $password;
    private $ra;
    private $cpf;
    private $dataNascimento;
    private $type;
    private $active;
    private $createDate;
    private $advertencia;

    public function setNome($name)
    {
        $this->nomeCompleto = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRa($ra)
    {
        $this->ra = $ra;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setCreateData($createDate)
    {
        $this->createDate = $createDate;
    }

    public function setAdvertencia($advertencia)
    {
        $this->advertencia = $advertencia;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function getAdvertencia()
    {
        return $this->advertencia;
    }
}
