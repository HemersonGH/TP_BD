<link href="<?= base_url(); ?>assets/css/menu.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>professor/alunos_matriculado" style="color: black;">
            <h5> <span class="fa fa-group" aria-hidden="true"></span> Matrículas </h5>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>professor" style="color: black;">
            <h5> <span class="fa fa-th-list" aria-hidden="true"></span> Disciplinas </h5>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>professor/atividades" style="color: black;">
            <h5> <span class="fa fa-list-alt" aria-hidden="true"></span> Atividades </h5>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>professor/avaliacoes_atividades_realizada" style="color: black;">
            <h5> <span class="fa fa-gavel" aria-hidden="true"></span> Avaliações
              <?php if ($quantidadeAtividadesNaoAvaliada != 0): ?>
                <span class="badge badge-danger badge-pill sizeBadge">
                  <?= $quantidadeAtividadesNaoAvaliada; ?>
                </span>
              <?php endif; ?>
            </h5>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>professor/solicitacoes_disciplinas" style="color: black;">
            <h5> <span class="fa fa-bell" aria-hidden="true"></span> Solicitações
              <?php if ($quantidadeSolicitacoesPendentes != 0): ?>
                <span class="badge badge-danger badge-pill sizeBadge">
                  <?= $quantidadeSolicitacoesPendentes; ?>
                </span>
              <?php endif; ?>
            </h5>
          </a>
        </li>
      </ul>
    </nav>
