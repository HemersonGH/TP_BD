<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main" role="alert">
  <div class="alert alert-warning" id="idAlert" role="alert">
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
      }, 3500);
    });
  </script>
</main>
