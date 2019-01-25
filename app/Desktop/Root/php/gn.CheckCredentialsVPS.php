<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    if ($CN->getCountCredentialsVPS() > 0)
        echo "Ok";
    else 
        echo "Fail";
?>