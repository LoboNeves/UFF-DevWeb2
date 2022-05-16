<?php

declare(strict_types=1);

namespace App\Model;

class Funcionario
{
    private $id, $nome, $cpf, $senha, $papel;

    public function getId (): int
    {
        return $this->id;
    }

    public function setId (int $id)
    {
        $this->id = $id;
    }

    public function getNome (): String
    {
        return $this->nome;
    }

    public function setNome (String $nome)
    {
        $this->nome = $nome;
    }

    public function getCpf (): String
    {
        return $this->cpf;
    }

    public function setCpf (String $cpf)
    {
        $this->cpf = $cpf;
    }

    public function getSenha (): String
    {
        return $this->senha;
    }

    public function setSenha (String $senha)
    {
        $this->senha = $senha;
    }

    public function getPapel (): String
    {
        return $this->papel;
    }

    public function setPapel (String $papel)
    {
        $this->papel = $papel;
    }
}
