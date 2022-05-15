<?php

namespace App\Model;

use \PDO;
use \PDOException;

class Conexao
{
    public static function getConexao()
    {
        try { // conexão com a base de dados
            return new PDO("mysql:host=localhost;dbname=estoques", "root", "");
        } catch (PDOException $e) {
            echo 'Conexao falhou: ' . $e->getMessage();
        }
    }
}
