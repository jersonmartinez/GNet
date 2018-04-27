<input type="hidden" id="title_sm" value="" />
<input type="hidden" id="content_sm" value="" />

<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenDeviceManagementInit" />
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenDeviceManagementFinish" />
<?php
  #Agregando ventana modal, configuración de la red.
  include (PD_DESKTOP_ROOT."/graphic/ic.modal.config_network.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.AddDevicesManagement.php");
?>

<div class="container_platform">
    <!-- Tour Activation Btn -->
    <!-- <button class="btn btn-primary" id="tour_start" type="button">Begin Tour</button> -->

    <!-- Tour Steps -->
    <!-- <div class="row">
      <div class="col-md-6">
        <div class="panel" id="tour-item1">
            <div class="panel-heading">
              <span class="panel-title"> Panel 1</span>
            </div>    
            <div class="panel-body" style="min-height: 100px;">
            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel" id="tour-item2">
            <div class="panel-heading">
              <span class="panel-title"> Panel 2</span>
            </div>    
            <div class="panel-body" style="min-height: 100px;">
            </div>
        </div>
      </div>
    </div> -->

    <!-- Wrap content in admin-panel class -->
    <div>
        <div class="row AdminPanel_DevicesManagement">
            <div class="col-md-12">
                 <!-- Create Panel with required unique ID -->
                <div class="panel" id="pUnique_DevicesManagement">
                    <div class="panel-heading">
                        <span class="panel-icon"><i class="fa fa-th"></i></span>
                        <span class="panel-title">Gestión de dispositivos</span>
                        
                        <div class="container_options_controls" style="position: absolute; top: 0; right:100px;">
                            <button style="padding: 9px;" class="filter btn btn-primary btn-sm active" data-filter="all">Todo</button>
                            <button style="padding: 9px;" class="filter btn btn-primary btn-sm" data-filter=".category-1">Dispositivos finales</button>
                            <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-2">Enrutadores</button>
                            <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-3">Conmutadores</button>
                            <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-4">Servidores</button>

                            <!-- Orden -->
                            <button class="sort btn btn-default btn-sm btn_Order_Asc" data-sort="myorder:asc" style="display: none;">Asc</button>
                            <button class="sort btn btn-default btn-sm btn_Order_Desc" data-sort="myorder:desc" style="display: none;">Desc</button>

                            <!-- Split button -->
                            <div class="btn-group" style="display: inline-block;">
                                <button type="button" class="btn btn-danger btn_Order_value">Orden</button>
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="li_OrderAsc"><a href="#">Ascendente</a></li>
                                    <li class="li_OrderDesc"><a href="#">Descendente</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body AdminPanel_DevicesManagement_PanelBody">
                        <!-- Content -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Row -->
        <div class="row AdminPanel_TrackingNetwork">

            <!-- Create Column with required .admin-grid class -->
            <div class="col-md-12">

                <!-- Create Panel with required unique ID -->
                <div class="panel" id="pUnique_TrackingNetwork">
                    <div class="panel-heading">

                        <span class="panel-icon"><i class="fa fa-sitemap"></i></span>
                        <span class="panel-title">Mapa de Red (Autodescubrir dispositivos)</span>

                        <div class="container_options_controls" style="position: absolute; top: 0; right: 100px;">
                            <button type="button" id="btn_tracking_b1" class="btn btn-dark btn_tracking_device" disabled="disabled">Monitorizar</button>
                            <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Procesos</button>
                            <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Servicios</button>
                            <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Propiedades</button>
                            <!-- <button type="button" id="btn_tracking_b2" class="btn btn-dark btn_tracking_device" disabled="disabled">Consola</button> -->
                            <!-- <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Historial</button> -->

                            <button type="button" class="btn btn-primary ladda-button progress-button" data-style="expand-right">
                                <span class="ladda-label">Rastrear</span>
                            </button>
                        </div>

                    </div>
                    <div class="panel-body AdminPanel_TrackingNetwork_PanelBody">
                        <!-- El contenido -->
                    </div>
                </div>
            </div>
            <!-- End Column -->
        </div>

        <div class="row AdminPanel_ResourcesMonitor">

            <!-- Create Column with required .admin-grid class -->
            <div class="col-md-12">

                <!-- Create Panel with required unique ID -->
                <div class="panel" id="pUnique_ResourcesMonitor">
                    <div class="panel-heading">
                        <span class="panel-icon"><i class="fa fa-tachometer"></i></span>
                        <span class="panel-title">Monitorizador de Recursos</span>
                    </div>
                    <div class="panel-body AdminPanel_ResourcesMonitor_PanelBody">
                        <!-- El contenido -->
                    </div>
                </div>
            </div>
            <!-- End Column -->
        </div>
    </div>
</div>

<?php
    include (PD_DESKTOP_ROOT_PHP."/vis/gn.menu-context.php");
?>


<!-- <button type="hidden" class="AddRedactDocumentation" data-toggle="modal" data-target="#NowAddRedactDocumentation"></button> -->

<!-- <!- Modal -->
<!-- <div class="modal fade" id="NowAddRedactDocumentation" tabindex="-1" role="dialog" aria-labelledby="ModalRedactionDocument" aria-hidden="true">
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
</div> -->