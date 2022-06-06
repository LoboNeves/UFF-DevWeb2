<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\core\Funcoes;
use GUMP as Validador;

class Venda extends BaseController
{

    protected $filters = [
        //'quantidade_venda' => 'trim|sanitize_int'
    ];

    protected $rules = [
        'quantidade_venda'    => 'required|min_len,1|max_len,10'
    ];

    function __construct()
    {
        session_start();
        if (!Funcoes::funcionarioLogado()) :
            Funcoes::redirect("Home");
        endif;
    }

    public function index($numPag = 1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :

            $this->view('venda/index', [], 'venda/vendajs');
        else :
            Funcoes::redirect("Home");
        endif;
    }


    public function ajax_lista($data)
    {

        $numPag = $data['numPag'];

        // calcula o offset
        $offset = ($numPag - 1) * REGISTROS_PAG;

        $vendaModel = $this->model("VendaModel");

        // obtém a quantidade total de registros na base de dados
        $total_registros = $vendaModel->getTotalVendas();

        // calcula a quantidade de páginas - ceil — Arredonda frações para cima
        $total_paginas = ceil($total_registros / REGISTROS_PAG);

        // obtém os registros referente a página
        $lista_vendas = $vendaModel->getRegistroPagina($offset, REGISTROS_PAG)->fetchAll(\PDO::FETCH_ASSOC);

        $corpoTabela = "";

        if (!empty($lista_vendas)) :
            foreach ($lista_vendas as $venda) {
                $corpoTabela .= "<tr>";
                $corpoTabela .= "<td>" . htmlentities(utf8_encode($venda['quantidade_venda'])) . "</td>";
                $corpoTabela .= "<td>" . htmlentities(utf8_encode($venda['data_venda'])) . "</td>";
                $corpoTabela .= "<td>" . htmlentities(utf8_encode($venda['valor_venda'])) . "</td>";
                $corpoTabela .= "<td>" . htmlentities(utf8_encode($venda['id_cliente'])) . "</td>";
                $corpoTabela .= "<td>" . htmlentities(utf8_encode($venda['id_produto'])) . "</td>";
                $corpoTabela .= "<td>" . htmlentities(utf8_encode($venda['id_funcionario'])) . "</td>";
                $corpoTabela .= "<td>" . '<button type="button" id="btAlterar" data-id="' . $venda['id'] . '" class="btn btn-outline-primary">Alterar</button>
                                          <button type="button" id="btExcluir" data-id="' . $venda['id'] . '" data-produto="' . $venda['id_produto'] . '"class="btn btn-outline-primary">Excluir</button>'
                    . "</td>";
                $corpoTabela .= "</tr>";
            }

            $links = '<nav aria-label="Page navigation example">';
            $links .= '<ul class="pagination">';

            for ($page = 1; $page <= $total_paginas; $page++) {
                $links .= '<li class="page-item"><a class="page-link link-navegacao" href="javascript:load_data(' . $page . ')">' . $page . '</a></li>';
            }
            $links .= '  </ul></nav>';

        else :
            $corpoTabela = "<tr>Não há vendas</tr>";
        endif;

        $data = [];
        $data["TotalRegistros"] = $total_registros;
        $data["TotalPaginas"] = $total_paginas;
        $data["corpoTabela"] = $corpoTabela;
        $data["links"] = $links;
        $data['status'] = true;
        echo json_encode($data);
        exit();
    }

    // ***********************************************************************
    // chama a view para entrada dos dados da venda
    public function incluir()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            // gera o CSRF_token e guarda na sessão
            $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
            // devolve os dados 
            $data = array();
            $data['token'] = $_SESSION['CSRF_token'];
            $data['status'] = true;
            echo json_encode($data);
            exit();
        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function gravarInclusao()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

                $validacao = new Validador("pt-br");
                $post_filtrado = $validacao->filter($_POST, $this->filters);
                $post_validado = $validacao->validate($post_filtrado, $this->rules);

                if ($post_validado === true) :  // verificar dados da venda

                    //$hash_senha = password_hash($_POST['senha'], PASSWORD_ARGON2I); // gerar hash senha enviada

                    $venda = new \App\models\Venda(); // criar uma instância da venda
                    $venda->setQuantidadeVenda($_POST['quantidade_venda']);   // setar os valores
                    $venda->setDataVenda($_POST['data_venda']);
                    $venda->setValorVenda($_POST['valor_venda']);
                    $venda->setIdCliente($_POST['id_cliente']);
                    $venda->setIdProduto($_POST['id_produto']);
                    $venda->setIdFuncionario($_POST['id_funcionario']);
                    $vendaModel = $this->model("VendaModel"); 
                    $vendaModel->create($venda); // incluir venda no BD
                    //$hashId = hash('sha512', $chaveGerada);  // calcular o hash da id (chave primária) gerada
                    //$clienteModel->createHashID($chaveGerada, $hashId);

                    $data['status'] = true;          // retornar inclusão realizada
                    echo json_encode($data);
                    exit();
                else :  // validação dos dados falhou
                    $erros = $validacao->get_errors_array();  // obter erros de validação
                    $erros = implode("<br>", $erros);         // gerar uma string com os erros
                    $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

                    $data['token'] = $_SESSION['CSRF_token'];  // gerar CSRF
                    $data['status'] = false;        // retornar erros
                    $data['erros'] = $erros;
                    echo json_encode($data);
                    exit();
                endif;
            else :
                die("Erro 404");
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }

    // ***********************************************************************
    public function alterarVenda($data)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') :

            // o controlador receber o parâmetro como um array $data['hashID']
            $id = $data['id'];

            // gera o CSRF_token e guarda na sessão
            $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

            $vendaModel = $this->model("vendaModel");

            $venda = $vendaModel->get($id);

            $data = array();
            $data['token'] = $_SESSION['CSRF_token'];
            $data['status'] = true;
            $data['quantidade_venda'] = $venda['quantidade_venda'];
            $data['data_venda'] = $venda['data_venda'];
            $data['valor_venda'] = $venda['valor_venda'];
            $data['id_cliente'] = $venda['id_cliente'];
            $data['id_produto'] = $venda['id_produto'];
            $data['id_funcionario'] = $venda['id_funcionario'];
            $data['id'] =  $id;
            echo json_encode($data);
            exit();

        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function gravarAlterar()
    {
        // trata a as solicitações POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

                $filters = [
                    //'quantidade_venda_alteracao' => 'trim|sanitize_int'
                ];

                $rules = [
                    'quantidade_venda_alteracao'    => 'required|min_len,1|max_len,10'
                ];

                $validacao = new Validador("pt-br");

                $post_filtrado = $validacao->filter($_POST, $filters);
                $post_validado = $validacao->validate($post_filtrado, $rules);

                if ($post_validado === true) :  // verificar dados do venda

                    // criando um objeto venda
                    $venda = new \App\models\Venda();
                    $venda->setQuantidadeVenda($_POST['quantidade_venda_alteracao']);
                    $venda->setDataVenda($_POST['data_venda_alteracao']);
                    $venda->setValorVenda($_POST['valor_venda_alteracao']);
                    $venda->setIdCliente($_POST['id_cliente_alteracao']);
                    $venda->setIdProduto($_POST['id_produto_alteracao']);
                    $venda->setIdFuncionario($_POST['id_funcionario_alteracao']);
                    $venda->setId($_POST['id_alteracao']);

                    $vendaModel = $this->model("VendaModel");

                    $vendaModel->update($venda);

                    $data['status'] = true;
                    echo json_encode($data);
                    exit();


                else :
                    $erros = $validacao->get_errors_array();
                    $erros = implode("<br>", $erros);
                    $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

                    $vendaModel = $this->model("vendaModel");
                    $venda = $vendaModel->getId($_POST['id_alteracao']);
                    
                    $data['status'] = true;
                    $data['quantidade_venda'] = $venda['quantidade_venda'];
                    $data['data_venda'] = $venda['data_venda'];
                    $data['valor_venda'] = $venda['valor_venda'];
                    $data['id_cliente'] = $venda['id_cliente'];
                    $data['id_produto'] = $venda['id_produto'];
                    $data['id_funcionario'] = $venda['id_funcionario'];
                    $data['id'] =  $_POST['id_alteracao'];
                    $data['token'] = $_SESSION['CSRF_token'];
                    $data['status'] = false;
                    $data['erros'] = $erros;
                    echo json_encode($data);
                    exit();
                endif;
            else :
                die("Erro 404");
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }

    // ***********************************************************************


    public function excluirVenda($data)
    {
        // trata a as solicitações POST
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :

            $id = $data['id'];

            $vendaModel = $this->model("VendaModel");

            $vendaModel->delete($id);

            $data = array();
            $data['status'] = true;
            echo json_encode($data);
            exit();

        else :
            Funcoes::redirect("Home");
        endif;
    }
}