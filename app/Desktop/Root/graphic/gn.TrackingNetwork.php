<?php
    @session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

    @$_SESSION['call'] = "off";

    include (PF_CONNECT_SERVER);
    include (PF_SSH);


    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $R = $CN->getAllHost();

    if (!$R->num_rows > 0){
        echo "Fail";
        exit();
    }
?>

<label style="display: none; position: absolute; right: 50px;" id="retardo_temporal">...</label>

<div class="here_write">
    <?php
        include (PD_DESKTOP_ROOT_PHP."/vis/images.php");
        // exit();
    ?>
</div>

<script type="text/javascript" src="<?php echo PDS_DESKTOP_ROOT_JS; ?>/gn.TrackingNetwork.js"></script>