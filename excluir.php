<p></p>
<hr>
<h3>Excluir Usuário</h3>
<form action="index.php" method="POST">
  <input type="hidden" name="id" id="id" value="<?= $usuario->getId() ?>">
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="nome" readonly class="form-control" id="nome" name="nome" value="<?= $usuario->getNome() ?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" readonly class="form-control" id="email" name="email" value="<?= $usuario->getEmail() ?>">
  </div>
  <button type="submit" name="bt_acao" value="excluir" class="btn btn-primary">Confirmar Exclusão</button>
</form>