<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $current        = $_POST['G_CurrentUser'];
    $prefix         = $_POST['G_PrefixTable'];
    $privilege      = $_POST['G_PrivilegeUser'];
    $firstname      = $_POST['G_FirstName'];
    $lastname       = $_POST['G_LastName'];
    $mailaddress    = $_POST['G_MailAddress'];

    if ($CN->UserUpdateUN($current, $prefix, $privilege, $firstname, $lastname, $mailaddress)){
        echo "Ok";
    } else {
        echo "Fail";
    }
?>