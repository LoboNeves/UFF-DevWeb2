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