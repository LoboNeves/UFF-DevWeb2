<p></p>
<hr>
<h3>Excluir Cliente</h3>
<form action="index.php" method="POST">
  <input type="hidden" name="id" id="id" value="<?= $cliente->getId() ?>">
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="nome" class="form-control" id="nome" name="nome" value="<?= $cliente->getNome() ?>">
  </div>
  <div class="form-group">
    <label for="CPF">CPF</label>
    <input type="cpf" class="form-control" id="cpf" name="cpf" value="<?= $cliente->getCpf() ?>">
  </div>
  <div class="form-group">
    <label for="Endereço">Endereço</label>
    <input type="endereco" class="form-control" id="endereco" name="endereco" value="<?= $cliente->getEndereco() ?>">
  </div>
  <div class="form-group">
    <label for="Bairro">Bairro</label>
    <input type="bairro" class="form-control" id="bairro" name="bairro" value="<?= $cliente->getBairro() ?>">
  </div>
  <div class="form-group">
    <label for="Cidade">Cidade</label>
    <input type="cidade" class="form-control" id="cidade" name="cidade" value="<?= $cliente->getCidade() ?>">
  </div>
  <div class="form-group">
    <label for="UF">UF</label>
    <input type="uf" class="form-control" id="uf" name="uf" value="<?= $cliente->getUf() ?>">
  </div>
  <div class="form-group">
    <label for="CEP">CEP</label>
    <input type="cep" class="form-control" id="cep" name="cep" value="<?= $cliente->getCep() ?>">
  </div>
  <div class="form-group">
    <label for="Telefone">Telefone</label>
    <input type="telefone" class="form-control" id="telefone" name="telefone" value="<?= $cliente->getTelefone() ?>">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= $cliente->getEmail() ?>">
  </div>
  <button type="submit" name="bt_acao" value="excluir" class="btn btn-primary">Confirmar Exclusão</button>
</form>