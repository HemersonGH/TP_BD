<link href="<?= base_url(); ?>assets/css/aluno.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Disciplinas </h1>
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
    <h5> Disciplinas Matrículadas </h5>
    <table class="table table-striped">
      <tr>
        <th> Professor </th>
        <th> Disciplina </th>
        <th> Código da Disciplina </th>
        <th> Status da Disciplina </th>
        <th> Ações </th>
      </tr>
      <?php foreach ($disciplinas_matriculado as $disciplina) { ?>
        <tr>
          <td> <?= $this->load->library('application/controllers/aluno')->aluno->get_Nome_Professor($disciplina->idDisciplina); ?> </td>
          <td> <?= $this->load->library('application/controllers/aluno')->aluno->get_Nome_Disciplina($disciplina->idDisciplina); ?> </td>
          <td> <?= $this->load->library('application/controllers/aluno')->aluno->get_Cod_Disciplina($disciplina->idDisciplina); ?> </td>
          <td> <?= $this->load->library('application/controllers/aluno')->aluno->get_Status_Disciplina($disciplina->idDisciplina) == 2 ? 'Disponível':'Finalizada'; ?> </td>
          <td>
            <a data-tooltip="tooltip" title="Realizar atividades" data-tooltip="tooltip" href="<?= base_url('aluno/atividades_disciplina/'.$disciplina->idDisciplina); ?>">
              <span class="fa fa-pencil-square-o pencil_square mr-2" aria-hidden="true"></span>
            </a>
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
</main>
</div>
</div>
