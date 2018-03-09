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

            <div role="tab-block">
              <!-- Tabs Navigation -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Nuevo perfil</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" id="DetailsNetwork" role="tab" data-toggle="tab">Detalles</a></li>
                <li role="presentation"><a href="#historial" aria-controls="historial" id="HistoryNetwork" role="tab" data-toggle="tab">Historial</a></li>
              </ul>

              <!-- Tab Content Panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                  <form class="form-horizontal">

                    <div class="form-group">
                      <label for="inputPassword" class="col-sm-4 control-label">Dirección IP: </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control"  name="netname" placeholder="[0.0.0.0]" required/>
                      </div>
                    </div>

                    <div class="form-group">

                      <!-- Split button -->
                        <div class="btn-group" style="display: inline-block;">
                            <button type="button" class="btn btn-danger btn_Order_value">Orden</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li class="li_OrderAsc"><a href="#">Ascendente</a></li>
                            </ul>
                        </div>

                      <label for="inputPassword" class="col-sm-4 control-label">Contraseña</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="keypass" placeholder="Password" required/>
                      </div>
                    </div>
                  </form>
                </div>

                <div role="tabpanel" class="tab-pane" id="profile">
                  
                  <form class="form-horizontal" id="FormAppendDataDetails">
                    
                  </form>
                </div>

                <div role="tabpanel" class="tab-pane" id="historial">
                  <div class="panel-group HereBreakHistory" id="accordion" role="tablist" aria-multiselectable="true">
                    <!-- The List item !-->
                  </div>
                </div>
              </div>
            </div>
          </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-lg btn-primary savechange" data-placement="bottom" data-dismiss="" data-toggle="popover" title="Mensaje de acción" data-content="Los cambios han sido guardados con éxito!.">Guardar cambios</button>

      </div>
    </div>
  </div>
</div>