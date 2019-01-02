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

    $IP     = $_POST['IP'];
    $DB     = $_POST['DB'];
    $User   = $_POST['User'];
    $Pass   = $_POST['Pass'];
    $Level  = $_POST['Level'];

    echo $CN->ConfigSyslogServer($IP, $DB, $User, $Pass, $Level);
    echo "configuracion realizada";
?>