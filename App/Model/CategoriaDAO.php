<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Categoria;
use \PDOException;

require 'App/Model/conexao.php';

class CategoriaDAO 
{
    public function create (Categoria $u): void
    {
        $sql = "INSERT INTO categorias(nome_categoria) VALUES (?)";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getNomeCategoria());
        $stmt->execute();
        $conn = null;
    }

    public function read(): \PDOStatement
    {
        $sql = "SELECT * FROM categorias";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->query($sql);
        $conn = null;
        return $stmt;
    }

    public function get(int $id): Categoria
    {
        try {
            $sql = "SELECT * FROM categorias WHERE id = ?";
            $conn = Conexao::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            $aux = $stmt->fetch(\PDO::FETCH_OBJ);
            $id_aux = (int)$aux->id;

            $categoria = new \App\Model\Categoria();
            $categoria->setId($id_aux);
            $categoria->setNomeCategoria($aux->nome_categoria);

            return $categoria;
        
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    public function update (Categoria $u): void
    {
        $sql = "UPDATE categorias SET nome_categoria = ? WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getNomeCategoria());
        $stmt->bindValue(2,$u->getId());
        $stmt->execute();
        $conn = null;
    }
    
    public function delete (Categoria $u): void
    {
        $sql = "DELETE FROM categorias WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getId());
        $stmt->execute();
        $conn = null;
    }
}