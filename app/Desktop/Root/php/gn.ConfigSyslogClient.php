<?php
    ##########################################
    # CONFIGURACIÓN BÁSICA
    ##########################################
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $ServerSyslog = $_POST['ServerSyslog'];
    $ClientSyslog = $_POST['ClientSyslog'];

    $CN = new ConnectSSH($ClientSyslog, "root", "123");
    $CN->ConnectDB($H, $U, $P, $D, $X);
    ##########################################

    echo $CN->ConfigSyslogClient($ServerSyslog);
    echo "configuracion realizada";
?>