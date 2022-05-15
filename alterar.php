<p></p>
<hr>
<h3>Alterar Usuário</h3>
<?php if(!empty($erro)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $erro ?>
  </div>
<?php endif?>
<form action="index.php" method="POST">
  <input type="hidden" name="id" id="id" value="<?= $usuario->getId() ?>">
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="nome" class="form-control" id="nome" name="nome" value="<?= $usuario->getNome() ?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?= $usuario->getEmail() ?>" >
    </div>
    <button type="submit" name="bt_acao" value="alterar" class="btn btn-primary">alterar</button>
  </form>