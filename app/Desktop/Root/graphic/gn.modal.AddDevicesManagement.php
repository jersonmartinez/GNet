<?php
    $R_ADM = $CN_Global->getIPNet();    
?>

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
                            <input type="text" class="form-control" aria-label="..." data-placement="bottom" data-toggle="popover" title="Atención por acá" data-content="Escriba el nombre o alias del dispositivo a conectar en la infraestructura de red." placeholder="Nombre del dispositivo" style="height: auto;" />
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
                <br>

                <div class="row ADM_Host">
                    <div class="col-lg-6">
                        <div class="input-group">
                                <div class="input-group-btn">
                                <button type="button" class="btn btn-default">Red</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                
                                <ul class="dropdown-menu" role="menu">
                                    <?php
                                        if ($R_ADM->num_rows > 0){
                                            while ($Row_ADM = $R_ADM->fetch_array(MYSQLI_ASSOC)){
                                                ?>
                                                    <li onclick="javascript: getDataAndWriteTBNetIP('<?php echo $Row_ADM['ip_net']; ?>');"><a href="#"><?php echo $Row_ADM['ip_net']; ?></a></li>
                                                <?php
                                            }
                                            ?>
                                                <li class="divider"></li>
                                            <?php
                                        }
                                    ?>
                                    
                                    <li class="Option_ADM_NewNetwork">
                                        <a href="#">Nueva Red</a>
                                    </li>
                                </ul>
                            </div>

                            <input class="form-control ADM_TB_IPNet" id="ADM_TB_IPNet_ID" aria-label="Text input with segmented button dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Seleccione la dirección de red" type="text" placeholder="Dirección de Red" disabled="disabled" style="float: unset;">
                        </div>
                    </div><!-- /.col-lg-6 -->

                    <div class="col-lg-6">
                        <input type="text" class="form-control ADM_TB_IPHost" aria-label="..." data-placement="bottom" data-toggle="popover" title="Atención por acá" data-content="Escriba la dirección IP que apunta al host." placeholder="Dirección IP [0.0.0.0]"/>
                    </div>
                </div><!-- /.row -->

                <div class="row ADM_Server">
                    <div class="col-lg-6">
                        <input type="text" class="form-control" aria-label="..." data-placement="bottom" data-toggle="popover" title="Atención por acá" data-content="Escriba la dirección IP que apunta al Server." placeholder="Dirección IP [0.0.0.0]"/>
                    </div><!-- /.col-lg-6 -->

                    <div class="col-lg-6">
                        <input type="text" class="form-control" aria-label="..." data-placement="bottom" data-toggle="popover" title="Atención por acá" data-content="Escriba la dirección IP que apunta al Server." placeholder="Dirección IP [0.0.0.0]"/>
                    </div>
                </div><!-- /.row -->

                <div class="row ADM_Router">
                    <div class="col-lg-6">
                        <input type="text" class="form-control" aria-label="..." data-placement="bottom" data-toggle="popover" title="Atención por acá" data-content="Escriba la dirección IP que apunta al Router." placeholder="Dirección IP [0.0.0.0]"/>
                    </div><!-- /.col-lg-6 -->

                    <div class="col-lg-6">
                        <input type="text" class="form-control" aria-label="..." data-placement="bottom" data-toggle="popover" title="Atención por acá" data-content="Escriba la dirección IP que apunta al Router." placeholder="Dirección IP [0.0.0.0]"/>
                    </div>
                </div><!-- /.row -->

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-lg btn-primary" data-placement="bottom" data-dismiss="" data-toggle="popover" title="Mensaje de acción" data-content="Los cambios han sido guardados con éxito!.">...</button>
            </div>
        </div>
    </div>
</div>