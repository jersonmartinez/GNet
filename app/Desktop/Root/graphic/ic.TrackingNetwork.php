<?php
	#Importar constantes.
	include ($_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php");

    @session_start();
    @$_SESSION['call'] = "off";

    include (PD_DESKTOP_ROOT_PHP."/ssh.class.php");
    $CN = new ConnectSSH();

    $R = $CN->getAllHost();
?>
<input type="button" onclick="javascript: StartTracking();" class="btn_tracking btn btn-warning waves-effect" value="Sondear" />

<label style="display: none; position: absolute; right: 50px;" id="retardo_temporal">Retardo de tiempo: 12.45 seg.</label>

<div class="here_write">
    <?php
        if (@$R->num_rows > 0){
            include (PD_DESKTOP_ROOT_PHP."/images.php");
        }
    ?>
</div>