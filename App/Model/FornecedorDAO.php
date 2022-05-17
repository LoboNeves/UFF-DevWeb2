<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Fornecedor;
use \PDOException;

require 'App/Model/conexao.php';

class FornecedorDAO 
{
    public function create (Fornecedor $u): void
    {
        $sql = "INSERT INTO fornecedores(razao_social, cnpj, endereco, bairro, cidade, uf, cep, telefone, email) VALUES (?,?,?,?,?,?,?,?,?)";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getRazaoSocial());
        $stmt->bindValue(2,$u->getCnpj());
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
        $sql = "SELECT * FROM fornecedores";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->query($sql);
        $conn = null;
        return $stmt;
    }

    public function get(int $id): Fornecedor
    {
        try {
            $sql = "SELECT * FROM fornecedores WHERE id = ?";
            $conn = Conexao::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            $aux = $stmt->fetch(\PDO::FETCH_OBJ);
            $id_aux = (int)$aux->id;

            $fornecedor = new \App\Model\Fornecedor();
            $fornecedor->setId($id_aux);
            $fornecedor->setRazaoSocial($aux->razao_social);
            $fornecedor->setCnpj($aux->cnpj);
            $fornecedor->setEndereco($aux->endereco);
            $fornecedor->setBairro($aux->bairro);
            $fornecedor->setCidade($aux->cidade);
            $fornecedor->setUf($aux->uf);
            $fornecedor->setCep($aux->cep);
            $fornecedor->setTelefone($aux->telefone);
            $fornecedor->setEmail($aux->email);

            return $fornecedor;
        
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    public function update (Fornecedor $u): void
    {
        $sql = "UPDATE fornecedores SET razao_social = ?, cnpj = ?, endereco = ?, bairro = ?, cidade = ?, uf = ?, cep = ?, telefone = ?,email = ? WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getRazaoSocial());
        $stmt->bindValue(2,$u->getCnpj());
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
    
    public function delete (Fornecedor $u): void
    {
        $sql = "DELETE FROM fornecedores WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getId());
        $stmt->execute();
        $conn = null;
    }
}