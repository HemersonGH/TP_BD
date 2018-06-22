<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Visualizar Solicitação </h1>
  </div>
  <div class="col-md-12">
    <div class="form-control col-md-6 paddingBotton">
      <form action="<?= base_url(); ?>professor/salvar_avaliacao_solicitacao" method="post">
        <input type="hidden" id="idAluno" name="idAluno" value="<?= $solicitacao[0]->idAluno; ?>">
        <input type="hidden" id="idDisciplina" name="idDisciplina" value="<?= $solicitacao[0]->idDisciplina; ?>">
        <div class="row">
          <div class="col-md-12">
            <label for="nome_aluno" class="padding"> <h6> Nome do Aluno: </h6> </label>
            <input type="text" class="form-control camp" id="nome_aluno" name="nome_aluno" value="<?= $this->load->library('application/controllers/professor')->professor->get_Nome_Aluno($solicitacao[0]->idAluno); ?>" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="disciplina_solicitada" class="paddingUp"> <h6> Disciplina Solicitada: </h6> </label>
            <input type="text" class="form-control" id="disciplina_solicitada" name="disciplina_solicitada" value="<?= $this->load->library('application/controllers/professor')->professor->get_Nome_Disciplina($solicitacao[0]->idDisciplina); ?>" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="justificativa_aluno" class="paddingUp"> <h6> Justificativa do Aluno: </h6> </label>
            <textarea class="form-control justificativa" id="justificativa_aluno" name="justificativa_aluno" disabled><?= $solicitacao[0]->justificativa_aluno; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="status_solicitacao" class="padding paddingUp"> <h6> Status da Solicitação: </h6> </label>
            <input type="text" class="form-control" name="status_solicitacao" value="<?= $solicitacao[0]->status_solicitacao == 1 ? 'Aguardando Avaliação' : ($solicitacao[0]->status_solicitacao == 2 ? 'Aceita' : 'Recusada') ?>" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a class="paddingButton btn btn-danger left" href="<?= base_url(); ?>professor/solicitacoes_disciplinas">
              <span class="fa fa-chevron-left" aria-hidden="true"></span> Voltar
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
</div>
</div>
