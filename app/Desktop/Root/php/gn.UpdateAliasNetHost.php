<?php
    @session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    #Recibir datos

    $CN->updateNetworkAlias($_POST['ip_addr'], $_POST['alias']);
    $CN->updateHostAlias($_POST['ip_addr'], $_POST['alias']);
    echo "Ok";
?>