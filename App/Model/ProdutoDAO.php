<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Produto;
use \PDOException;

require 'App/Model/conexao.php';

class ProdutoDAO 
{
    public function create (Produto $u): void
    {
        $sql = "INSERT INTO produtos(nome_produto, descricao, preco_compra, preco_venda, quantidade_disponivel, liberado_venda, id_categoria) VALUES (?,?,?,?,?,?,?)";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getNomeProduto());
        $stmt->bindValue(2,$u->getDescricao());
        $stmt->bindValue(3,$u->getPrecoCompra());
        $stmt->bindValue(4,$u->getPrecoVenda());
        $stmt->bindValue(5,$u->getQuantidadeDisponivel());
        $stmt->bindValue(6,$u->getLiberadoVenda());
        $stmt->bindValue(7,$u->getIdCategoria());
        $stmt->execute();
        $conn = null;
    }

    public function read(): \PDOStatement
    {
        $sql = "SELECT * FROM produtos";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->query($sql);
        $conn = null;
        return $stmt;
    }

    public function get(int $id): Produto
    {
        try {
            $sql = "SELECT * FROM produtos WHERE id = ?";
            $conn = Conexao::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            $aux = $stmt->fetch(\PDO::FETCH_OBJ);
            $id_aux = (int)$aux->id;

            $produto = new \App\Model\Produto();
            $produto->setId($id_aux);
            $produto->setNomeProduto($aux->nome_produto);
            $produto->setDescricao($aux->descricao);
            $produto->setPrecoCompra($aux->preco_compra);
            $produto->setPrecoVenda($aux->preco_venda);
            $produto->setQuantidadeDisponivel($aux->quantidade_disponivel);
            $produto->setLiberadoVenda($aux->liberado_venda);
            $produto->setIdCategoria($aux->id_categoria);

            return $produto;
        
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    public function update (Produto $u): void
    {
        $sql = "UPDATE produtos SET nome_produto = ?, descricao = ?, preco_compra = ?, preco_venda = ?, quantidade_disponivel = ?, liberado_venda = ?, id_categoria = ? WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getNomeProduto());
        $stmt->bindValue(2,$u->getDescricao());
        $stmt->bindValue(3,$u->getPrecoCompra());
        $stmt->bindValue(4,$u->getPrecoVenda());
        $stmt->bindValue(5,$u->getQuantidadeDisponivel());
        $stmt->bindValue(6,$u->getLiberadoVenda());
        $stmt->bindValue(7,$u->getIdCategoria());
        $stmt->bindValue(8,$u->getId());
        $stmt->execute();
        $conn = null;
    }
    
    public function delete (Produto $u): void
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getId());
        $stmt->execute();
        $conn = null;
    }
}