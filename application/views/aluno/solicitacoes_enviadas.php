  <div class="padding col-md-12">
  <h4> Solicitações de Matrículas Enviadas </h4>
  <table class="table table-striped">
    <tr>
      <th> Professor </th>
      <th> Disciplina </th>
      <th> Status da Solicitação </th>
      <th> Ações </th>
    </tr>
    <?php foreach ($solicitacoes as $solicitacao) { ?>
      <tr>
        <td> <?= $this->load->library('application/controllers/aluno')->aluno->get_Nome_Professor($solicitacao->idProfessor); ?> </td>
        <td> <?= $this->load->library('application/controllers/aluno')->aluno->get_Nome_Disciplina($solicitacao->idDisciplina); ?> </td>
        <td> <?= $solicitacao->status_solicitacao == 1 ? 'Aguardando Avaliação':($solicitacao->status_solicitacao == 2 ? 'Aceita':'Recusado'); ?> </td>
        <td>
          <a data-tooltip="tooltip" title="Visualizar solicitação" href="<?= base_url('aluno/visualizar_solicitacao/'.$solicitacao->idDisciplina); ?>">
            <span class="fa fa-eye eye mr-2" aria-hidden="true"></span>
          </a>
          <?php if ($solicitacao->status_solicitacao != 1): ?>
            <span class="fa fa-pencil pencil color_disabled mr-2" aria-hidden="true" data-tooltip="tooltip" title="Edição bloqueada"></span>
          <?php else: ?>
            <a data-tooltip="tooltip" title="Editar solicitação" href="<?= base_url('aluno/editar_solicitacao/'.$solicitacao->idDisciplina); ?>">
              <span class="fa fa-pencil pencil mr-2" aria-hidden="true"></span>
            </a>
          <?php endif; ?>
          <span class="fa fa-remove remove mr-2 cursor" title="Excluir Solicitação" aria-hidden="true" data-tooltip="tooltip"
            onclick="confimaExcluirSolicitacao(<?= $solicitacao->idDisciplina; ?>)" data-toggle="modal" data-target="#myModalExcluirSolicitacao">
          </span>
        </td>
      </tr>
    <?php } ?>
  </table>

  <script>
    $(document).ready(function(){
      $('[data-tooltip="tooltip"]').tooltip();
    });
  </script>

  <script type="text/javascript">
    function confimaExcluirSolicitacao(id) {
      document.getElementById("idDisciplinaSolicitacao").value = id;
    }
  </script>

  <!-- Modal Excluir Solicitação -->
  <div class="modal fade" id="myModalExcluirSolicitacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form class="" action="<?= base_url(); ?>aluno/excluir_solicitacao" method="post">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4> Excluir Solicitação </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Tem certeza que deseja excluir essa solicitação de matrícula?
          </div>
          <div class="modal-footer">
            <input type="hidden" id="idDisciplinaSolicitacao" name="idDisciplinaSolicitacao">
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
