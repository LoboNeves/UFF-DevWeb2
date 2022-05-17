<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Venda;
use \PDOException;

require 'App/Model/conexao.php';

class VendaDAO 
{
    public function create (Venda $u): void
    {
        $sql = "INSERT INTO vendas(quantidade_venda, data_venda, valor_venda, id_cliente, id_produto, id_funcionario) VALUES (?,?,?,?,?,?)";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getQuantidadeVenda());
        $stmt->bindValue(2,$u->getDataVenda());
        $stmt->bindValue(3,$u->getValorVenda());
        $stmt->bindValue(4,$u->getIdCliente());
        $stmt->bindValue(5,$u->getIdProduto());
        $stmt->bindValue(6,$u->getIdFuncionario());
        $stmt->execute();
        $conn = null;
    }

    public function read(): \PDOStatement
    {
        $sql = "SELECT * FROM vendas";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->query($sql);
        $conn = null;
        return $stmt;
    }

    public function get(int $id): Venda
    {
        try {
            $sql = "SELECT * FROM vendas WHERE id = ?";
            $conn = Conexao::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            $aux = $stmt->fetch(\PDO::FETCH_OBJ);
            $id_aux = (int)$aux->id;

            $venda = new \App\Model\Venda();
            $venda->setId($id_aux);
            $venda->setQuantidadeVenda($aux->quantidade_venda);
            $venda->setDataVenda($aux->data_venda);
            $venda->setValorVenda($aux->valor_venda);
            $venda->setIdCliente($aux->id_cliente);
            $venda->setIdProduto($aux->id_produto);
            $venda->setIdFuncionario($aux->id_funcionario);

            return $venda;
        
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    public function update (Venda $u): void
    {
        $sql = "UPDATE vendas SET quantidade_venda = ?, data_venda = ?, valor_venda = ?, id_cliente = ?, id_produto = ?, id_funcionario = ? WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getQuantidadeVenda());
        $stmt->bindValue(2,$u->getDataVenda());
        $stmt->bindValue(3,$u->getValorVenda());
        $stmt->bindValue(4,$u->getIdCliente());
        $stmt->bindValue(5,$u->getIdProduto());
        $stmt->bindValue(6,$u->getIdFuncionario());
        $stmt->bindValue(7,$u->getId());
        $stmt->execute();
        $conn = null;
    }
    
    public function delete (Venda $u): void
    {
        $sql = "DELETE FROM vendas WHERE id = ?";
        $conn = Conexao::getConexao();
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$u->getId());
        $stmt->execute();
        $conn = null;
    }
}