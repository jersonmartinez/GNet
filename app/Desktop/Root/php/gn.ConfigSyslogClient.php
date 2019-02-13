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
    $Level  = $_POST['Level'];
    // $IP     = $_POST['IP'];

    $CN = new ConnectSSH($ClientSyslog, "root", "123");
    $CN->ConnectDB($H, $U, $P, $D, $X);
    
    echo $CN->ConfigSyslogClient($ServerSyslog);

    ##########################################

    $CNS = new ConnectSSH($ServerSyslog, "root", "123");
    
    if ($CNS->ConfigSyslogServer($H, $D, $U, $P, $Level)) {
        echo "Ok";
    } else {
        echo "Fail";
    }

?>