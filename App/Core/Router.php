<?php

$route = new \CoffeeCode\Router\Router(URL_BASE);
/**
 * APP
 */
$route->namespace("App\Controllers");
/**
 * parte publica
 */
$route->get("/", "Home:index");
$route->get("/home", "Home:index");
$route->get("/login", "AcessoRestrito:login");
$route->post("/logar", "AcessoRestrito:logar");  // <= rota para metodo POST do from login
/**
 * parte restrita
 */
$route->get("/logout", "AcessoRestrito:logout");
/**
 * parte restrita - vendedores
 */
$route->get("/DashboardVendedor", "DashboardVendedor:index");
//CRUD Clientes
$route->get("/Clientes", "Cliente:index");
$route->get("/incluircliente", "Cliente:incluir");
$route->post("/salvarinclusaocliente", "Cliente:gravarInclusao");
$route->get("/navegacliente/{numPag}", "Cliente:ajax_lista");
$route->get("/alteracaocliente/{id}", "Cliente:alterarCliente");
$route->post("/gravaralteracaocliente", "Cliente:gravarAlterar");
$route->get("/excluircliente/{id}", "Cliente:excluirCliente");
//CRUD Vendas
$route->get("/Vendas", "Venda:index");
$route->get("/incluirvenda", "Venda:incluir");
$route->post("/salvarinclusaovenda", "Venda:gravarInclusao");
$route->get("/navegavenda/{numPag}", "Venda:ajax_lista");
$route->get("/alteracaovenda/{id}", "Venda:alterarVenda");
$route->post("/gravaralteracaovenda", "Venda:gravarAlterar");
$route->get("/excluirvenda/{id}", "Venda:excluirVenda");
/**
 * parte restrita - compradores
 */
$route->get("/DashboardComprador", "DashboardComprador:index");
//CRUD Fornecedores
$route->get("/Fornecedores", "Fornecedor:index");
$route->get("/incluirfornecedor", "Fornecedor:incluir");
$route->post("/salvarinclusaofornecedor", "Fornecedor:gravarInclusao");
$route->get("/navegafornecedor/{numPag}", "Fornecedor:ajax_lista");
$route->get("/alteracaofornecedor/{id}", "Fornecedor:alterarFornecedor");
$route->post("/gravaralteracaofornecedor", "Fornecedor:gravarAlterar");
$route->get("/excluirfornecedor/{id}", "Fornecedor:excluirFornecedor");
//CRUD Categorias
$route->get("/Categorias", "Categoria:index");
$route->get("/incluircategoria", "Categoria:incluir");
$route->post("/salvarinclusaocategoria", "Categoria:gravarInclusao");
$route->get("/navegacategoria/{numPag}", "Categoria:ajax_lista");
$route->get("/alteracaocategoria/{id}", "Categoria:alterarCategoria");
$route->post("/gravaralteracaocategoria", "Categoria:gravarAlterar");
$route->get("/excluircategoria/{id}", "Categoria:excluirCategoria");
//CRUD Compras
$route->get("/Compras", "Compra:index");
$route->get("/incluircompra", "Compra:incluir");
$route->post("/salvarinclusaocompra", "Compra:gravarInclusao");
$route->get("/navegacompra/{numPag}", "Compra:ajax_lista");
$route->get("/alteracaocompra/{id}", "Compra:alterarCompra");
$route->post("/gravaralteracaocompra", "Compra:gravarAlterar");
$route->get("/excluircompra/{id}", "Compra:excluirCompra");
//CRUD Produtos
$route->get("/Produtos", "Produto:index");
$route->get("/incluirproduto", "Produto:incluir");
$route->post("/salvarinclusaoproduto", "Produto:gravarInclusao");
$route->get("/navegaproduto/{numPag}", "Produto:ajax_lista");
$route->get("/alteracaoproduto/{id}", "Produto:alterarProduto");
$route->post("/gravaralteracaoproduto", "Produto:gravarAlterar");
$route->get("/excluirproduto/{id}", "Produto:excluirProduto");
/**
 * parte restrita - administradores
 */
$route->get("/DashboardAdministrador", "DashboardAdministrador:index");
//CRUD Funcionarios
$route->get("/Funcionarios", "Funcionario:index");
$route->get("/incluirfuncionario", "Funcionario:incluir");
$route->post("/salvarinclusaofuncionario", "Funcionario:gravarInclusao");
$route->get("/navegafuncionario/{numPag}", "Funcionario:ajax_lista");
$route->get("/alteracaofuncionario/{id}", "Funcionario:alterarFuncionario");
$route->post("/gravaralteracaofuncionario", "Funcionario:gravarAlterar");
$route->get("/excluirfuncionario/{id}", "Funcionario:excluirFuncionario");
//CRUD Relatório de estoque dos produtos
$route->get("/RelatorioProdutos", "RelatorioProduto:index");
//CRUD Relatório de vendas dos produtos
$route->get("/RelatorioVendas", "RelatorioVenda:index");
/**
 * ERROR
 */
$route->group("ops");
$route->get("/{errcode}", "Web:error");
/**
 * PROCESS
 */
$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}