<link href="<?= base_url(); ?>assets/css/menu.css" rel="stylesheet">

<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
  <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button"
  data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
  aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<a class="navbar-brand" href="<?= base_url('usuario/'.$this->session->userdata('tipo_usuario')); ?>">
  <span class="fa fa-home" aria-hidden="true"></span> Home
</a>

<div class="collapse navbar-collapse" id="navbarsExampleDefault">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item type_color">
      <a class="nav-link type_color" href="<?= base_url('usuario/atualizar/'.$this->session->userdata('idUsuario')); ?>">
        <span class="fa fa-user-circle type_color" aria-hidden="true"></span> Perfil
      </a>
    </li>
  </ul>

  <div class="mt-2 mt-md-0">
    <a class="btn btn-danger mr-sm-2 cursor" style="color: white;" data-toggle="modal" data-target="#myModalLogout">
      <span class="fa fa-sign-out" aria-hidden="true"></span> Logout
    </a>
  </div>
</div>
</nav>

<!-- Modal Logout-->
<div class="modal fade" id="myModalLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4> Encerrar sessão </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja sair?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger cursor type_color" data-dismiss="modal"> Não </button>
        <a class="btn btn-primary" href="<?= base_url(); ?>usuario/logout"> Sim </a>
      </div>
    </div>
  </div>
</div>
