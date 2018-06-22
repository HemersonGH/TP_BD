<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Alunos Matriculados </h1>
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
    <h5> Meus Alunos </h5>
    <table class="table table-striped">
      <tr>
        <th> Nome do Aluno </th>
        <th> Código da Disciplina </th>
        <th> Disciplina </th>
        <th> Status </th>
        <th> Ações </th>
      </tr>
      <?php foreach ($alunosMatriculados as $aluno) { ?>
        <tr>
          <td> <?= $this->load->library('application/controllers/professor')->professor->get_Nome_Aluno($aluno->idAluno); ?> </td>
          <td> <?= $this->load->library('application/controllers/professor')->professor->get_Codigo_Disciplina($aluno->idDisciplina); ?> </td>
          <td> <?= $this->load->library('application/controllers/professor')->professor->get_Nome_Disciplina($aluno->idDisciplina); ?> </td>
          <td> <?= $aluno->status_participacao == 1 ? 'Matriculado' : 'Recusado'; ?> </td>
          <td>
            <a data-tooltip="tooltip" title="Excluir matrícula" href="<?= base_url('professor/excluir_matricula/'.$aluno->idAluno.'/'.$aluno->idDisciplina); ?>">
              <span class="fa fa-remove remove" aria-hidden="true"></span>
            </a>
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
