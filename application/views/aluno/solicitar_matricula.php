<link href="<?= base_url(); ?>assets/css/aluno.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Enviar Solicitação de Matrícula </h1>
  </div>
  <div class="col-md-12">
    <div class="form-control col-md-6">
      <form action="<?= base_url(); ?>aluno/salvar_solicitacao_disciplina" method="post">
        <input type="hidden" id="idDisciplina" name="idDisciplina" value="<?= $disciplina[0]->idDisciplina; ?>">
        <input type="hidden" id="idProfDisciplina" name="idProfDisciplina" value="<?= $disciplina[0]->idProfessor; ?>">
        <div class="row">
          <div class="col-md-12">
            <label for="nomeProfessor" class="padding"> <h6> Nome do Professor: </h6> </label>
            <input type="text" class="form-control camp" id="nomeProfessor" name="nomeProfessor"
            value="<?= $this->load->library('application/controllers/aluno')->aluno->get_Nome_Professor($disciplina[0]->idProfessor); ?>" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="nomeDisciplina" class="paddingUp"> <h6> Disciplina Solicitada: </h6> </label>
            <input type="text" class="form-control" id="nomeDisciplina" name="nomeDisciplina" value="<?= $disciplina[0]->nome_disciplina; ?>" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="justificativa_aluno" class="paddingUp"> <h6> Justificativa do Aluno: </h6> </label>
            <textarea class="form-control justificativa" id="justificativa_aluno" name="justificativa_aluno" required></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a class="paddingButton btn btn-danger left" href="<?= base_url(); ?>aluno/matricular_disciplina"> Cancelar </a>
            <button type="submit" class="paddingButton btn btn-success right cursor">
              <span class="fa fa-paper-plane" aria-hidden="true"></span> Enviar
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
</div>
</div>
