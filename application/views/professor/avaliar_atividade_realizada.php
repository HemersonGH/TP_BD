<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> <?= $this->load->library('application/controllers/professor')->professor->get_Nome_Conjunto($atividadeRealizada[0]->idAtividade); ?> </h1>
  </div>
  <div class="col-md-12">
    <div class="form-control col-md-6 paddingBotton">
      <form action="<?= base_url(); ?>professor/salvar_avaliacao_atividade" method="post">
        <input type="hidden" id="idAtividade" name="idAtividade" value="<?= $atividadeRealizada[0]->idAtividade; ?>">
        <input type="hidden" id="idAluno" name="idAluno" value="<?= $atividadeRealizada[0]->idAluno; ?>">
        <div class="row">
          <div class="col-md-12">
            <label for="nomeAtividade" class="padding"> <h6> Nome da Atividade: </h6> </label>
            <input type="text" class="form-control camp" id="nomeAtividade" name="nomeAtividade" value="<?= $this->load->library('application/controllers/professor')->professor->get_Nome_Atividade($atividadeRealizada[0]->idAtividade); ?>" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="data" class="paddingUp"> <h6> Prazo de Entrega: </h6> </label>
            <input type="date" class="form-control" id="data" name="data" value="<?= date('Y-m-d', strtotime($this->load->library('application/controllers/professor')->professor->get_Prazo_Atividade($atividadeRealizada[0]->idAtividade))); ?>" disabled>
          </div>
          <div class="col-md-6">
            <label for="trofeu" class="paddingUp"> <h6> Troféus: </h6> </label>
            <div class="row">
              <?php if ($this->load->library('application/controllers/professor')->professor->get_Trofeu_Ouro($atividadeRealizada[0]->idAtividade)): ?>
                <div class="col-md-3">
                  <span class="fa fa-trophy ouroEnvio" aria-hidden="true" data-tooltip="tooltip" title="Ouro"></span>
                </div>
              <?php endif; ?>
              <?php if ($this->load->library('application/controllers/professor')->professor->get_Trofeu_Prata($atividadeRealizada[0]->idAtividade)): ?>
                <div class="col-md-3">
                  <span class="fa fa-trophy prataEnvio" aria-hidden="true" data-tooltip="tooltip" title="Prata"></span>
                </div>
              <?php endif; ?>
              <?php if ($this->load->library('application/controllers/professor')->professor->get_Trofeu_Bronze($atividadeRealizada[0]->idAtividade)): ?>
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
            <textarea class="form-control descricao_atividade" id="descricao_atividade" name="descricao_atividade" disabled><?= $this->load->library('application/controllers/professor')->professor->get_Descricao_Atividade($atividadeRealizada[0]->idAtividade); ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="resposta_aluno" class="paddingUp"> <h6> Resposta do Aluno: </h6> </label>
            <textarea class="form-control resposta" id="resposta_aluno" name="resposta_aluno" disabled><?= $atividadeRealizada[0]->resposta_aluno; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="anexo" class="paddingUp"> <h6> Arquivo Anexado: </h6> </label>
            <a class="btn btn-primary form-control" id="anexo" name="anexo" data-tooltip="tooltip" title="Baixar"
            href="<?= base_url('professor/downloadAnexo/'.$atividadeRealizada[0]->anexo.'/'.$atividadeRealizada[0]->idAtividade.'/'.$atividadeRealizada[0]->idAluno) ?>">
            <span class="fa fa-download mr-2" aria-hidden="true"></span> Documento
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="status_avaliacao" class="paddingUp"> <h6> Status: </h6> </label>
          <select class="form-control" name="status_avaliacao" id="status_avaliacao" required>
            <option></option>
            <option value="4"> Aceitar </option>
            <option value="3"> Recusar </option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="trofeu" class="paddingUp"> <h6> Atribuir Trofeu: </h6> </label>
          <select class="form-control" name="trofeu" id="trofeu" required>
            <option></option>
            <option value="1">
              <span class="fa fa-trophy ouro" aria-hidden="true"></span> Ouro
            </option>
            <option value="2">
              <span class="fa fa-trophy prata" aria-hidden="true"></span> Prata
            </option>
            <option value="3">
              <span class="fa fa-trophy bronze" aria-hidden="true"></span> Bronze
            </option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label for="resposta_professor" class="paddingUp"> <h6> Resposta do Professor: </h6> </label>
          <textarea class="form-control resposta" id="resposta_professor" name="resposta_professor" required></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a class="paddingButton btn btn-danger left" href="<?= base_url(); ?>professor/avaliacoes_atividades_realizada"> Cancelar </a>
          <button type="submit" class="paddingButton btn btn-success right cursor">
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
