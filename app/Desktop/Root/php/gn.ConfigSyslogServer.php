<?php
    ##########################################
    # CONFIGURACIÓN BÁSICA
    ##########################################
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $ServerSyslog   = $_POST['ServerSyslog'];
    $DateTimeJob    = $_POST['DateTimeJob'];
    $Day            = $_POST['DayJob'];
    $Level          = $_POST['Level'];

    $CN = new ConnectSSH($ServerSyslog, "root", "123");
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $SplitDate  = explode(" ", $DateTimeJob);
    $Hour       = $SplitDate[1]." ".$SplitDate[2];
    $Hour       = date("H:i", strtotime($Hour)).":00";
    $Date       = date("Y-m-d", strtotime($SplitDate[0]));

    if ($CN->ConfigSyslogServer($H, $D, $U, $P, $Level)) {
        echo $CN->ScheduleTask($Date, $Hour, $Day);
        echo " OK";
    } else {
        echo "ERROR";
    }
?>