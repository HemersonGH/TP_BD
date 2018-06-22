<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Editar Atividade </h1>
  </div>
  <div class="col-md-12">
    <div class="form-control col-md-6 paddingBotton">
      <form action="<?= base_url(); ?>professor/salvar_atualizacao_atividade" method="post">
        <input type="hidden" id="idConjuntoAtividade" name="idConjuntoAtividade" value="<?= $atividade[0]->idConjuntoAtividade; ?>">
        <input type="hidden" id="idAtividade" name="idAtividade" value="<?= $atividade[0]->idAtividade; ?>">
        <div class="row">
          <div class="col-md-12">
            <label for="nome_atividade" class="padding"> <h6> Nome: </h6> </label>
            <input type="text" class="form-control camp" id="nome_atividade" name="nome_atividade" value="<?= $atividade[0]->nome_atividade; ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="data" class="paddingGG"> <h6> Prazo de Entrega: </h6> </label>
            <input type="date" class="form-control" id="data" name="data" value="<?= date('Y-m-d', strtotime($atividade[0]->prazo_entrega)); ?>" required>
          </div>
          <div class="col-md-6">
            <label for="trofeu" class="paddingUp"> <h6> Troféus: </h6> </label>
            <div class="row">
              <div class="col-md-3">
                <span class="fa fa-trophy ouro" aria-hidden="true" data-tooltip="tooltip" title="Ouro"></span>
                <input type="checkbox" class="checkTrofeu" name="trofeu[]" id="ouro" value="1" <?= $atividade[0]->trofeu_ouro == 1 ? 'checked':''; ?> >
              </div>
              <div class="col-md-3">
                <span class="fa fa-trophy prata" aria-hidden="true" data-tooltip="tooltip" title="Prata"></span>
                <input type="checkbox" class="checkTrofeu" name="trofeu[]" id="prata" value="2" <?= $atividade[0]->trofeu_prata == 1 ? 'checked':''; ?> >
              </div>
              <div class="col-md-3">
                <span class="fa fa-trophy bronze" aria-hidden="true" data-tooltip="tooltip" title="Bronze"></span>
                <input type="checkbox" class="checkTrofeu" name="trofeu[]" id="bronze" value="3" <?= $atividade[0]->trofeu_bronze == 1 ? 'checked':''; ?> >
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="descricao_atividade" class="paddingUp"> <h6> Descrição: </h6> </label>
            <textarea class="form-control descricao_atividade" id="descricao_atividade" name="descricao_atividade" required><?= $atividade[0]->descricao_atividade; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a class="paddingButton btn btn-danger left" href="<?= base_url('professor/atividades_conjunto/'.$atividade[0]->idConjuntoAtividade); ?>"> Cancelar </a>
            <button type="submit" class="paddingButton btn btn-success right">
              <span class="fa fa-save" aria-hidden="true"></span> Salvar
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
</div>
</div>
