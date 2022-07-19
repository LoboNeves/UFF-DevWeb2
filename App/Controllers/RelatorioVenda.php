<?php

namespace App\Controllers;

use App\Core\BaseController;

class RelatorioVenda extends BaseController
{

    function __construct()
    {
        session_start();
    }
    public function index()
    {
        // instanciar o model
        // $this->model método herdado de BaseController
        $vendaModel = $this->model("VendaModel");
        $clienteModel = $this->model("ClienteModel");
        $produtoModel = $this->model("ProdutoModel");
        $funcionarioModel = $this->model("FuncionarioModel");

        $vendas = $vendaModel->read()->fetchAll(\PDO::FETCH_ASSOC);
        $clientes = $clienteModel->read()->fetchAll(\PDO::FETCH_ASSOC);
        $produtos = $produtoModel->read()->fetchAll(\PDO::FETCH_ASSOC);
        $funcionarios = $funcionarioModel->read()->fetchAll(\PDO::FETCH_ASSOC);

        $data = [
            'vendas' => $vendas,
            'clientes' => $clientes,
            'produtos' => $produtos,
            'funcionarios' => $funcionarios
        ];

        $this->view('relatorioVenda/index', $data);
    }
}
