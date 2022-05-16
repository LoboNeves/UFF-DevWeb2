<?php

declare(strict_types=1);

namespace App\Model;

class Fornecedor
{
    private $id, $razao_social, $cnpj, $endereco, $bairro, $cidade, $uf, $cep, $telefone, $email;

    public function getId (): int
    {
        return $this->id;
    }

    public function setId (int $id)
    {
        $this->id = $id;
    }

    public function getRazaoSocial (): String
    {
        return $this->razao_social;
    }

    public function setRazaoSocial (String $razao_social)
    {
        $this->razao_social = $razao_social;
    }

    public function getCnpj (): String
    {
        return $this->cnpj;
    }

    public function setCnpj (String $cnpj)
    {
        $this->cnpj = $cnpj;
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
