<?php
// listando os artigos
$artigos = $data['artigos'];
if (!empty($artigos)) :
    foreach ($artigos as $artigo) { ?>
        <p></p>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= htmlentities(utf8_encode($artigo['titulo']))?></h5>
                <p class="card-text"><?= htmlentities(utf8_encode($artigo['conteudo']))?></p>
            </div>
        </div>
<?php    }
else :
    echo "Não há artigos";
endif;
?>