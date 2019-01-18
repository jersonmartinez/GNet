<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $arrays = $_POST['ids'];
    $Filter = $CN->FilterLogs($arrays);

    while ($A = $Filter->fetch_array(MYSQLI_ASSOC)) {
        $FromHost   = $A['FromHost']; 
        $Message    = $A['Message'];
        $Facility   = $A['Facility']; 
        $Priority   = $A['Priority'];
        $ReceivedAt = $A['ReceivedAt']; 
        $SysLogTag  = $A['SysLogTag'];

        if ($Priority == 0) {
            $Priority = "Emergencia";
        } elseif ($Priority == 1) {
            $Priority = "Alerta";
        } elseif ($Priority == 2) {
            $Priority = "Critico";
        } elseif ($Priority == 3) {
            $Priority = "Error";
        } elseif ($Priority == 4) {
            $Priority = "Advertencia";
        } elseif ($Priority == 5) {
            $Priority = "Notificacion";
        } elseif ($Priority == 6) {
            $Priority = "Informacion";
        } elseif ($Priority == 7) {
            $Priority = "Depuracion";
        }

        if ($Facility == 0) {
            $Facility = "Kernel";
        } elseif ($Facility == 1) {
            $Facility = "Usuario";
        } elseif ($Facility == 2) {
            $Facility = "Correo";
        } elseif ($Facility == 3) {
            $Facility = "Sistema";
        } elseif ($Facility == 4) {
            $Facility = "Seguridad";
        } elseif ($Facility == 5) {
            $Facility = "Syslogd";
        } elseif ($Facility == 6) {
            $Facility = "Impresion";
        } elseif ($Facility == 7) {
            $Facility = "Red";
        } elseif ($Facility == 8) {
            $Facility = "UUCP";
        } elseif ($Facility == 9) {
            $Facility = "Reloj";
        } elseif ($Facility == 10) {
            $Facility = "Seguridad";
        } elseif ($Facility == 11) {
            $Facility = "FTP";
        } elseif ($Facility == 12) {
            $Facility = "NTP";
        } elseif ($Facility == 13) {
            $Facility = "Registro";
        } elseif ($Facility == 14) {
            $Facility = "Registro";
        } elseif ($Facility == 15) {
            $Facility = "Reloj";
        } elseif ($Facility == 16) {
            $Facility = "Local 1";
        } elseif ($Facility == 17) {
            $Facility = "Local 2";
        } elseif ($Facility == 18) {
            $Facility = "Local 3";
        } elseif ($Facility == 19) {
            $Facility = "Local 4";
        } elseif ($Facility == 20) {
            $Facility = "Local 5";
        } elseif ($Facility == 21) {
            $Facility = "Local 6";
        } elseif ($Facility == 22) {
            $Facility = "Local 7";
        } elseif ($Facility == 23) {
            $Facility = "Local 8";
        }

        $FullArray[] = array('FromHost'=> $FromHost, 'Message'=> $Message, 'Facility'=> $Facility, 'Priority'=> $Priority, 'ReceivedAt'=> $ReceivedAt, 'SysLogTag'=> $SysLogTag);
    }

    $JsonArray = json_encode($FullArray);
    echo $JsonArray;
?>