<?php
    ##########################################
    # CONFIGURACIÓN BÁSICA
    ##########################################
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $IPHost = $_POST['ip_host'];

    $CN = new ConnectSSH($ClientSyslog, "root", "123");
    $CN->ConnectDB($H, $U, $P, $D, $X);
    ##########################################

    if (!$CN->getCountCheckDBIP($IPHost)){
        echo "Fail";
    } else {
        echo "Ok";
    }
?>