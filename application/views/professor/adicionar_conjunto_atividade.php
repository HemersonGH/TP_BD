<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<div class="col-md-12">
  <form action="<?= base_url(); ?>professor/cadastrar_conjunto_atividade_disciplina" method="post">
    <div class="row">
      <div class="col-md-4">
        <input type="hidden" id="idDisciplina" name="idDisciplina" value="<?= $disciplina[0]->idDisciplina; ?>">
        <label for="idConjuntoAtividade"> <h5> Conjuntos de Atividades: </h5> </label>
        <select class="form-control paddingBotton" id="idConjuntoAtividade" name="idConjuntoAtividade" onchange="verificaValor()" required>
          <?php if ($conjunto_atividades_sem_disciplina == null): ?>
            <option> </option>
            <option value="0"> Sem dados </option>
          <?php else: ?>
            <?php foreach ($conjunto_atividades_sem_disciplina as $conjunto_atividades): ?>
              <option value="<?= $conjunto_atividades->idConjuntoAtividade?> "> <?= $conjunto_atividades->nome_conjunto; ?> </option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block paddingButtonAdd cursor" id="add" name="add"> Adicionar </button>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">
function verificaValor() {
  if (document.getElementById("idConjuntoAtividade").value == 0) {
    document.getElementById("add").disabled = true;
  } else {
    document.getElementById("add").disabled = false;
  }
}
</script>

<script>
$(document).ready(function(){
  $('[data-tooltip="tooltip"]').tooltip();
});
</script>
