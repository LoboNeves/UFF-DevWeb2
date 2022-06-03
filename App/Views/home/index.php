<?php
// listando os produtos
$produtos = $data['produtos'];
if (!empty($produtos)) :
    foreach ($produtos as $produto) { ?>
        <?php if (/*$produto['quantidade_disponivel'] > 0 &&*/ $produto['liberado_venda'] == "S") : ?>
            <p></p>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlentities(utf8_encode($produto['nome_produto'])) ?></h5>
                    <p class="card-text"><?= htmlentities(utf8_encode($produto['descricao'])) ?></p>
                </div>
            </div>
        <?php endif; ?>
<?php    }
else :
    echo "Não há produtos";
endif;
?>