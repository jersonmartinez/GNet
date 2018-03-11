<input type="hidden" id="title_sm" value="" />
<input type="hidden" id="content_sm" value="" />

<?php
  //include ("ic.test.php");

  #Agregando ventana modal, configuración de la red.
  include (PD_DESKTOP_ROOT."/graphic/ic.modal.config_network.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.AddDevicesManagement.php");
?>

<div class="container_platform">
    <!-- Wrap content in admin-panel class -->
    <div class="admin-panels">

        <!-- Create Row -->
        <div class="row">

            <!-- Create Column with required .admin-grid class -->
            <div class="col-md-6 admin-grid">

                <!-- Create Panel with required unique ID -->
                <div class="panel" id="p1">
                    <div class="panel-heading">
                        <span class="panel-title"> Panel 1</span>
                    </div>
                    <div class="panel-body">
                    </div>
                </div>

                <!-- Create Panel with required unique ID -->
                <div class="panel" id="p2">
                    <div class="panel-heading">
                        <span class="panel-title"> Panel 2</span>
                    </div>
                    <div class="panel-body">
                    </div>
                </div>

            </div>
            <!-- End Column -->

            <div class="col-md-6">

                <!-- Create Panel with required unique ID -->
                <div class="panel" id="p3">
                    <div class="panel-heading">
                        <span class="panel-title"> Panel 3</span>
                    </div>
                    <div class="panel-body">
                    </div>
                </div>

                <!-- Create Panel with required unique ID -->
                <div class="panel" id="p4">
                    <div class="panel-heading"> 
                        <span class="panel-title"> Panel 4</span>
                    </div>
                    <div class="panel-body">
                    </div>
                </div>
                
                Algo

            </div>
            <!-- End Column -->
        </div>
   </div>
</div>


<button type="hidden" class="AddRedactDocumentation" data-toggle="modal" data-target="#NowAddRedactDocumentation"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowAddRedactDocumentation" tabindex="-1" role="dialog" aria-labelledby="ModalRedactionDocument" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ModalRedactionDocument">Redactar el documento</h4>
      </div>
      <div class="modal-body">
	
			<script src="app/controller/src/plugins/ckeditor/ckeditor.js"></script>
			<script src="app/controller/src/plugins/ckeditor/samples/js/sample.js"></script>
			<link href="app/controller/src/plugins/ckeditor/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css" rel="stylesheet">

			<div class="adjoined-bottom">
				<div class="grid-container">
					<div class="grid-width-100">
						<div id="editor">
							<h1>¡Escribe tu documento!</h1>
						</div>
					</div>
				</div>
			</div>

			<script>
				initSample();
			</script>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-lg btn-primary savechange" data-placement="bottom" data-dismiss="" data-toggle="popover" title="Mensaje de acción" data-content="Los cambios han sido guardados con éxito!.">Guardar cambios</button>

      </div>
    </div>
  </div>
</div>