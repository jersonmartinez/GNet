<?php
    $R_ADM = $CN_Global->getIPNet();
?>

<button type="hidden" class="ConfigureSyslogServer" data-toggle="modal" data-target="#NowConfigureSyslogServer"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowConfigureSyslogServer" tabindex="-1" role="dialog" aria-labelledby="ModalAddNewDeviceNetwork" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalAddNewDeviceNetwork"><span class="fa fa-keyboard-o"></span> Configurar Servidor para almacenamiento de Logs</h4>
            </div>

            <div class="modal-body">

                <div class="row Syslog">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-user"></i></button>
                            </span>
                            <input type="text" id="inputIPServerSyslog" name="inputIPServerSyslog" class="form-control" title="IP: Servidor Syslog" placeholder="* Dirección IP del servidor"/>
                        </div>
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="input-group">
                            <!-- <div class="input-group-btn"> -->
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-database"></i></button>
                                </span>
                                <button type="button" class="btn btn-default dropdown-toggle ddt_SelectLevelSeverity" data-toggle="dropdown" aria-expanded="false">* Severidad<span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li id="ddt_SelectSeverityOptionEmer"><a href="#">Emergencia </a></li>
                                    <li id="ddt_SelectSeverityOptionAlert"><a href="#">Alerta </a></li>
                                    <li id="ddt_SelectSeverityOptionCrit"><a href="#">Crítico </a></li>
                                    <li id="ddt_SelectSeverityOptionErr"><a href="#">Error </a></li>
                                    <li id="ddt_SelectSeverityOptionWarn"><a href="#">Advertencia </a></li>
                                    <li id="ddt_SelectSeverityOptionNotice"><a href="#">Aviso </a></li>
                                    <li id="ddt_SelectSeverityOptionInfo"><a href="#">Información </a></li>
                                    <li id="ddt_SelectSeverityOptionDebug"><a href="#">Depuración </a></li>
                                    <li class="divider"></li>
                                    <li id="ddt_SelectSeverityOptionTodos"><a href="#">Todos </a></li>
                                </ul>
                            <!--</div> /btn-group -->
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->

                <div class="row">
                    
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="ModalCloseADMSave" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnSaveSettingsServer">Guardar configuración</button>
            </div>
        </div>
    </div>
</div>