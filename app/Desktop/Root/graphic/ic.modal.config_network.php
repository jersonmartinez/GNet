<button type="hidden" class="ConfigNetwork" data-toggle="modal" data-target="#NowConfigNetwork"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowConfigNetwork" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Configurar servicio de Red</h4>
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
                  <form class="form-horizontal" id="FormCreateNetwork">
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Autenticación</label>
                      <div class="col-sm-8">
                        <p class="form-control-static">WPA2 - Personal</p>
                      </div>
                    </div>

                     <div class="form-group">
                      <label class="col-sm-4 control-label">Modo</label>
                      <div class="col-sm-8">
                        <p class="form-control-static">Permitido | Allow</p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword" class="col-sm-4 control-label">SSID (Nombre) de la Red:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control"  name="netname" placeholder="Nombre de red" required/>
                      </div>
                    </div>

                    <div class="form-group">
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