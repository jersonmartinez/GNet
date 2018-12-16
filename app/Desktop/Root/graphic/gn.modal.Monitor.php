<button type="hidden" class="ModalMonitor" data-toggle="modal" data-target="#NowModalMonitor"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowModalMonitor" tabindex="-1" role="dialog" aria-labelledby="ModalMonitor" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalMonitor"><span class="fa fa-keyboard-o"></span> Monitorización</h4>
            </div>

            <div class="modal-body">        
                <!-- Modal Monitor -->
                <!-- <form id="Form_ModalMonitor"> -->
                    <div class="row">
                        <!-- Create Column with required .admin-grid class -->
                        <div class="col-md-12">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs" role="tablist" style="float: left; padding: 4px; border: none;">
                                    <li role="presentation" class="active"><a href="#graficos" aria-controls="graficos" role="tab" data-toggle="tab" style="font-size: 12px;">USO DE RECURSOS</a></li>
                                    <li role="presentation"><a href="#system" aria-controls="system" role="tab" data-toggle="tab" style="font-size: 12px;">INFORMACIÓN BÁSICA</a></li>
                                    <li role="presentation" class="tab_btn_process"><a href="#process" aria-controls="process" role="tab" data-toggle="tab" style="font-size: 12px;">PROCESOS</a></li>
                                    <li role="presentation"><a href="#network" aria-controls="network" role="tab" data-toggle="tab" style="font-size: 12px;">CONEXIÓN EN RED</a></li>
                                    <li role="presentation"><a href="#server" aria-controls="server" role="tab" data-toggle="tab" style="font-size: 12px;">SERVICIO WEB</a></li>
                                </ul>
                            </div>

                            <div class="panel-body AdminPanel_ResourcesMonitor_PanelBodyModal">
                                <!-- El contenido -->
                                <br/>
                            </div>

                        </div>
                        <!-- End Column -->
                    </div>
                <!-- </form> -->
                <br>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="BtnCloseModalMonitor" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-dark" onclick="javascript: getMonitorNMapOnThisHost();" >Sólo monitorizar</button>
                <!-- <button type="button" class="btn btn-default btn-primary" id="Btn_ModalMonitorSave">Agregar</button> -->
            </div>
        </div>
    </div>
</div>