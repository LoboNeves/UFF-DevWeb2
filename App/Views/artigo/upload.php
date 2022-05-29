<div class="container mt-3">
  <h2>Upload Imagem</h2>
  <?php

  if (isset($data['erros']) && (!empty($data['erros']))) : ?>
    <div class="alert alert-danger" role="alert">
      <?php
      echo $data['erros'] . "<br>";
      ?>
    </div>
  <?php endif ?>
  <form action="<?= URL_BASE . '/Artigo/enviarImagem' ?>" method="Post" enctype="multipart/form-data">
  <input type="hidden" name="CSRF_token" value="<?=$_SESSION['CSRF_token'] ?>">
  <input type="hidden" name="id" value="<?=$data['id']?>">
    <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="arquivoimagem" name="arquivoimagem">
      <label class="custom-file-label" for="arquivoimagem">Escolha o arquivo de imagem</label>
    </div>

    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Enviar</button>
      <a class="btn btn-danger" href="<?= URL_BASE . '/Artigo' ?>">Cancelar</a>
    </div>
  </form>
</div>
