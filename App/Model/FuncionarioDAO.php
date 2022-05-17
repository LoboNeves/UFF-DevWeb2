<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Funcionario;
use \PDOException;

require 'App/Model/conexao.php';

class FuncionarioDAO 
{
    public function create (Funcionario $u): void
    {
        $sql = "INSERT INTO funcionarios(nome, cpf, senha, papel) VALUES (?,?,?,?)";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getNome());
        $stmt->bindValue(2,$u->getCpf());
        $stmt->bindValue(3,$u->getSenha());
        $stmt->bindValue(4,$u->getPapel());
        $stmt->execute();
        $conn = null;
    }

    public function read(): \PDOStatement
    {
        $sql = "SELECT * FROM funcionarios";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->query($sql);
        $conn = null;
        return $stmt;
    }

    public function get(int $id): Funcionario
    {
        try {
            $sql = "SELECT * FROM funcionarios WHERE id = ?";
            $conn = Conexao::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            $aux = $stmt->fetch(\PDO::FETCH_OBJ);
            $id_aux = (int)$aux->id;

            $funcionario = new \App\Model\Funcionario();
            $funcionario->setId($id_aux);
            $funcionario->setNome($aux->nome);
            $funcionario->setCpf($aux->cpf);
            $funcionario->setSenha($aux->senha);
            $funcionario->setPapel($aux->papel);

            return $funcionario;
        
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    public function update (Funcionario $u): void
    {
        $sql = "UPDATE funcionarios SET nome = ?, cpf = ?, senha = ?, papel = ? WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getNome());
        $stmt->bindValue(2,$u->getCpf());
        $stmt->bindValue(3,$u->getSenha());
        $stmt->bindValue(4,$u->getPapel());
        $stmt->bindValue(5,$u->getId());
        $stmt->execute();
        $conn = null;
    }
    
    public function delete (Funcionario $u): void
    {
        $sql = "DELETE FROM funcionarios WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getId());
        $stmt->execute();
        $conn = null;
    }
}