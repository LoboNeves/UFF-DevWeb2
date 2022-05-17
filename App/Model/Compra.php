<?php

declare(strict_types=1);

namespace App\Model;

class Compra
{
    private $id, $quantidade_compra, $data_compra, $valor_compra, $id_fornecedor, $id_produto, $id_funcionario;

    public function getId (): int
    {
        return $this->id;
    }

    public function setId (int $id)
    {
        $this->id = $id;
    }

    public function getQuantidadeCompra (): int
    {
        return $this->quantidade_compra;
    }

    public function setQuantidadeCompra (int $quantidade_compra)
    {
        $this->quantidade_compra = $quantidade_compra;
    }

    public function getDataCompra (): String
    {
        return $this->data_compra;
    }

    public function setDataCompra (String $data_compra)
    {
        $this->data_compra = $data_compra;
    }

    public function getValorCompra (): String
    {
        return $this->valor_compra;
    }

    public function setValorCompra (String $valor_compra)
    {
        $this->valor_compra = $valor_compra;
    }

    public function getIdFornecedor (): String
    {
        return $this->id_fornecedor;
    }

    public function setIdFornecedor (String $id_fornecedor)
    {
        $this->id_fornecedor = $id_fornecedor;
    }

    public function getIdProduto (): String
    {
        return $this->id_produto;
    }

    public function setIdProduto (String $id_produto)
    {
        $this->id_produto = $id_produto;
    }

    public function getIdFuncionario (): String
    {
        return $this->id_funcionario;
    }

    public function setIdFuncionario (String $id_funcionario)
    {
        $this->id_funcionario = $id_funcionario;
    }
}
