<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header "> Solicitações de Matrícula </h1>
  </div>

  <div class="padding col-md-12">
    <h5> Solicitações </h5>
    <table class="table table-striped">
      <tr>
        <th> Nome do Aluno </th>
        <th> Disciplina </th>
        <th> Status </th>
        <th> Ações </th>
      </tr>
      <?php foreach ($solicitacoes_disciplinas as $solicitacao) { ?>
        <tr>
          <td> <?= $this->load->library('application/controllers/professor')->professor->get_Nome_Aluno($solicitacao->idAluno); ?> </td>
          <td> <?= $this->load->library('application/controllers/professor')->professor->get_Nome_Disciplina($solicitacao->idDisciplina); ?> </td>
          <td> <?= $solicitacao->status_solicitacao == 1 ? 'Não Avaliada':($solicitacao->status_solicitacao == 2 ? 'Aceita':'Recusada'); ?> </td>
          <td>
            <?php if ($solicitacao->status_solicitacao == 1): ?>
              <a data-tooltip="tooltip" title="Visualizar Solicitação" href="<?= base_url('professor/visualizar_solicitacao/'.$solicitacao->idAluno.'/'.$solicitacao->idDisciplina); ?>">
                <span class="fa fa-eye eye mr-2" aria-hidden="true"></span>
              </a>
            <?php endif; ?>
            <a data-tooltip="tooltip" title="Aceitar Solicitação" href="<?= base_url('professor/aceitar_solicitacao/'.$solicitacao->idAluno.'/'.$solicitacao->idDisciplina); ?>">
              <span class="fa fa-check handshake mr-2" aria-hidden="true"></span>
            </a>
            <a data-tooltip="tooltip" title="Recusar Solicitação" href="<?= base_url('professor/recusar_solicitacao/'.$solicitacao->idAluno.'/'.$solicitacao->idDisciplina); ?>">
              <span class="fa fa-ban remove" aria-hidden="true"></span>
            </a>
          </td>
        </tr>
      <?php } ?>
    </table>

    <script>
      $(document).ready(function(){
        $('[data-tooltip="tooltip"]').tooltip();
      });
    </script>
    </div>
  </main>
</div>
</div>
