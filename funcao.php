<?php

function validar_acao($acao)
{
    $permitidos = ["incluir", "excluir", "alterar"];
    if (in_array($acao, $permitidos)) :
        return true;
    endif;
    return false;
}


function validar_nome($nome, $minimo=2, $maximo=40)
{
    $erro = "";
    if (empty($nome)) :
        $erro .= "A nome não pode estar vazia. <br>";
    endif;
    if (strlen($nome) <= 2):
        $erro .= "Preencha o nome com no mínimo ". $minimo. " caracteres. <br>";
    endif;
    if (strlen($nome) > 40):
        $erro .= "Preencha o nome com no máximo " . $maximo. " caracteres. <br>";
    endif;

    return $erro;
}

