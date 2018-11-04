<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $current    = $_POST['U_CurrentUser'];
    $prefix     = $_POST['U_PrefixTable'];
    $privilege  = $_POST['U_PrivilegeUser'];
    $newuser    = $_POST['U_NewUserName'];
    $password   = $_POST['U_PasswordUserName'];

    if ($CN->UserUpdateUN($newuser, $current, $password, $prefix, $privilege)){
        echo "Ok";
    } else {
        echo "Fail";
    }
?>