<link href="<?= base_url(); ?>assets/css/aluno.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Solicitar Matrícula </h1>
  </div>

  <div class="col-md-12">
    <form action="<?= base_url(); ?>aluno/solicitar_matricula" method="post">
      <div class="row">
        <div class="col-md-4">
          <label for="idDisciplina"> <h5> Disciplinas Disponíveis: </h5> </label>
          <select class="form-control paddingBotton" id="idDisciplina" name="idDisciplina" onchange="verificaValor()" required>
            <?php if ($disciplinas == null): ?>
              <option> </option>
              <option value="0"> Sem disciplinas disponíveis </option>
            <?php else: ?>
              <?php foreach ($disciplinas as $disciplina): ?>
                <option value="<?= $disciplina->idDisciplina?>"> <?= $disciplina->nome_disciplina; ?> </option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary btn-block paddingButtonSolicitacao" id="solicitacao" name="solicitacao"> Solicitar Matrícula </button>
        </div>
      </div>
    </form>
  </div>

  <script type="text/javascript">
  function verificaValor() {
    if (document.getElementById("idDisciplina").value == 0) {
      document.getElementById("solicitacao").disabled = true;
    } else {
      document.getElementById("solicitacao").disabled = false;
    }
  }
  </script>

  <script>
  $(document).ready(function(){
    $('[data-tooltip="tooltip"]').tooltip();
  });
  </script>
