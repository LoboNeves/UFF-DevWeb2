<?php
// listando os produtos
$produtos = $data['produtos'];
if (!empty($produtos)) :
    foreach ($produtos as $produto) { ?>
        <p></p>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ID do produto: <?= htmlentities(utf8_encode($produto['id'])) ?></h5>
                <p class="card-text">Nome do produto: <?= htmlentities(utf8_encode($produto['nome_produto'])) ?></p>
                <p class="card-text">Descrição: <?= htmlentities(utf8_encode($produto['descricao'])) ?></p>
                <p class="card-text">Preço compra: <?= htmlentities(utf8_encode($produto['preco_compra'])) ?></p>
                <p class="card-text">Preço Venda: <?= htmlentities(utf8_encode($produto['preco_venda'])) ?></p>
                <p class="card-text">Quantidade Disponível: <?= htmlentities(utf8_encode($produto['quantidade_disponível'])) ?></p>
                <p class="card-text">Liberado p/ venda: <?= htmlentities(utf8_encode($produto['liberado_venda'])) ?></p>
                <p class="card-text">ID da categoria: <?= htmlentities(utf8_encode($produto['id_categoria'])) ?></p>
            </div>
        </div>
<?php    }
else :
    echo "Não há produtos";
endif;
?>