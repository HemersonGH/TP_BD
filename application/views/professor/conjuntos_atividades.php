<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-10">
    <h1 class="page-header"> Atividades </h1>
  </div>

  <div class="col-md-2">
    <button class="btn btn-primary btn-block cursor" data-toggle="modal" data-target="#myModalCriarConjunto">
      <span class="fa fa-plus-square" aria-hidden="true"> </span> Criar Conjunto
    </button>
  </div>

  <div class="padding col-md-12">
    <h5> Conjuntos de Atividades </h5>
    <table class="table table-striped">
      <tr>
        <th> Nome do Conjunto </th>
        <th> Nº de Atividades </th>
        <th> Ações </th>
      </tr>
      <?php foreach ($conjunto_atividades as $conjunto_atividade) { ?>
        <tr>
          <td> <?= $conjunto_atividade->nome_conjunto; ?> </td>
          <td> <?= $this->load->library('application/controllers/professor')->professor->get_Qtd_Atividades($conjunto_atividade->idConjuntoAtividade); ?> </td>
          <td>
            <a data-tooltip="tooltip" title="Adicionar atividade para o conjunto" href="<?= base_url('professor/atividades_conjunto/'.$conjunto_atividade->idConjuntoAtividade); ?>">
              <span class="fa fa-paste paste mr-2 " aria-hidden="true"> </span>
            </a>
            <span class="fa fa-pencil pencil mr-2 cursor" aria-hidden="true" data-tooltip="tooltip" title="Editar conjunto"
              onclick="editarConjunto(<?= $conjunto_atividade->idConjuntoAtividade; ?>, '<?= $conjunto_atividade->nome_conjunto; ?>')" data-toggle="modal" data-target="#myModalEditarConjunto">
            </span>
            <span class="fa fa-remove remove mr-2 cursor" aria-hidden="true" data-tooltip="tooltip" title="Excluir conjunto"
              onclick="confimarExcluirConjunto(<?= $conjunto_atividade->idConjuntoAtividade; ?>)" data-toggle="modal" data-target="#myModalExcluirConjunto">
            </span>
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

<script type="text/javascript">
function editarConjunto(idEditar, NomeConjunto) {
  document.getElementById("idConjuntoAtividadeEditar").value = idEditar;
  document.getElementById("idNomeConjuntoEditar").value = NomeConjunto;
}
</script>

<script type="text/javascript">
function confimarExcluirConjunto(idExcluir) {
  document.getElementById("idConjuntoAtividadeExcluir").value = idExcluir;
}
</script>

<!-- Modal Criar Conjunto de Atividades-->
<div class="modal fade" id="myModalCriarConjunto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form class="" action="<?= base_url(); ?>professor/cadastrar_conjunto_atividades" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4> Novo Conjunto de Atividades </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="nome_conjunto"> <h6> Nome do Conjunto: </h6> </label>
              <input type="text" class="form-control" name="nome_conjunto" id="nome_conjunto" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger cursor" data-dismiss="modal"> Cancelar </button>
          <button type="submit" class="btn btn-primary cursor" href="<?= base_url(); ?>professor/cadastrar_conjunto_atividades">
            <span class="fa fa-save" aria-hidden="true"></span> Salvar  
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Editar Conjunto Atividades -->
<div class="modal fade" id="myModalEditarConjunto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="" action="<?= base_url(); ?>professor/salvar_atualizacao_conjunto_atividades" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4> Atualizar Conjunto de Atividades </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 form-group">
              <input type="hidden" id="idConjuntoAtividadeEditar" name="idConjuntoAtividadeEditar">
              <label for="idNomeConjuntoEditar"> <h6> Nome do Conjunto: </h6> </label>
              <input type="text" class="form-control" name="idNomeConjuntoEditar" id="idNomeConjuntoEditar" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger cursor" data-dismiss="modal"> Cancelar </button>
          <button type="submit" class="btn btn-success cursor">
            <span class="fa fa-save" aria-hidden="true"></span> Salvar
          </button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Modal Excluir Conjunto Atividades -->
<div class="modal fade" id="myModalExcluirConjunto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="" action="<?= base_url(); ?>professor/excluir_conjunto_atividades" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4> Excluir Conjunto </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja excluir esse conjunto?
        </div>
        <div class="modal-footer">
          <input type="hidden" id="idConjuntoAtividadeExcluir" name="idConjuntoAtividadeExcluir">
          <button type="button" class="btn btn-danger cursor" data-dismiss="modal"> Não </button>
          <button type="submit" class="btn btn-primary cursor"> Sim </button>
        </div>
      </div>
    </div>
  </form>
</div>

</main>
</div>
</div>
