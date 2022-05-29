<?php

require("vendor/autoload.php");

$validator = new GUMP("pt-br");

// regras de filtragem
$filters =
    [
        'nome' => 'trim|sanitize_string|upper_case',
        'email' => 'trim|sanitize_email|lower_case',
        'bt_acao' => 'trim|sanitize_string|lower_case'
    ];
// regras de validação
$rules =
    [
        'nome'    => 'required|min_len,2|max_len,40',
        'email'  => 'required|valid_email'
    ];

// criando um objeto cliente
$cliente = new \App\Model\Cliente();
// criando um clienteDAO
$clienteDAO = new \App\Model\ClienteDAO();
// fazendo a leitura de todos os clientes
$lista_clientes = $clienteDAO->read();


?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.css" type="text/css" rel="stylesheet" />
    <title>CompraVenda</title>
</head>

<body>
    <div>
        <?php
        include_once "funcao.php";
        include_once "menu.html";
        echo "<p></p>";
        ?>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>CEP</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php  // listando os clientes
                if ($lista_clientes->rowCount() > 0) :
                    $osclientes = $lista_clientes->fetchAll(\PDO::FETCH_ASSOC);
                    foreach ($osclientes as $cliente_consulta) {
                        echo "<tr>";
                        echo "<td>" . htmlentities($cliente_consulta['id'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlentities($cliente_consulta['nome'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlentities($cliente_consulta['cpf'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlentities($cliente_consulta['endereco'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlentities($cliente_consulta['bairro'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlentities($cliente_consulta['cidade'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlentities($cliente_consulta['uf'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlentities($cliente_consulta['cep'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlentities($cliente_consulta['telefone'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlentities($cliente_consulta['email'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td> <a href='index.php?acao=alterar&id=" . $cliente_consulta['id'] . "'>Alterar</a> |
                        <a href='index.php?acao=excluir&id=" . $cliente_consulta['id'] . "'>Excluir</a>
                        </td>";
                        echo "</tr>";
                    }
                else :
                    echo "Não há clientes";
                endif;
                ?>
            </tbody>
        </table>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET') : // trata a as solicitações GET
            if (isset($_GET['acao'])) :
                // filtrar o get
                $acao = filter_var($_GET['acao'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if (!validar_acao($acao)) {
                    die("Erro 404");
                }
                switch ($acao) {
                    case 'incluir':  // clicar no menu solicitando inclusão
                        include_once "incluir.php";
                        break;
                    case 'alterar':  // clicar em alterar ao lado do usuário
                        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                        if (!filter_var($id, FILTER_VALIDATE_INT)) :
                            die("Indificador Incorreto");
                        endif;
                        $cliente = $clienteDAO->get($id);
                        include_once "alterar.php";
                        break;
                    case 'excluir': // clicar em excluir ao lado do usuário
                        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                        if (!filter_var($id, FILTER_VALIDATE_INT)) :
                            die("Indificador Incorreto");
                        endif;
                        $cliente = $clienteDAO->get($id);
                        include_once "excluir.php";
                        break;
                }
            endif;
        else :
            // trata a as solicitações POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') :
                // limpeza dos dados de entrada
                $nome = filter_var($_POST['nome'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $cpf = filter_var($_POST['cpf'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $endereco = filter_var($_POST['endereco'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $bairro = filter_var($_POST['bairro'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $cidade = filter_var($_POST['cidade'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $uf = filter_var($_POST['uf'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $cep = filter_var($_POST['cep'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $acao = filter_var($_POST['bt_acao'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // a ação é válida?
                if (!validar_acao($acao)) :
                    die("Erro 404");
                else :
                    switch ($acao) {
                        case 'incluir':  // ação de incluir cliente
                            $erro = "";
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
                                $erro .= "Email inválido <br>";
                            endif;
                            $erro .= validar_nome($nome);
                            if (empty($erro)) :
                                $cliente->setNome($nome);
                                $cliente->setCpf($cpf);
                                $cliente->setEndereco($endereco);
                                $cliente->setBairro($bairro);
                                $cliente->setCidade($cidade);
                                $cliente->setUf($uf);
                                $cliente->setCep($cep);
                                $cliente->setTelefone($telefone);
                                $cliente->setEmail($email);
                                $clienteDAO->create($cliente);
                                header("Location: index.php");
                            else :
                                include "incluir.php";
                            endif;
                            break;
                            // ação de alterar ****************************   
                        case 'alterar':
                            $erro = "";
                            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

                            if (!filter_var($id, FILTER_VALIDATE_INT)) :
                                $erro .= "Identificador inválido <br>";
                            endif;
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
                                $erro .= "Email inválido <br>";
                            endif;

                            $erro .= validar_nome($nome);
                            if (empty($erro)) :
                                $cliente->setNome($nome);
                                $cliente->setCpf($cpf);
                                $cliente->setEndereco($endereco);
                                $cliente->setBairro($bairro);
                                $cliente->setCidade($cidade);
                                $cliente->setUf($uf);
                                $cliente->setCep($cep);
                                $cliente->setTelefone($telefone);
                                $cliente->setEmail($email);
                                $cliente->setId($id);
                                $clienteDAO->update($cliente);
                                header("Location: index.php");
                            else :
                                include "alterar.php";
                            endif;
                            break;
                        case 'excluir':
                            $erro = "";
                            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                            if (!filter_var($id, FILTER_VALIDATE_INT)) :
                                $erro .= "Identificador inválido <br>";
                            endif;
                            if (empty($erro)) :
                                $cliente->setId($id);
                                $clienteDAO->delete($cliente);
                                header("Location: index.php");
                            else :
                                include "excluir.php";
                            endif;
                            break;
                    }
                endif;
            endif;
        endif;
        ?>
    </div>

    <script src="assets/js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="assets/js/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.js" type="text/javascript"></script>
</body>

</html>