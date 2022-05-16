<?php

declare(strict_types=1);

namespace App\Model;

use DateTime;

class Venda
{
    private $id, $quantidade_venda, $data_venda, $valor_venda, $id_cliente, $id_produto, $id_funcionario;

    public function getId (): int
    {
        return $this->id;
    }

    public function setId (int $id)
    {
        $this->id = $id;
    }

    public function getQuantidadeVenda (): int
    {
        return $this->quantidade_venda;
    }

    public function setQuantidadeVenda (int $quantidade_venda)
    {
        $this->quantidade_venda = $quantidade_venda;
    }

    public function getDataVenda (): String
    {
        return $this->data_venda;
    }

    public function setDataVenda (String $data_venda)
    {
        $this->data_venda = $data_venda;
    }

    public function getValorVenda (): int
    {
        return $this->valor_venda;
    }

    public function setValorVenda (int $valor_venda)
    {
        $this->valor_venda = $valor_venda;
    }

    public function getIdCliente (): String
    {
        return $this->id_cliente;
    }

    public function setIdCliente (String $id_cliente)
    {
        $this->id_cliente = $id_cliente;
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
