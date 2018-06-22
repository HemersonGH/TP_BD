<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Avaliações de Atividades </h1>
  </div>

  <div class="padding col-md-12">
    <h5> Avaliações </h5>
    <div class="spaceBeetwenComponents">
      <table class="table table-striped">
        <tr>
          <th> Aluno </th>
          <th> Conjunto </th>
          <th> Atividade </th>
          <th> Status </th>
          <th> Ações </th>
        </tr>
        <?php foreach ($atividadesRealizada as $atividade) { ?>
          <tr>
            <td> <?= $this->load->library('application/controllers/professor')->professor->get_Nome_Aluno($atividade->idAluno); ?> </td>
            <td> <?= $this->load->library('application/controllers/professor')->professor->get_Nome_Conjunto($atividade->idAtividade); ?> </td>
            <td> <?= $this->load->library('application/controllers/professor')->professor->get_Nome_Atividade($atividade->idAtividade); ?> </td>
            <td>
              <?=
               $this->load->library('application/controllers/professor')->professor->get_Status_Atividade($atividade->idAtividade, $atividade->idAluno) == 2 ? 'Não Avaliada':
              ($this->load->library('application/controllers/professor')->professor->get_Status_Atividade($atividade->idAtividade, $atividade->idAluno) == 3 ? 'Recusada':'Aceita');
              ?>
            </td>
            <td>
              <?php if (($this->load->library('application/controllers/professor')->professor->get_Status_Atividade($atividade->idAtividade, $atividade->idAluno) == 2)): ?>
                <a data-tooltip="tooltip" title="Avaliar atividade" href="<?= base_url('professor/avaliar_atividade_realizada/'.$atividade->idAtividade.'/'.$atividade->idAluno); ?>">
                  <span class="fa fa-gavel pencil mr-2" aria-hidden="true"></span>
                </a>
              <?php else: ?>
                <span class="fa fa-gavel color_disabled mr-2" aria-hidden="true" data-tooltip="tooltip" title="Atividade já foi avaliada"></span>
              <?php endif; ?>
              <?php if (($this->load->library('application/controllers/professor')->professor->get_Status_Atividade($atividade->idAtividade, $atividade->idAluno) != 2)): ?>
                <a data-tooltip="tooltip" title="Editar avaliação" href="<?= base_url('professor/atualizar_avaliacao_atividade/'.$atividade->idAtividade.'/'.$atividade->idAluno); ?>">
                  <span class="fa fa-pencil pencil mr-2" aria-hidden="true"></span>
                </a>
              <?php else: ?>
                <span class="fa fa-pencil color_disabled mr-2" aria-hidden="true" data-tooltip="tooltip" title="Para editar, primeiro avalie a atividade"></span>
              <?php endif; ?>
              <span class="fa fa-remove remove mr-2 cursor" title="Excluir avaliação" aria-hidden="true" data-tooltip="tooltip"
                onclick="confimaExcluirAvaliacaoAtividade()" data-toggle="modal" data-target="#myModalAvaliacaoAtividade">
              </span>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>

  <script>
  $(document).ready(function(){
    $('[data-tooltip="tooltip"]').tooltip();
  });
  </script>

  <script type="text/javascript">
  function confimaExcluirAvaliacaoAtividade() {
    // document.getElementById("idDisciplina").value = id;
  }
  </script>

  <!-- Modal Excluir Atividade Realizada -->
  <div class="modal fade" id="myModalAvaliacaoAtividade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form class="" action="<?= base_url(); ?>professor/excluir_atividade_enviada" method="post">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4> Excluir Atividade </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Tem certeza que deseja excluir a atividade realizada?
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
</div>
</main>
</div>
</div>
