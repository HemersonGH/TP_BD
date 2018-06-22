<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<main class="row col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
  <div class="col-md-12">
    <h1 class="page-header"> Editar Disciplina </h1>
  </div>
  <div class="col-md-12">
    <div class="col-md-6 form-control paddingBotton">
      <form action="<?= base_url(); ?>professor/salvar_atualizacao_disciplina" method="post">
        <input type="hidden" id="idDisciplina" name="idDisciplina" value="<?= $disciplina[0]->idDisciplina ?>">
        <div class="row">
          <div class="col-md-12">
            <label for="nome_disciplina" class="padding"> <h6> Nome da Disciplina: </h6> </label>
            <input type="text" class="form-control" id="nome_disciplina" name="nome_disciplina" value="<?= $disciplina[0]->nome_disciplina; ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="codigo_disciplina" class="paddingUp"> <h6> Código da Disciplina: </h6> </label>
            <input type="text" class="form-control" id="codigo_disciplina" name="codigo_disciplina" value="<?= $disciplina[0]->codigo_disciplina; ?>" required>
          </div>
          <div class="col-md-6">
            <label for="status" class="paddingUp"> <h6> Status: </h6> </label>
            <select id="status" name="status" class="form-control" required>
              <option value="1" <?= $disciplina[0]->status_disciplina == 1 ? 'selected':''; ?> > Em Planejamento </option>
              <option value="2" <?= $disciplina[0]->status_disciplina == 2 ? 'selected':''; ?> > Disponível </option>
              <option value="3" <?= $disciplina[0]->status_disciplina == 3 ? 'selected':''; ?> > Finalizada </option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="descricao_disciplina" class="paddingUp"> <h6> Descrição da Disciplina: </h6> </label>
            <textarea class="form-control descricao_height" id="descricao_disciplina" name="descricao_disciplina" required><?= $disciplina[0]->descricao_disciplina; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a class="paddingButton btn btn-danger left" href="<?= base_url(); ?>professor" > Cancelar </a>
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
