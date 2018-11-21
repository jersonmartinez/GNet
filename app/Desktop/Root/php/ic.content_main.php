
<input type="hidden" id="title_sm" value="" />
<input type="hidden" id="content_sm" value="" />

<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenDeviceManagementInit" />
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenDeviceManagementFinish" />

<!-- Add Credentials Local Machine Notifications -->
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenNotifyACLMEmpty" />
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenNotifyACLMOk" />
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenNotifyACLMFail" />
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenNotifyACLMError" />

<?php
  #Agregando ventana modal, configuración de la red.
  include (PD_DESKTOP_ROOT."/graphic/ic.modal.config_network.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.AddDevicesManagement.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.ConfigureSyslog.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.AddCredentialsLocalMachine.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.ChangeUserName.php");
?>

<div class="container_platform">
    <!-- <input type="button" value="Mostrar usuarios" onclick="javascript: nuevallamada();" id="TestingShowUsersII" />
    <div class="container_platform_savenewdata">
        <p>Parrafo</p>
    </div> -->

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

    <style type="text/css">
            
        .box-wrap::after {
          display: block;
          content: '';
          clear: both;
        }

        .boxes div.selected {
          -webkit-box-shadow: 0 0.45em 0.6em 0 rgba(0, 0, 0, 0.2);
                  box-shadow: 0 0.45em 0.6em 0 rgba(0, 0, 0, 0.2);

            border-radius: 4px;
                  /*background-color: red;*/
        }
        .selection {
          /*background: rgba(0, 0, 255, 0.1);*/
          background: rgba(0, 0, 0,.2);
          border-radius: 0.1em;
          /*border: 0.05em solid rgba(0, 0, 255, 0.2);*/
          border: 0.05em solid rgba(0, 0, 0, 0.4);
        }

    </style>


    <!-- Wrap content in admin-panel class -->
    <div>
        <div class="row AdminPanel_ProffileSettings">

            <!-- Create Column with required .admin-grid class -->
            <div class="col-md-12">

                <!-- Create Panel with required unique ID -->
                <div class="panel" id="pUnique_ProfileSetting">
                    <div class="panel-heading">
                        <span class="panel-icon"><i class="fa fa-user"></i></span>
                        <span class="panel-title">Configuración de la cuenta del usuario</span>   
                    </div>
                    <div class="panel-body AdminPanel_ProfileSetting_PanelBody">
                        <!-- El contenido -->

                    </div>
                </div>
            </div>
            <!-- End Column -->
        </div>

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

                    <!-- <section class="box-wrap boxes blue"> -->
                        <div class="panel-body AdminPanel_DevicesManagement_PanelBody">
                            <!-- Content -->
                        </div>
                    <!-- </section> -->

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

                            <button type="button" class="btn btn-primary ladda-button progress-button btn_action_tn" data-style="expand-right">
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

                        <ul class="nav nav-tabs" role="tablist" style="float: right; padding: 4px; border: none;">
                            <li role="presentation" class="active"><a href="#graficos" aria-controls="graficos" role="tab" data-toggle="tab" style="font-size: 12px;">USO DE RECURSOS</a></li>
                            <li role="presentation"><a href="#system" aria-controls="system" role="tab" data-toggle="tab" style="font-size: 12px;">INFORMACIÓN BÁSICA</a></li>
                            <li role="presentation"><a href="#process" aria-controls="process" role="tab" data-toggle="tab" style="font-size: 12px;">PROCESOS</a></li>
                            <li role="presentation"><a href="#network" aria-controls="network" role="tab" data-toggle="tab" style="font-size: 12px;">CONEXIÓN EN RED</a></li>
                            <li role="presentation"><a href="#server" aria-controls="server" role="tab" data-toggle="tab" style="font-size: 12px;">SERVICIO WEB</a></li>
                        </ul>
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


<div class="panel" id="MessageFailCheckCredentialsLocalMachine" style="visibility: hidden;">
    <div class="panel-heading">
        <span class="panel-title">Credenciales del servidor web</span>
    </div>

    <div class="panel-body">
        Hemos encontrado un problema con las credenciales anteriormente almacenadas, por favor, actualice las credenciales, nombre de usuario y contraseña de este servidor.
    </div>

    <div class="panel-footer"><button type="button" class="btn btn-dark" onclick="javascript: getModalCredentialsLocalMachine();">Actualizar credenciales</button></div>
</div>

<div class="panel" id="MessageFailCheckTrackingNetwork" style="visibility: hidden;">
    <div class="panel-heading">
        <span class="panel-title">Tracking Network</span>
    </div>

    <div class="panel-body">
        No existen ninguna infraestructura de red registrada para mostrar su mapa de red. Por favor, aplique un sondeo de red, o bien, agregue manualmente los dispositivos.
    </div>

    <div class="panel-footer"><button type="button" onclick="javascript: btn_action_tn();" class="btn btn-dark">Sondear ahora</button></div>
</div>