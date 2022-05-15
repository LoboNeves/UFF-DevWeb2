<?php

declare(strict_types=1);

namespace App\Model;

class Cliente
{
    private $id, $nome, $cpf, $endereco, $bairro, $cidade, $uf, $cep, $telefone, $email;

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

    public function getEndereco (): String
    {
        return $this->endereco;
    }

    public function setEndereco (String $endereco)
    {
        $this->endereco = $endereco;
    }

    public function getBairro (): String
    {
        return $this->bairro;
    }

    public function setBairro (String $bairro)
    {
        $this->bairro = $bairro;
    }

    public function getCidade (): String
    {
        return $this->cidade;
    }

    public function setCidade (String $cidade)
    {
        $this->cidade = $cidade;
    }

    public function getUf (): String
    {
        return $this->uf;
    }

    public function setUf (String $uf)
    {
        $this->uf = $uf;
    }

    public function getCep (): String
    {
        return $this->cep;
    }

    public function setCep (String $cep)
    {
        $this->cep = $cep;
    }

    public function getTelefone (): String
    {
        return $this->telefone;
    }

    public function setTelefone (String $telefone)
    {
        $this->telefone = $telefone;
    }

    public function getEmail (): String
    {
        return $this->email;
    }

    public function setEmail (String $email)
    {
        $this->email = $email;
    }
}
