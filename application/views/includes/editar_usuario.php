<link href="<?= base_url(); ?>assets/css/editar_usuario.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Editar Dados </h1>
  </div>
  <div class="col-md-12">
    <div class="col-md-6 form-control">
      <form class="paddingForm" action="<?= base_url(); ?>usuario/salvar_atualizacao" method="post">
        <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $usuario[0]->idUsuario; ?>">
        <div class="row">
          <div class="col-md-12">
            <label for="name"> <h6> Nome: </h6> </label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $usuario[0]->nome; ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="cpf" class="paddingUp"> <h6> CPF: </h6> </label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="<?= $usuario[0]->cpf; ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="data" class="paddingUp"> <h6> Data de Nascimento: </h6> </label>
            <input type="date" class="form-control" id="data" name="data" value="<?= date('Y-m-d', strtotime($usuario[0]->data)); ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="email" class="paddingUp"> <h6> Email: </h6> </label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $usuario[0]->email; ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="password" class="paddingUp"> <h6> Senha: </h6> </label>
            <input type="button" class="btn btn-default btn-block" value="Atualizar Senha" data-toggle="modal" data-target="#myModal">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a class="paddingButton btn btn-danger left" href="<?= base_url('usuario/'.$this->session->userdata('tipo_usuario')); ?>" > Cancelar </a>
            <button type="submit" class="paddingButton btn btn-success right cursor">
              <span class="fa fa-save" aria-hidden="true"></span> Salvar
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

</main>
</div>
</div>

<!-- Modal Editar Senha-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form class="" action="<?= base_url(); ?>usuario/salvar_senha" method="post">
      <input type="hidden" id="idUsuarioSenha" name="idUsuarioSenha" value="<?= $usuario[0]->idUsuario; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h4> Atualizar Senha </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="senha_antiga"> Senha Antiga: </label>
              <input type="password" class="form-control" name="senha_antiga" id="senha_antiga" required>
            </div>
            <div class="col-md-12 form-group">
              <label for="senha_nova"> Nova Senha: </label>
              <input type="password" class="form-control" name="senha_nova" id="senha_nova" onkeyup="checkPassword()">
            </div>
            <div class="col-md-12 form-group">
              <label for="senha_confirmar"> Confirmar Senha: </label>
              <input type="password" class="form-control" name="senha_confirmar" id="senha_confirmar" onkeyup="checkPassword()">
            </div>
            <div class="col-md-12 form-group">
              <div id="divcheck">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fechar </button>
          <button type="submit" class="btn btn-primary" id="enviarSenha" disabled>
            <span class="fa fa-save" aria-hidden="true"></span> Salvar
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function() {
  $("#senha_nova").keyup(checkPassword);
  $("#senha_confirmar").keyup(checkPassword);
});
function checkPassword() {
  var password = $("#senha_nova").val();
  var confirmPassword = $("#senha_confirmar").val();

  if (password == '' || '' == confirmPassword) {
    $("#divcheck").html("<span style='color:red'> Campo Senha vazio! </span>");
    document.getElementById("enviarSenha").disabled = true;
  } else if (password != confirmPassword) {
    $("#divcheck").html("<span style='color:red'> Senhas não conferem! </span>");
    document.getElementById("enviarSenha").disabled = true;
  } else {
    $("#divcheck").html("<span style='color:green'> Senhas conferem! </span>");
    document.getElementById("enviarSenha").disabled = false;
  }
}
</script>
