<link href="<?= base_url(); ?>assets/css/aluno.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Enviar Solicitação de Matrícula </h1>
  </div>
  <div class="col-md-12 paddingBotton">
    <div class="form-control col-md-6">
      <div class="row">
        <div class="col-md-12">
          <label for="nomeProfessor" class="padding"> <h6> Nome do Professor: </h6> </label>
          <input type="text" class="form-control camp" id="nomeProfessor" name="nomeProfessor"
          value="<?= $this->load->library('application/controllers/aluno')->aluno->get_Nome_Professor($solicitacao[0]->idProfessor); ?>" disabled>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label for="nomeDisciplina" class="padding paddingUp"> <h6> Disciplina Solicitada: </h6> </label>
          <input type="text" class="form-control" id="nomeDisciplina" name="nomeDisciplina" value="<?= $this->load->library('application/controllers/aluno')->aluno->get_Nome_Disciplina($solicitacao[0]->idDisciplina); ?>" disabled>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label for="justificativa_aluno" class="padding paddingUp"> <h6> Justificativa do Aluno: </h6> </label>
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
          <a class="paddingButton btn btn-danger left" href="<?= base_url(); ?>aluno/matricular_disciplina">
            <span class="fa fa-chevron-left" aria-hidden="true"></span> Voltar
          </a>
        </div>
      </div>
    </div>
  </div>
</main>
</div>
</div>
