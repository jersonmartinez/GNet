<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $user = $_POST['CredentialLocalMachineUsername'];
    $pass = $_POST['CredentialLocalMachinePassword'];

    if ($CN->getCountCredentialsLocalMachine() > 0)
        $CN->truncateCredentialsLocalMachine();
    
    if ($CN->addCredentialsLocalMachine($user, $pass)){
        echo "Ok";
    } else {
        echo "Fail";
    }
?>