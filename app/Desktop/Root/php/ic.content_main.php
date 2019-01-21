
<input type="hidden" id="title_sm" value="" />
<input type="hidden" id="content_sm" value="" />
<input type="hidden" id="TextGetDataSelection" value="" />

<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenDeviceManagementInit" />
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenDeviceManagementFinish" />

<!-- Add Credentials Local Machine Notifications -->
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenNotifyACLMEmpty" />
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenNotifyACLMOk" />
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenNotifyACLMFail" />
<input type="hidden" class="notification" data-note-stack="stack_bottom_right" data-note-style="success" id="BtnHiddenNotifyACLMError" />

<?php
  #Load Windows Modals
  include (PD_DESKTOP_ROOT."/graphic/ic.modal.config_network.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.AddDevicesManagement.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.ConfigureSyslog.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.ConfigureSyslogServer.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.AddCredentialsLocalMachine.php");

  include (PD_DESKTOP_ROOT."/graphic/gn.modal.Monitor.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.MonitorNetwork.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.MonitorProcess.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.MonitorScanning.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.MonitorProperties.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.ChangeUserName.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.TrackingNetworkInformation.php");
?>

<div class="container_platform">

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
                <div class="panel" id="pUniquesd_TrackingNetworks">
                    <div class="panel-heading">

                        <span class="panel-icon"><i class="fa fa-sitemap"></i></span>
                        <span class="panel-title">Mapa de Red (Autodescubrir dispositivos)</span>

                        <div style="position: absolute; top: 0; right: 100px;">
                            <button type="button" id="btn_tracking_monitor" class="btn btn-dark btn_tracking_device" action_selection="monitor" onclick="javascript: getDataSelection(this);" disabled="disabled"><i class="fa fa-tachometer"></i> Monitorizar</button>
                            <button type="button" id="btn_tracking_network" class="btn btn-dark btn_tracking_device" action_selection="network" onclick="javascript: getDataSelection(this);" disabled="disabled"><i class="fa fa-sitemap"></i> Red</button>
                            <button type="button" id="btn_tracking_processes" class="btn btn-dark btn_tracking_device" action_selection="processes" onclick="javascript: getDataSelection(this);" disabled="disabled"><i class="glyphicon glyphicon-tasks"></i> Procesos</button>
                            <button type="button" id="btn_tracking_scanning" class="btn btn-dark btn_tracking_device" action_selection="scanning" onclick="javascript: getDataSelection(this);" disabled="disabled"><i class="glyphicon glyphicon-fire"></i> Escanear</button>
                            <button type="button" id="btn_tracking_properties" class="btn btn-dark btn_tracking_device" action_selection="properties" onclick="javascript: getDataSelection(this);" disabled="disabled"><i class="fa fa-desktop"></i> Propiedades</button>
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
                    <p style="display: none;" id="Topology_host_selected_id"></p>
                    <p style="display: none;" id="Topology_host_selected_ip_host"></p>
                    <p style="display: none;" id="stabilization"></p>
                    <p style="display: none;" id="testing_id"></p>
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
                            <li role="presentation" class="active"><a href="#graficos" aria-controls="graficos" role="tab" data-toggle="tab" style="font-size: 12px;"><span class="fa fa-bar-chart-o"> USO DE RECURSOS</a></li>
                            <li role="presentation"><a href="#system" aria-controls="system" role="tab" data-toggle="tab" style="font-size: 12px;"><span class="fa fa-info-circle"> INFORMACIÓN BÁSICA</a></li>
                            <li role="presentation" class="tab_btn_process"><a href="#process" aria-controls="process" role="tab" data-toggle="tab" style="font-size: 12px;"><span class="fa fa-tasks"> PROCESOS</a></li>
                            <li role="presentation"><a href="#network" aria-controls="network" role="tab" data-toggle="tab" style="font-size: 12px;"><span class="fa fa-sitemap"> RED</a></li>
                            <li role="presentation"><a href="#server" aria-controls="server" role="tab" data-toggle="tab" style="font-size: 12px;"><span class="fa fa-globe"> SERVICIO WEB</a></li>
                        </ul>
                    </div>
                    <div class="panel-body AdminPanel_ResourcesMonitor_PanelBody">
                        <!-- El contenido -->
                    </div>
                </div>
            </div>
            <!-- End Column -->
        </div>

         <!-- Wrap content in admin-panel class -->
        <div>
            <div class="row AdminPanel_MonitorLogs">

                <!-- Create Column with required .admin-grid class -->
                <div class="col-md-12">

                    <!-- Create Panel with required unique ID -->
                    <div class="panel" id="pUnique_MonitorLogs">
                        <div class="panel-heading">
                            <span class="panel-icon"><i class="fa fa-bell"></i></span>
                            <span class="panel-title title-logs">Monitorización de Logs</span>

                            <div class="container_options_filter" style="position: absolute; top: 0; left: 14em;">

                                <div class="checkbox-custom fill filter checkbox-emer" style="float: right;">
                                    <input type="checkbox" class="ids" id="Emergencia" name="ids[]" value="0">
                                    <label class="label-filter" for="Emergencia">Emergencia</label>
                                </div>
                                <div class="checkbox-custom fill filter checkbox-alert" style="float: right;">
                                    <input type="checkbox" class="ids" id="Alerta" name="ids[]" value="1">
                                    <label class="label-filter" for="Alerta">Alerta</label>
                                </div>
                                <div class="checkbox-custom fill filter checkbox-critical" style="float: right;">
                                    <input type="checkbox" class="ids" id="Critico" name="ids[]" value="2">
                                    <label class="label-filter" for="Critico">Crítico</label>
                                </div>
                                <div class="checkbox-custom fill filter checkbox-error" style="float: right;">
                                    <input type="checkbox" class="ids" id="Error" name="ids[]" value="3">
                                    <label class="label-filter" for="Error">Error</label>
                                </div>
                                <div class="checkbox-custom fill filter checkbox-warning" style="float: right;">
                                    <input type="checkbox" class="ids" id="Advertencia" name="ids[]" value="4">
                                    <label class="label-filter" for="Advertencia">Advertencia</label>
                                </div>
                                <div class="checkbox-custom fill filter checkbox-notice" style="float: right;">
                                    <input type="checkbox" class="ids" id="Notificacion" name="ids[]" value="5">
                                    <label class="label-filter" for="Notificacion">Aviso</label>
                                </div>
                                <div class="checkbox-custom fill filter checkbox-info" style="float: right;">
                                    <input type="checkbox" class="ids" id="Informacion" name="ids[]" value="6">
                                    <label class="label-filter" for="Informacion">Información</label>
                                </div>
                                <div class="checkbox-custom fill filter checkbox-debug" style="float: right;">
                                    <input type="checkbox" class="ids" id="Depuracion" name="ids[]" value="7">
                                    <label class="label-filter" for="Depuracion">Depuración</label>
                                </div>
                            </div>   
                        </div>
                        <div class="panel-body AdminPanel_MonitorLogs_PanelBody">
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

<div class="panel" id="MessageFailCheckCredentialsLocalMachineDeviceNotFound" style="display: none;">
    <div class="panel-heading">
        <span class="panel-title">Credenciales del host</span>
    </div>

    <div class="panel-body">
        <p>Hemos detectado que el host no es parte de la DMZ o del sistema distribuido controlado.</p>
        <p>Si desea confirmar las credenciales globales para acceder a los dispositivos, por favor, actualice el nombre de usuario y contraseña.
    </div>

    <div class="panel-footer">
        <button data-dismiss="modal" class="btn btn-dark" onclick="javascript: getModalCredentialsLocalMachine();">Actualizar credenciales</button>
        <button class="btn btn-dark" onclick="javascript: getMonitorNMapOnThisHost();" title="Escaneo sin conexion, con NMap">Escanear</button>
    </div>
</div>

<div class="panel" id="MessageFailCheckCredentialsLocalMachine" style="display: none;">
    <div class="panel-heading">
        <span class="panel-title">Credenciales del servidor web</span>
    </div>

    <div class="panel-body">
        Hemos encontrado un problema con las credenciales anteriormente almacenadas, por favor, actualice las credenciales, nombre de usuario y contraseña de este servidor.
    </div>

    <div class="panel-footer"><button type="button" class="btn btn-dark" onclick="javascript: getModalCredentialsLocalMachine();">Actualizar credenciales</button></div>
</div>

<div class="panel" id="MessageFailCheckTrackingNetwork" style="display: none;">
    <div class="panel-heading">
        <span class="panel-title">Tracking Network</span>
    </div>

    <div class="panel-body">
        No existen ninguna infraestructura de red registrada para mostrar su mapa de red. Por favor, aplique un sondeo de red, o bien, agregue manualmente los dispositivos.
    </div>

    <div class="panel-footer"><button type="button" onclick="javascript: btn_action_tn();" class="btn btn-dark">Sondear ahora</button></div>
</div>