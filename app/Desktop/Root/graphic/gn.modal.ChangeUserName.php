<?php  
  @session_start();
?>

<button type="hidden" class="ChangeUserName" data-toggle="modal" data-target="#NowChangeUserName"></button>

<!-- <!- Modal -->
<div class="modal fade" id="NowChangeUserName" tabindex="-1" role="dialog" aria-labelledby="ModalAddNewDeviceNetwork" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalAddNewDeviceNetwork"><span class="fa fa-edit"></span> Cambia tu nombre de usuario</h4>
            </div>

            <div class="modal-body">                              
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group" style="width: 100%;">
                            <input type="text" class="form-control" id="UpdateUserName" value="<?php echo @$_SESSION['username']; ?>" placeholder="Nombre de usuario" style="height: auto;">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group" style="width: 100%;">
                            <input type="password" class="form-control" id="PasswordUserName" placeholder="Escribe tu contraseña" style="height: auto;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="ModalCloseADMSave" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default btn-primary" id="btnSaveNewUser">Guardar</button>
            </div>
        </div>
    </div>
    <form id="FormChangeUserName">
        <input type="hidden" id="U_InputUserName" value="<?php echo @$_SESSION['username']; ?>" name="U_CurrentUser" />
        <input type="hidden" id="U_InputPrefixTable" value="<?php echo @$_SESSION['prefix']; ?>" name="U_PrefixTable" />
        <input type="hidden" id="U_InputPrivilegeUser" value="<?php echo @$_SESSION['p'] ?>" name="U_PrivilegeUser" />
        <input type="hidden" id="U_InputNewUserName" name="U_NewUserName" />
        <input type="hidden" id="U_InputPasswordUserName" name="U_PasswordUserName" />
    </form>
</div>