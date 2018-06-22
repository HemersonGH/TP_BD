<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-10">
    <h1 class="page-header"> <?= $conjunto_atividade[0]->nome_conjunto; ?> </h1>
  </div>
  <div class="col-md-2">
    <a class="btn btn-primary btn-block" href="<?= base_url('professor/adicionar_atividade/'.$conjunto_atividade[0]->idConjuntoAtividade); ?>">
      <span class="fa fa-plus-square" aria-hidden="true"> </span> Criar Atividade
    </a>
  </div>
