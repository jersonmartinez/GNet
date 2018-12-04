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

    $IP_GNet    = $_POST['IP_GNet'];
    $Severidad  = $_POST['Severidad'];

    echo "Datos pasados: <br/>";
    echo "IP: ", $IP_GNet, " - Severidad: ", $Severidad, "<br/>";

    echo "<br/>Datos devueltos del script: <br/>";
    echo $CN->SyslogConfig($IP_GNet, $Severidad);

?>