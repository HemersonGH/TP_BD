<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-10">
    <h1 class="page-header"> Disciplinas </h1>
  </div>

  <div class="col-md-2">
    <a class="btn btn-primary btn-block font" href="<?= base_url(); ?>professor/criar_disciplina">
      <span class="fa fa-plus-square" aria-hidden="true"></span> Criar Disciplina
    </a>
  </div>

  <!-- <div class="col-md-12" style="padding-bottom: 10px">
  <form action="usuario/pesquisar" method="post">
  <div class="row">
  <div class="col-md-10">
  <input type="text" class="form-control" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
  </div>
  <div class="col-md-2">
  <button type="submit" class="btn btn-success btn-block">Pesquisar</button>
  </div>
  </div>
  </form>
  </div> -->

  <div class="padding col-md-12">
    <h5> Minhas Disciplinas </h5>
    <table class="table table-striped">
      <tr>
        <th> Código da Disciplina </th>
        <th> Disciplina </th>
        <th> Nº de Conjuntos de Atividades </th>
        <th> Status </th>
        <th> Ações </th>
      </tr>
      <?php foreach ($disciplinas as $disciplina) { ?>
        <tr>
          <td> <?= $disciplina->codigo_disciplina; ?> </td>
          <td> <?= $disciplina->nome_disciplina; ?> </td>
          <td> <?= $this->load->library('application/controllers/professor')->professor->get_Qtd_Conjunto_Atividades($disciplina->idDisciplina); ?> </td>
          <td> <?= $disciplina->status_disciplina == 1 ? 'Em Planejamento':($disciplina->status_disciplina == 2 ? 'Disponível':'Finalizada'); ?> </td>
          <td>
            <a data-tooltip="tooltip" title="Visualizar disciplina" href="<?= base_url('professor/visualizar_disciplina/'.$disciplina->idDisciplina); ?>">
              <span class="fa fa-eye eye mr-2" aria-hidden="true"></span>
            </a>
            <?php if ($disciplina->status_disciplina == 1): ?>
              <a data-tooltip="tooltip" title="Adicionar conjuntos de atividades para a disciplina" href="<?= base_url('professor/adicionar_conjunto_atividade/'.$disciplina->idDisciplina); ?>">
                <span class="fa fa-folder folder mr-2" aria-hidden="true"></span>
              </a>
            <?php else: ?>
              <span class="fa fa-folder mr-2 color_disabled" aria-hidden="true" data-tooltip="tooltip" title="Não é possível adicionar conjunto de atividades pois a disciplina está disponível ou finalizada"></span>
            <?php endif; ?>
            <?php if ($disciplina->status_disciplina != 0): ?>
              <a data-tooltip="tooltip" title="Editar disciplina" href="<?= base_url('professor/atualizar_disciplina/'.$disciplina->idDisciplina); ?>">
                <span class="fa fa-pencil pencil mr-2" aria-hidden="true"></span>
              </a>
            <?php else: ?>
              <!-- <span class="fa fa-pencil color_disabled mr-2" aria-hidden="true" data-tooltip="tooltip" title="Edição bloqueada"></span> -->
            <?php endif; ?>
            <span class="fa fa-remove remove mr-2 cursor" title="Excluir disciplina" aria-hidden="true" data-tooltip="tooltip"
              onclick="confimaExcluirDisciplina(<?= $disciplina->idDisciplina; ?>)" data-toggle="modal" data-target="#myModalExcluirDisciplina">
            </span>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <script type="text/javascript">
  function confimaExcluirDisciplina(id) {
    document.getElementById("idDisciplina").value = id;
  }
  </script>

  <script>
  $(document).ready(function(){
    $('[data-tooltip="tooltip"]').tooltip();
  });
  </script>

  <!-- Modal Excluir Disciplina -->
  <div class="modal fade" id="myModalExcluirDisciplina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form class="" action="<?= base_url(); ?>professor/excluir_disciplina" method="post">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4> Excluir Disciplina </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Tem certeza que deseja excluir essa disciplina?
          </div>
          <div class="modal-footer">
            <input type="hidden" id="idDisciplina" name="idDisciplina">
            <button type="button" class="btn btn-danger cursor" data-dismiss="modal"> Não </button>
            <button type="submit" class="btn btn-primary cursor"> Sim </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</main>
</div>
</div>
