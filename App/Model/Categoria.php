<?php

declare(strict_types=1);

namespace App\Model;

class Categoria
{
    private $id, $nome_categoria;

    public function getId (): int
    {
        return $this->id;
    }

    public function setId (int $id)
    {
        $this->id = $id;
    }

    public function getNomeCategoria (): String
    {
        return $this->nome_categoria;
    }

    public function setNomeCategoria (String $nome_categoria)
    {
        $this->nome_categoria = $nome_categoria;
    }
}
