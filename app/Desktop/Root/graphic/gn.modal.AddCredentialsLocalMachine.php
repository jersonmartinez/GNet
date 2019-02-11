<button type="hidden" class="AddCredentialsLocalMachine" data-toggle="modal" data-target="#NowAddCredentialsLocalMachine"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowAddCredentialsLocalMachine" tabindex="-1" role="dialog" aria-labelledby="ModalAddNewCredentialsLocalMachine" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-content-NACLM">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalAddNewCredentialsLocalMachine"><span class="fa fa-keyboard-o"></span> Credenciales globales</h4>
            </div>

            <div class="modal-body">        
                <br>

                <!-- Form Add Credentials Local Machine -->
                <form id="Form_ACLM">
                    <div class="row" id="DivACLMKeyPress">
                        <div class="col-lg-12">
                            <p>Escriba la credencial maestra. Esta se ocupará para gestionar el entorno controlado, refiriéndose a los dispositivos de la infraestructura local.</p>
                            <br/>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-user"></i></button>
                                </span>
                                <input type="text" id="CredentialLocalMachineUsername" name="CredentialLocalMachineUsername" class="form-control" aria-label="..." data-placement="bottom" data-toggle="popover" title="Credencial: Nombre de usuario" data-content="Nombre de usuario de este host" placeholder="Nombre de usuario"/>
                            </div>
                        </div><!-- /.col-lg-6 -->
                        
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-key"></i></button>
                                </span>
                                <input type="password" id="CredentialLocalMachinePassword" name="CredentialLocalMachinePassword" class="form-control" aria-label="..." data-placement="bottom" data-toggle="popover" title="Credencial: Contraseña" data-content="Contraseña requerida para el usuario de este host" placeholder="Clave de acceso"/>
                            </div>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </form>
                <br>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="ModalCloseACLM" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default btn-primary" id="Btn_ACLM_Save">Agregar</button>
            </div>
        </div>
    </div>
</div>