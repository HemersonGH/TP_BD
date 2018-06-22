<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<div class="padding col-md-12">
  <h5> Atividades </h5>
  <table class="table table-striped">
    <tr>
      <th> Nome da Atividade </th>
      <th> Troféus </th>
      <th> Prazo </th>
      <th> Ações </th>
    </tr>
    <?php foreach ($atividades as $atividade) { ?>
      <tr>
        <td> <?= $atividade->nome_atividade; ?> </td>
        <td>
          <?php if ($atividade->trofeu_ouro == 0 && $atividade->trofeu_prata == 0 && $atividade->trofeu_bronze == 0): ?>
            Sem Troféus
          <?php endif; ?>
          <?php if ($atividade->trofeu_ouro == 1): ?>
            <span class="fa fa-trophy ouro mr-2" aria-hidden="true" data-tooltip="tooltip" title="Ouro"></span>
          <?php endif; ?>
          <?php if ($atividade->trofeu_prata == 1): ?>
            <span class="fa fa-trophy prata mr-2" aria-hidden="true" data-tooltip="tooltip" title="Prata"></span>
          <?php endif; ?>
          <?php if ($atividade->trofeu_bronze == 1): ?>
            <span class="fa fa-trophy bronze" aria-hidden="true" data-tooltip="tooltip" title="Bronze"></span>
          <?php endif; ?>
        </td>
        <td> <?= str_replace("-", "/", date('d-m-Y', strtotime($atividade->prazo_entrega))); ?> </td>
        <td>
          <a data-tooltip="tooltip" title="Editar atividade" href="<?= base_url('professor/atualizar_atividade/'.$atividade->idAtividade); ?>">
            <span class="fa fa-pencil pencil mr-1" aria-hidden="true"></span>
          </a>
          <span class="fa fa-remove remove cursor" aria-hidden="true" data-tooltip="tooltip" title="Excluir atividade"
            onclick="confirmarExcluirAtividade(<?= $atividade->idAtividade; ?>, <?= $atividade->idConjuntoAtividade; ?>)" data-toggle="modal" data-target="#myModalExcluirAtividade">
          </span>
        </td>
      </tr>
    <?php } ?>
</table>
</div>
</main>
</div>
</div>

<script>
$(document).ready(function(){
  $('[data-tooltip="tooltip"]').tooltip();
});
</script>

<script type="text/javascript">
function confirmarExcluirAtividade(idAtividadeExcluir, idConjuntoAtividadeExcluir) {
  document.getElementById("idAtividadeExcluir").value = idAtividadeExcluir;
  document.getElementById("idConjuntoAtividadeExcluir").value = idConjuntoAtividadeExcluir;
}
</script>

<!-- Modal Excluir Atividades -->
<div class="modal fade" id="myModalExcluirAtividade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="" action="<?= base_url(); ?>professor/excluir_atividade" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4> Excluir Atividade </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja excluir essa atividade?
        </div>
        <div class="modal-footer">
          <input type="hidden" id="idAtividadeExcluir" name="idAtividadeExcluir">
          <input type="hidden" id="idConjuntoAtividadeExcluir" name="idConjuntoAtividadeExcluir">
          <button type="button" class="btn btn-danger cursor" data-dismiss="modal"> Não </button>
          <button type="submit" class="btn btn-primary cursor"> Sim </button>
        </div>
      </div>
    </div>
  </form>
</div>
