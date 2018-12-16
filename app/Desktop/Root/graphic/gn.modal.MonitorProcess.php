<button type="hidden" class="ModalMonitorProcess" data-toggle="modal" data-target="#NowModalMonitorProcess"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowModalMonitorProcess" tabindex="-1" role="dialog" aria-labelledby="ModalMonitorProcess" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalMonitorProcess"><span class="fa fa-dashboard"></span> Monitorización - Procesos</h4>
            </div>

            <div class="modal-body">        
                <!-- Modal Monitor -->
                    <div class="row">
                        <!-- Create Column with required .admin-grid class -->
                        <div class="col-md-12">
                            <div class="panel-heading">
                                
                            </div>

                            <div class="panel-body AdminPanel_ResourcesMonitorProcess_PanelBodyModal">
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
                <button type="button" class="btn btn-default" id="BtnCloseModalMonitorProcess" data-dismiss="modal">Cerrar</button>
                <button class="btn btn-dark" onclick="javascript: getMonitorNMapOnThisHost();" >Sólo monitorizar</button>
            </div>
        </div>
    </div>
</div>