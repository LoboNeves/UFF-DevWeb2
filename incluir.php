<p></p>
<hr>
<h3>Incluir Cliente</h3>
<?php if(!empty($erro)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $erro ?>
  </div>
<?php endif?>
<form action="index.php" method="POST">
    <div class="form-group">
      <label for="Nome">Nome</label>
      <input type="nome" class="form-control" id="nome" name="nome">
    </div>
    <div class="form-group">
      <label for="CPF">CPF</label>
      <input type="cpf" class="form-control" id="cpf" name="cpf">
    </div>
    <div class="form-group">
      <label for="Endereço">Endereço</label>
      <input type="endereco" class="form-control" id="endereco" name="endereco">
    </div>
    <div class="form-group">
      <label for="Bairro">Bairro</label>
      <input type="bairro" class="form-control" id="bairro" name="bairro">
    </div>
    <div class="form-group">
      <label for="Cidade">Cidade</label>
      <input type="cidade" class="form-control" id="cidade" name="cidade">
    </div>
    <div class="form-group">
      <label for="UF">UF</label>
      <input type="uf" class="form-control" id="uf" name="uf">
    </div>
    <div class="form-group">
      <label for="CEP">CEP</label>
      <input type="cep" class="form-control" id="cep" name="cep">
    </div>
    <div class="form-group">
      <label for="Telefone">Telefone</label>
      <input type="telefone" class="form-control" id="telefone" name="telefone">
    </div>
    <div class="form-group">
      <label for="Email">Email</label>
      <input type="email" class="form-control" id="email" name="email" >
    </div>
    <button type="submit" name="bt_acao" value="incluir" class="btn btn-primary">incluir</button>
  </form>