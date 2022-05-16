<?php

declare(strict_types=1);

namespace App\Model;

class Produto
{
    private $id, $nome_produto, $descricao, $preco_compra, $preco_venda, $quantidade_disponivel, $liberado_venda, $id_categoria;

    public function getId (): int
    {
        return $this->id;
    }

    public function setId (int $id)
    {
        $this->id = $id;
    }

    public function getNomeProduto (): String
    {
        return $this->nome_produto;
    }

    public function setNomeProduto (String $nome_produto)
    {
        $this->nome_produto = $nome_produto;
    }

    public function getDescricao (): String
    {
        return $this->descricao;
    }

    public function setDescricao (String $descricao)
    {
        $this->descricao = $descricao;
    }

    public function getPrecoCompra (): int
    {
        return $this->preco_compra;
    }

    public function setPrecoCompra (int $preco_compra)
    {
        $this->preco_compra = $preco_compra;
    }

    public function getPrecoVenda (): int
    {
        return $this->preco_venda;
    }

    public function setPrecoVenda (int $preco_venda)
    {
        $this->preco_venda = $preco_venda;
    }

    public function getQuantidadeDisponivel (): int
    {
        return $this->quantidade_disponivel;
    }

    public function setQuantidadeDisponivel (int $quantidade_disponivel)
    {
        $this->quantidade_disponivel = $quantidade_disponivel;
    }

    public function getLiberadoVenda (): String
    {
        return $this->liberado_venda;
    }

    public function setLiberadoVenda (String $liberado_venda)
    {
        $this->liberado_venda = $liberado_venda;
    }

    public function getIdCategoria (): String
    {
        return $this->id_categoria;
    }

    public function setIdCategoria (String $id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }
}
