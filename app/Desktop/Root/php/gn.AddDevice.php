<?php
    @session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    #Recibir datos

    $ADM_WhoIs = $_POST['WhoIs'];

    if ($ADM_WhoIs == "ADM_Host"){
    	$AliasHost 	= $_POST['AliasHost'];
    	$IPNet 		= $_POST['IPNet'];
    	$IPHost 	= $_POST['IPHost'];

	    if (!$CN->checkNetwork($IPNet))
	    	$CN->addNetwork($IPNet);

	    if (!$CN->checkHost($IPHost))
	    	$CN->addHost($IPNet, $IPHost, 0, "-", $AliasHost);

    } else if ($ADM_WhoIs == "ADM_Server"){
    	//
    } else if ($ADM_WhoIs == "ADM_Router"){
    	//
    }
?>