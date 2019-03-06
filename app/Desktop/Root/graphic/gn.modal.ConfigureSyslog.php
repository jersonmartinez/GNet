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
                <h4 class="modal-title" id="ModalAddNewDeviceNetwork"><span class="fa fa-info-circle"></span> Configurar Syslog en un equipo remoto</h4>
            </div>

            <div class="modal-body">
                <div class="row Syslog">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-database"></i>
                                    </span>
                                    <input type="text" id="inputIPServerSyslog" name="inputIPServerSyslog" class="form-control" title="IP: Servidor Syslog" placeholder="* Dirección IP del servidor"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label class="control-label">Programar tarea para eliminar eventos periódicamente</label>
                                <br>
                                <label class="control-label">¿Cada cuanto se ejecuturá? (En dias):</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-level-up"></i>
                                    </span>
                                    <input id="spinner1" class="form-control ui-spinner-input inputDayJob" name="spinner" value="1" />
                                </div>
                                <hr>
                                <label class="control-label"><span>Agregar clientes Syslog</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-desktop"></i>
                                    </span>
                                    <input type="text" id="inputIPClientSyslog" name="inputIPClientSyslog" class="form-control" title="IP: Cliente Syslog" placeholder="* Dirección IP del host"/>
                                </div>
                                <br>
                                <button type="button" class="btn btn-default btn-primary" id="btnAddSyslogClient" style="width: 100%;">Agregar equipo</button>
                            </div>                        
                            <div class="col-lg-6">
                                <div id="datetimepicker3">
                                    <input type="text" class="form-control" style="max-width: 250px;" id="inputDateTimeJob" name="inputDateTimeJob">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="ModalCloseADMSave" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnSaveSettings">Guardar configuración</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function() {
        $('#datetimepicker3').datetimepicker({
        defaultDate: "03/13/2019",
        inline: true,
        });

        $("#spinner1").spinner();
    });
</script>