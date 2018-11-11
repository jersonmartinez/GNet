<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $newuser    = $_POST['P_CurrentUser'];
    $prefix     = $_POST['P_PrefixTable'];
    $privilege  = $_POST['P_PrivilegeUser'];
    $password   = $_POST['P_NewPassword'];
    $current    = $_POST['P_CurrentPassword'];

    if ($CN->UserUpdateUN($newuser, $current, $password, $prefix, $privilege)){
        echo "Ok";
    } else {
        echo "Fail";
    }
?>