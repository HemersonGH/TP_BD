<main class="text-center form-signin" role="alert">
  <div class="alert alert-danger" id="idAlert" role="alert">
    <strong>
      <span class="fa fa-info-circle" aria-hidden="true"></span> <?= $msg; ?>
    </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <script type="text/javascript">
    $().ready(function() {
      setTimeout(function () {
        $('#idAlert').hide();
      }, 10500);
    });
  </script>
</main>
</div> <!-- Essa div fecha a div do login "<div class="col-md-12 text-center">" -->
