<link href="<?= base_url(); ?>assets/css/aluno.css" rel="stylesheet">

<div class="padding col-md-12">

  <?php foreach ($conjuntos_disciplina as $conjuntos_atividades) { ?>
    <div class="spaceBeetwenComponents">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="colorHeader text-center"> Troféus </th>
            <th class="colorHeader text-center"> <?= $conjuntos_atividades->nome_conjunto;?> </th>
            <th class="colorHeader text-center"> Prazo de Entrega </th>
            <th class="colorHeader text-center"> Status </th>
            <th class="colorHeader text-center"> Ações </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->load->library('application/controllers/aluno')->aluno->get_Atividades($conjuntos_atividades->idConjuntoAtividade) as $atividade) { ?>
            <tr>
              <td class="text-center">
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
              <td class="text-center"> <?= $atividade->nome_atividade; ?> </td>
              <td class="text-center"> <?= str_replace("-", "/", date('d-m-Y', strtotime($atividade->prazo_entrega))); ?> </td>
              <td class="text-center">
                <?=
                $this->load->library('application/controllers/aluno')->aluno->get_Status_Atividade($atividade->idAtividade, $this->session->userdata('idUsuario')) == 1 ? 'Pendente':
                ($this->load->library('application/controllers/aluno')->aluno->get_Status_Atividade($atividade->idAtividade, $this->session->userdata('idUsuario')) == 2 ? 'Aguardando Avaliação':
                ($this->load->library('application/controllers/aluno')->aluno->get_Status_Atividade($atividade->idAtividade, $this->session->userdata('idUsuario')) == 3 ? 'Recusada':'Aceita'));
                ?>
              </td>
              <td class="text-center">
                <?php if ($this->load->library('application/controllers/aluno')->aluno->get_Status_Atividade($atividade->idAtividade, $this->session->userdata('idUsuario')) != 1): ?>
                  <span class="fa fa-paper-plane color_disabled mr-2" aria-hidden="true" data-tooltip="tooltip" title="Atividade já realizada"></span>
                <?php else: ?>
                  <a data-tooltip="tooltip" title="Enviar atividade" href="<?= base_url('aluno/enviar_atividade/'.$atividade->idAtividade); ?>">
                    <span class="fa fa-paper-plane paper_plane mr-2" aria-hidden="true"></span>
                  </a>
                <?php endif; ?>

                <?php if (($this->load->library('application/controllers/aluno')->aluno->get_Status_Atividade($atividade->idAtividade, $this->session->userdata('idUsuario')) == 1)): ?>
                  <span class="fa fa-pencil color_disabled mr-2" aria-hidden="true" data-tooltip="tooltip" title="Para editar, primeiro envie a atividade"></span>
                <?php else: ?>
                  <a data-tooltip="tooltip" title="Editar envio" href="<?= base_url('aluno/atualizar_atividade_realizada/'); ?>">
                    <span class="fa fa-pencil pencil mr-2" aria-hidden="true"></span>
                  </a>
                <?php endif; ?>
                <span class="fa fa-remove remove mr-2 cursor" title="Excluir Atividade" aria-hidden="true" data-tooltip="tooltip"
                onclick="confimaExcluirAtividadeRealizada()" data-toggle="modal" data-target="#myModalAtividadeRealizada">
              </span>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php } ?>

<script>
$(document).ready(function(){
  $('[data-tooltip="tooltip"]').tooltip();
});
</script>

<script type="text/javascript">
function confimaExcluirAtividadeRealizada() {
  // document.getElementById("idDisciplina").value = id;
}
</script>

<!-- Modal Excluir Atividade Realizada -->
<div class="modal fade" id="myModalAtividadeRealizada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="" action="<?= base_url(); ?>aluno/excluir_atividade_enviada" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4> Excluir Atividade </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja excluir a atividade realizada?
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
</div>
</main>
</div>
</div>
