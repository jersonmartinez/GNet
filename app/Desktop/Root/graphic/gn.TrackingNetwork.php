<?php
    @session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

    @$_SESSION['call'] = "off";

    include (PF_CONNECT_SERVER);
    include (PD_DESKTOP_ROOT_PHP."/gn.ssh.class.php");

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $R = $CN->getAllHost();
?>

<label style="display: none; position: absolute; right: 50px;" id="retardo_temporal">...</label>

<div class="here_write">
    <?php
        if ($R->num_rows > 0){
            include (PD_DESKTOP_ROOT_PHP."/vis/images.php");
        }
    ?>
</div>

<script type="text/javascript" src="<?php echo PDS_DESKTOP_ROOT_JS; ?>/gn.TrackingNetwork.js"></script>