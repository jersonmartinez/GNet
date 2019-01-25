<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $alias      = $_POST['CredentialAliasVPS'];
    $ip_host    = $_POST['CredentialIPVPS'];
    $user       = $_POST['CredentialUsernameVPS'];
    $pass       = $_POST['CredentialPasswordVPS'];

    if ($alias == "")
        $alias = "Invitado"; 

    if ($CN->addCredentialsVPS($alias, $ip_host, $user, $pass))
        echo "Ok";
    else
        echo "Fail";
?>