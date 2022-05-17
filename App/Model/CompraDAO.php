<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Compra;
use \PDOException;

require 'App/Model/conexao.php';

class CompraDAO 
{
    public function create (Compra $u): void
    {
        $sql = "INSERT INTO compras(quantidade_compra, data_compra, valor_compra, id_fornecedor, id_produto, id_funcionario) VALUES (?,?,?,?,?,?)";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getQuantidadeCompra());
        $stmt->bindValue(2,$u->getDataCompra());
        $stmt->bindValue(3,$u->getValorCompra());
        $stmt->bindValue(4,$u->getIdFornecedor());
        $stmt->bindValue(5,$u->getIdProduto());
        $stmt->bindValue(6,$u->getIdFuncionario());
        $stmt->execute();
        $conn = null;
    }

    public function read(): \PDOStatement
    {
        $sql = "SELECT * FROM compras";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->query($sql);
        $conn = null;
        return $stmt;
    }

    public function get(int $id): Compra
    {
        try {
            $sql = "SELECT * FROM compras WHERE id = ?";
            $conn = Conexao::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            $aux = $stmt->fetch(\PDO::FETCH_OBJ);
            $id_aux = (int)$aux->id;

            $compra = new \App\Model\Compra();
            $compra->setId($id_aux);
            $compra->setQuantidadeCompra($aux->quantidade_compra);
            $compra->setDataCompra($aux->data_compra);
            $compra->setValorCompra($aux->valor_compra);
            $compra->setIdFornecedor($aux->id_fornecedor);
            $compra->setIdProduto($aux->id_produto);
            $compra->setIdFuncionario($aux->id_funcionario);

            return $compra;
        
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    public function update (Compra $u): void
    {
        $sql = "UPDATE compras SET quantidade_compra = ?, data_compra = ?, valor_compra = ?, id_fornecedor = ?, id_produto = ?, id_funcionario = ? WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getQuantidadeCompra());
        $stmt->bindValue(2,$u->getDataCompra());
        $stmt->bindValue(3,$u->getValorCompra());
        $stmt->bindValue(4,$u->getIdFornecedor());
        $stmt->bindValue(5,$u->getIdProduto());
        $stmt->bindValue(6,$u->getIdFuncionario());
        $stmt->bindValue(7,$u->getId());
        $stmt->execute();
        $conn = null;
    }
    
    public function delete (Compra $u): void
    {
        $sql = "DELETE FROM compras WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getId());
        $stmt->execute();
        $conn = null;
    }
}