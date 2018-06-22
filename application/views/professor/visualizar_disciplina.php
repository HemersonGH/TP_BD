<link href="<?= base_url(); ?>assets/css/professor.css" rel="stylesheet">

<div class="padding col-md-12">

<?php foreach ($conjunto_atividades_da_disciplina as $conjuntos_atividades) { ?>
  <div class="spaceBeetwenComponents">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="colorHeader text-center"> Troféus </th>
          <th class="colorHeader text-center"><?= $conjuntos_atividades->nome_conjunto;?></th>
          <th class="colorHeader text-center"> Prazo de Entrega </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($this->load->library('application/controllers/professor')->professor->get_Atividades($conjuntos_atividades->idConjuntoAtividade) as $atividade) { ?>
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

</div>
</main>
</div>
</div>
