<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<div class="padding col-md-12">
  <h4> Conjuntos de Atividades Adicionados </h4>
  <table class="table table-striped">
    <tr>
      <th> Nome do Conjunto </th>
      <th> Nº de Atividades </th>
      <th> Ações </th>
    </tr>
    <?php foreach ($conjunto_atividades_da_disciplina as $conjuntos_atividades) { ?>
    <tr>
        <td> <?= $conjuntos_atividades->nome_conjunto; ?> </td>
        <td> <?= $this->load->library('application/controllers/professor')->professor->get_Qtd_Atividades($conjuntos_atividades->idConjuntoAtividade); ?> </td>
        <td>
          <span class="fa fa-remove remove cursor" aria-hidden="true" data-tooltip="tooltip" title="Remover conjunto da disciplina"
          onclick="confirmarRemocaoConjAtividade(<?= $conjuntos_atividades->idConjuntoAtividade; ?>, <?= $conjuntos_atividades->idDisciplina; ?>)" data-toggle="modal" data-target="#myModalRemoverConjuntoAtividadeDisciplina">
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
function confirmarRemocaoConjAtividade(idConjuntoAtividadeRemover, idDisciplinaRemover) {
  document.getElementById("idConjuntoAtividadeRemover").value = idConjuntoAtividadeRemover;
  document.getElementById("idDisciplinaRemover").value = idDisciplinaRemover;
}
</script>

<!-- Modal Remover Conjunto Atividades da Disciplina -->
<div class="modal fade" id="myModalRemoverConjuntoAtividadeDisciplina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form action="<?= base_url(); ?>professor/remove_conjunto_atividade_disciplina" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4> Remover conjunto da disciplina </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja remover esse conjunto de atividades da disciplina?
        </div>
        <div class="modal-footer">
          <input type="hidden" id="idConjuntoAtividadeRemover" name="idConjuntoAtividadeRemover">
          <input type="hidden" id="idDisciplinaRemover" name="idDisciplinaRemover">
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
