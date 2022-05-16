<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Cliente;
use \PDOException;

require 'App/Model/conexao.php';

class ClienteDAO 
{
    public function create (Cliente $u): void
    {
        $sql = "INSERT INTO clientes(nome, cpf, endereco, bairro, cidade, uf, cep, telefone, email) VALUES (?,?,?,?,?,?,?,?,?)";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getNome());
        $stmt->bindValue(2,$u->getCpf());
        $stmt->bindValue(3,$u->getEndereco());
        $stmt->bindValue(4,$u->getBairro());
        $stmt->bindValue(5,$u->getCidade());
        $stmt->bindValue(6,$u->getUf());
        $stmt->bindValue(7,$u->getCep());
        $stmt->bindValue(8,$u->getTelefone());
        $stmt->bindValue(9,$u->getEmail());
        $stmt->execute();
        $conn = null;
    }

    public function read(): \PDOStatement
    {
        $sql = "SELECT * FROM clientes";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->query($sql);
        $conn = null;
        return $stmt;
    }

    public function get(int $id): Cliente
    {
        try {
            $sql = "SELECT * FROM clientes WHERE id = ?";
            $conn = Conexao::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            $aux = $stmt->fetch(\PDO::FETCH_OBJ);
            $id_aux = (int)$aux->id;

            $cliente = new \App\Model\Cliente();
            $cliente->setId($id_aux);
            $cliente->setNome($aux->nome);
            $cliente->setCpf($aux->cpf);
            $cliente->setEndereco($aux->endereco);
            $cliente->setBairro($aux->bairro);
            $cliente->setCidade($aux->cidade);
            $cliente->setUf($aux->uf);
            $cliente->setCep($aux->cep);
            $cliente->setTelefone($aux->telefone);
            $cliente->setEmail($aux->email);

            return $cliente;
        
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    public function update (Cliente $u): void
    {
        $sql = "UPDATE clientes SET nome = ?, cpf = ?, endereco = ?, bairro = ?, cidade = ?, uf = ?, cep = ?, telefone = ?,email = ? WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getNome());
        $stmt->bindValue(2,$u->getCpf());
        $stmt->bindValue(3,$u->getEndereco());
        $stmt->bindValue(4,$u->getBairro());
        $stmt->bindValue(5,$u->getCidade());
        $stmt->bindValue(6,$u->getUf());
        $stmt->bindValue(7,$u->getCep());
        $stmt->bindValue(8,$u->getTelefone());
        $stmt->bindValue(9,$u->getEmail());
        $stmt->bindValue(10,$u->getId());
        $stmt->execute();
        $conn = null;
    }
    
    public function delete (Cliente $u): void
    {
        $sql = "DELETE FROM clientes WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getId());
        $stmt->execute();
        $conn = null;
    }
}