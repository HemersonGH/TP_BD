<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Nova Atividade </h1>
  </div>
  <div class="col-md-12">
    <div class="form-control col-md-6 paddingBotton">
      <form action="<?= base_url(); ?>professor/cadastrar_atividade" method="post">
        <input type="hidden" id="idConjuntoAtividade" name="idConjuntoAtividade" value="<?= $conjunto_atividade[0]->idConjuntoAtividade; ?>">
        <div class="tituloConjunto">
          <h4> <?= $conjunto_atividade[0]->nome_conjunto; ?> </h4>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="nome_atividade" class="paddingUp"> <h6> Nome: </h6> </label>
            <input type="text" class="form-control camp" id="nome_atividade" name="nome_atividade" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="data" class="paddingGG"> <h6> Prazo de Entrega: </h6> </label>
            <input type="date" class="form-control" id="data" name="data" required>
          </div>
          <div class="col-md-6">
            <label for="trofeu" class="paddingUp"> <h6> Troféus: </h6> </label>
            <div class="row">
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-3">
                    <span class="fa fa-trophy ouro" aria-hidden="true" data-tooltip="tooltip" title="Ouro"></span>
                    <input type="checkbox" class="checkTrofeu" name="trofeu[]" id="ouro" value="1">
                  </div>
                  <div class="col-md-3">
                    <span class="fa fa-trophy prata" aria-hidden="true" data-tooltip="tooltip" title="Prata"></span>
                    <input type="checkbox" class="checkTrofeu" name="trofeu[]" id="prata" value="2">
                  </div>
                  <div class="col-md-3">
                    <span class="fa fa-trophy bronze" aria-hidden="true" data-tooltip="tooltip" title="Bronze"></span>
                    <input type="checkbox" class="checkTrofeu" name="trofeu[]" id="bronze" value="3">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="descricao_atividade" class="paddingUp"> <h6> Descrição: </h6> </label>
            <textarea class="form-control descricao_atividade" id="descricao_atividade" name="descricao_atividade" required></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a class="paddingButton btn btn-danger left" href="<?= base_url('professor/atividades_conjunto/'.$conjunto_atividade[0]->idConjuntoAtividade); ?>"> Cancelar </a>
            <button type="submit" class="paddingButton btn btn-success right">
              <span class="fa fa-save" aria-hidden="true"></span> Salvar
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
