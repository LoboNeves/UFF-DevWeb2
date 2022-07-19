<?php
// listando as vendas
$vendas = $data['vendas'];
if (!empty($vendas)) :
    foreach ($vendas as $venda) { ?>
        <p></p>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID da venda: <?= htmlentities(utf8_encode($venda['id'])) ?></h5>
                <p class="card-text">Quantidade vendida: <?= htmlentities(utf8_encode($venda['quantidade_venda'])) ?></p>
                <p class="card-text">Data da venda: <?= htmlentities(utf8_encode($venda['data_venda'])) ?></p>
                <p class="card-text">Valor da venda: <?= htmlentities(utf8_encode($venda['valor_venda'])) ?></p>
                <p class="card-text">Cliente:
                    <?php
                    $clientes = $data['clientes'];
                    foreach ($clientes as $cliente) { ?>
                        <?php if ($venda['id_cliente'] == $cliente['id']) : ?>
                            <?= htmlentities(utf8_encode($cliente['nome'])) ?>
                        <?php endif; ?>
                    <?php }; ?>
                </p>
                <p class="card-text">Produto:
                    <?php
                    $produtos = $data['produtos'];
                    foreach ($produtos as $produto) { ?>
                        <?php if ($venda['id_produto'] == $produto['id']) : ?>
                            <?= htmlentities(utf8_encode($produto['nome_produto'])) ?>
                        <?php endif; ?>
                    <?php }; ?>
                </p>
                <p class="card-text">Funcionario:
                    <?php
                    $funcionarios = $data['funcionarios'];
                    foreach ($funcionarios as $funcionario) { ?>
                        <?php if ($venda['id_funcionario'] == $funcionario['id']) : ?>
                            <?= htmlentities(utf8_encode($funcionario['nome'])) ?>
                        <?php endif; ?>
                    <?php }; ?>
                </p>
            </div>
        </div>
<?php    }
else :
    echo "Não há vendas";
endif;
?>