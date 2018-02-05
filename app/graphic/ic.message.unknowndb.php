
<button type="hidden" id="ModalMessageUnknowndb" class="btn btn-primary btn-lg animated-delay" data-animate='["1700", "fadeInUp"]' data-toggle="modal" data-target="#MessageUnknowndb">Validar Datos</button>

<!-- Modal -->
<div class="modal fade" id="MessageUnknowndb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Up's, algo inesperado ha ocurrido</h4>
      </div>
      <div class="modal-body">
        <p><b>¡Ajá!, ¿Qué hizo con la base de datos?</b></p>

        <div class="row">
          <div class="col-xs-2">
            <i class="fa fa-smile-o fa-5x" aria-hidden="true"></i>
          </div>
          <div class="col-xs-10 InstallationSuccessData">
            <?php
              echo "La base de datos llamada <b>".$D."</b>, no se ha encontrado en el Gestor MySQL, por favor, cree la base de datos y reconfigure los datos en los campos de la instalación.";
            ?>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#ModalMessageUnknowndb").hide();
  setTimeout(function(){
    $("#ModalMessageUnknowndb").click();
  }, 2000);
</script>