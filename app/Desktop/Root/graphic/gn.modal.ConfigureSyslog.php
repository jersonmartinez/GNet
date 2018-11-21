<?php
    $R_ADM = $CN_Global->getIPNet();
?>

<button type="hidden" class="ConfigureSyslog" data-toggle="modal" data-target="#NowConfigureSyslog"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowConfigureSyslog" tabindex="-1" role="dialog" aria-labelledby="ModalAddNewDeviceNetwork" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalAddNewDeviceNetwork"><span class="fa fa-keyboard-o"></span> Configurar Syslog en un equipo remoto</h4>
            </div>

            <div class="modal-body">

                <div class="row ADM_Host">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default">* Host</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                
                                <ul class="dropdown-menu" role="menu">
                                    <li ><a href="#">Lista de hosts</a></li>
                                    <li class="divider"></li>                                    
                                    <li class="Option_ADM_NewNetwork">
                                        <a href="#">Nuevo Host</a>
                                    </li>
                                </ul>
                            </div>

                            <input class="form-control ADM_TB_IPHost" id="ADM_TB_IPNet_ID" aria-label="Text input with segmented button dropdown" type="text" placeholder="* Dirección IP del host" disabled="disabled" style="float: unset;">
                        </div>
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle ddt_SelectTypeDevice" data-toggle="dropdown" aria-expanded="false">* Nivel de severidad<span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li id="ddt_SelectTypeDeviceOptionEmer"><a href="#">Emergencia </a></li>
                                    <li id="ddt_SelectTypeDeviceOptionAlert"><a href="#">Alerta </a></li>
                                    <li id="ddt_SelectTypeDeviceOptionCrit"><a href="#">Crítico </a></li>
                                    <li id="ddt_SelectTypeDeviceOptionErr"><a href="#">Error </a></li>
                                    <li id="ddt_SelectTypeDeviceOptionWarn"><a href="#">Advertencia </a></li>
                                    <li id="ddt_SelectTypeDeviceOptionNotice"><a href="#">Aviso </a></li>
                                    <li id="ddt_SelectTypeDeviceOptionInfo"><a href="#">Información </a></li>
                                    <li id="ddt_SelectTypeDeviceOptionDebug"><a href="#">Depuración </a></li>
                                    <li class="divider"></li>
                                    <li id="ddt_SelectTypeDeviceOptionTodos"><a href="#">Todos </a></li>
                                </ul>
                            </div><!-- /btn-group -->
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->

                <div class="row">
                    
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="ModalCloseADMSave" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default btn-primary" id="Btn_ADM_Save">Guardar configuración</button>
            </div>
        </div>
    </div>
</div>