<button type="hidden" class="AddDeviceManagement" data-toggle="modal" data-target="#NowAddDeviceManagement"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowAddDeviceManagement" tabindex="-1" role="dialog" aria-labelledby="ModalAddNewDeviceNetwork" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalAddNewDeviceNetwork">Agregar nuevo dispositivo en red</h4>
            </div>

            <div class="modal-body">
                               
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle ddt_SelectTypeDevice" data-toggle="dropdown" aria-expanded="false">Dispositivo <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                  <li id="ddt_SelectTypeDeviceOptionFinalHost"><a href="#">Ordenador </a></li>
                                  <li id="ddt_SelectTypeDeviceOptionServer"><a href="#">Servidor </a></li>
                                  <li class="divider"></li>
                                  <li id="ddt_SelectTypeDeviceOptionRouter"><a href="#">Enrutador </a></li>
                                </ul>
                            </div><!-- /btn-group -->
                            <input type="text" class="form-control" aria-label="..." data-placement="bottom" data-toggle="popover" title="Atención por acá" data-content="Escriba la dirección IP que apunta al host." placeholder="Dirección IP"/>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  
                </div><!-- /.row -->

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-lg btn-primary" data-placement="bottom" data-dismiss="" data-toggle="popover" title="Mensaje de acción" data-content="Los cambios han sido guardados con éxito!.">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>