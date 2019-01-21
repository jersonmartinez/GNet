<?php
    ##########################################
    # CONFIGURACIÓN BÁSICA
    ##########################################
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH("127.0.0.1", "root", "123");
    $CN->ConnectDB($H, $U, $P, $D, $X);
    ##########################################

    $ServerSyslog = $_POST['ServerSyslog'];

    echo $CN->ConfigSyslogClient($ServerSyslog);
    echo "configuracion realizada";
?>