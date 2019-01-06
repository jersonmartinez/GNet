<?php
    ##########################################
    # CONFIGURACIÓN BÁSICA
    ##########################################
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);
    
    // $DB     = $_POST['DB'];
    // $User   = $_POST['User'];
    // $Pass   = $_POST['Pass'];
    $IP     = $_POST['IP'];
    $Level  = $_POST['Level'];

    $CN = new ConnectSSH($IP, "root", "123");
    
    if ($CN->ConfigSyslogServer($H, $D, $U, $P, $Level)) {
        echo "Ok";
    } else {
        echo "Fail";
    }
?>