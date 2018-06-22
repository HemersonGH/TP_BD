<link href="<?= base_url(); ?>assets/css/signin.css" rel="stylesheet">

<div class="col-md-12 text-center">
  <form class="form-signin" action="<?= base_url(); ?>usuario/logar" method="post">
    <h1 class="h3 mb-3 font-weight-normal">
      <span class="fa fa-linode" aria-hidden="true" style="font-size:35px;"></span> Sistema Gerenciador de Disciplinas
    </h1>
    <label for="email" class="sr-only"> Email </label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus> </br>
    <label for="password" class="sr-only"> Password </label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>
    <button class="btn btn-lg btn-primary btn-block color cursor" type="submit">
      <span class="fa fa-sign-in" aria-hidden="true"></span> Entrar
    </button>
    <a class="btn btn-secondary distance" role="button" aria-pressed="true" href="<?= base_url(); ?>usuario/registrar">
      <span class="fa fa-user-plus" aria-hidden="true"></span> Criar conta
    </a>
  </form>
  <!-- </div> --> <!-- Essa div fecha a div do login "<div class="col-md-12 text-center">" -->
  <!-- Arrumar isso depois  -->
