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
$route->post("/salvarinclusao", "Cliente:gravarInclusao");
$route->get("/navega/{numPag}", "Cliente:ajax_lista");
$route->get("/alteracaocliente/{id}", "Cliente:alterarCliente");
$route->post("/gravaralteracao", "Cliente:gravarAlterar");
$route->get("/excluircliente/{id}", "Cliente:excluirCliente");

$route->get("/Vendas", "Venda:index");
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