<?php
	#Importar constantes.
	@session_start();
	include (@$_SESSION['getConsts']); 

	include (PF_CONNECT_SERVER);
    include (PD_DESKTOP_ROOT_PHP."/gn.ssh.class.php");

   	$ConnectSSH = new ConnectSSH("127.0.0.1", "root", "123");

   	$NetworkServices = explode(",", $ConnectSSH->getNetworkServices());
    foreach ($NetworkServices as $value) {
        echo $value."";
    }
    echo "Monitorizar servicios de red";
?>