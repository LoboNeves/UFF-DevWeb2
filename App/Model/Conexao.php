<?php

namespace App\Model;

use \PDO;
use \PDOException;

class Conexao
{
    public static function getConexao()
    {
        $banco = "mysql:host=".HOST.";dbname=".DB;

        $opcoes = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try { // conexão com a base de dados
            return new PDO($banco, USUARIO, SENHA, $opcoes);
        } catch (PDOException $e) {
            echo 'Conexao falhou: ' . $e->getMessage();
        }
    }
}
