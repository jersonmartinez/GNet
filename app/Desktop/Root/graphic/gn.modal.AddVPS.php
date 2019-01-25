<button type="hidden" class="AddVPS" data-toggle="modal" data-target="#NowAddVPS"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowAddVPS" tabindex="-1" role="dialog" aria-labelledby="ModalAddVPS" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalAddVPS"><span class="fa fa-keyboard-o"></span> Servidor Virtual Privado [VPS]</h4>
            </div>

            <div class="modal-body">        
                <br>

                <!-- Form Add Credentials Local Machine -->
                <form id="Form_ACVPS">
                    <div class="row" id="DivACVPSFirstKeyPress">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-user"></i></button>
                                </span>
                                <input type="text" id="CredentialAliasVPS" name="CredentialAliasVPS" class="form-control" title="Alias o nombre correcto del dispositivo" placeholder="Alias del dispositivo"/>
                            </div>
                        </div><!-- /.col-lg-6 -->
                        
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-terminal"></i></button>
                                </span>
                                <input type="text" id="CredentialIPVPS" name="CredentialIPVPS" class="form-control" title="Ingrese la dirección IP del VPS" placeholder="Dirección IP"/>
                            </div>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                    <br/>
                    <div class="row" id="DivACVPSSecondKeyPress">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-user"></i></button>
                                </span>
                                <input type="text" id="CredentialUsernameVPS" name="CredentialUsernameVPS" class="form-control" title="Nombre de usuario del VPS" placeholder="Nombre de usuario"/>
                            </div>
                        </div><!-- /.col-lg-6 -->
                        
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-key"></i></button>
                                </span>
                                <input type="password" id="CredentialPasswordVPS" name="CredentialPasswordVPS" class="form-control" title="Nombre de usuario del VPS" placeholder="Contraseña"/>
                            </div>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </form>
                <br>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false" data-panel-remove="false" data-panel-title="false">
                            <div class="panel-heading">
                                <span class="panel-icon">
                                    <i class="fa fa-tasks"></i>
                                </span>
                                <span class="panel-title"> Lista de servidores</span>
                                <span class="panel-controls"><a href="#" class="panel-control-loader"></a><a href="#" class="panel-control-collapse"></a></span></div>
                            
                            <div class="panel-body" style="display: block;" id="container_ListVPS">
                                <table class="table" id="tb_listVPS">
                                    <tr>
                                        <td><b>Alias</b></td>
                                        <td><b>Dirección IP</b></td>
                                        <td><b>Nombre de usuario</b></td>
                                        <td><b>Acción</b></td>
                                    </tr>

                                    <?php
                                        $listVPS = $CN_Global->getCredentialsVPS();
                                        if ($listVPS->num_rows > 0){
                                            while ($row_listVPS = $listVPS->fetch_array(MYSQLI_ASSOC)){
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row_listVPS['alias']; ?></td>
                                                        <td><?php echo $row_listVPS['ip_host']; ?></td>
                                                        <td><?php echo $row_listVPS['username']; ?></td>
                                                        <td> <button type="button" ip_host="<?php echo $row_listVPS['ip_host']; ?>" onclick="javascript: delete_listVPS(this);" class="btn btn-default btn-danger">Eliminar</button> </td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="ModalCloseACVPS" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default btn-primary" id="Btn_ACVPS_Save">Agregar</button>
            </div>
        </div>
    </div>
</div>