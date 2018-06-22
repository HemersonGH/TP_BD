<link href="<?= base_url(); ?>assets/css/aluno.css" rel="stylesheet">

<div class="col-md-12">
  <div class="form-control col-md-6 paddingBotton">
    <form action="<?= base_url(); ?>aluno/salvar_atividade_enviada" enctype="multipart/form-data" method="post">
      <input type="hidden" id="idAtividade" name="idAtividade" value="<?= $atividadeEnviar[0]->idAtividade; ?>">
      <input type="hidden" id="idDisciplina" name="idDisciplina" value="<?= $idDisciplina; ?>">
      <div class="row">
        <div class="col-md-12">
          <label for="nomeAtividade" class="padding"> <h6> Nome da Atividade: </h6> </label>
          <input type="text" class="form-control camp" id="nomeAtividade" name="nomeAtividade" value="<?= $atividadeEnviar[0]->nome_atividade; ?>" disabled>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="data" class="paddingUp"> <h6> Prazo de Entrega: </h6> </label>
          <input type="date" class="form-control" id="data" name="data" value="<?= date('Y-m-d', strtotime($atividadeEnviar[0]->prazo_entrega)); ?>" disabled>
        </div>
        <div class="col-md-6">
          <label for="trofeu" class="paddingUp"> <h6> Troféus: </h6> </label>
          <div class="row">
            <?php if ($atividadeEnviar[0]->trofeu_ouro == 1): ?>
              <div class="col-md-3">
                <span class="fa fa-trophy ouroEnvio" aria-hidden="true" data-tooltip="tooltip" title="Ouro"></span>
              </div>
            <?php endif; ?>
            <?php if ($atividadeEnviar[0]->trofeu_prata == 1): ?>
            <div class="col-md-3">
                <span class="fa fa-trophy prataEnvio" aria-hidden="true" data-tooltip="tooltip" title="Prata"></span>
            </div>
          <?php endif; ?>
          <?php if ($atividadeEnviar[0]->trofeu_bronze == 1): ?>
            <div class="col-md-3">
                <span class="fa fa-trophy bronzeEnvio" aria-hidden="true" data-tooltip="tooltip" title="Bronze"></span>
            </div>
          <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label for="descricao_atividade" class="paddingUp"> <h6> Descrição da Atividade: </h6> </label>
          <textarea class="form-control descricao_atividade" id="descricao_atividade" name="descricao_atividade" disabled><?= $atividadeEnviar[0]->descricao_atividade; ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label for="resposta" class="paddingUp"> <h6> Resposta: </h6> </label>
          <textarea class="form-control resposta" id="resposta" name="resposta" required></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label for="anexo" class="paddingUp"> <h6> <span class="fa fa-paperclip" aria-hidden="true"></span> Anexos: </h6> </label>
          <input type="file" class="form-control paddingBotton" id="anexo" name="anexo" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a class="paddingButton btn btn-danger left" href="<?= base_url('aluno/atividades_disciplina/'.$idDisciplina); ?>"> Cancelar </a>
          <button type="submit" class="paddingButton btn btn-success right cursor">
            <span class="fa fa-paper-plane" aria-hidden="true"></span> Enviar Atividade
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
$(document).ready(function(){
  $('[data-tooltip="tooltip"]').tooltip();
});
</script>
</main>
</div>
</div>
