<?php
	@session_start();

	include (@$_SESSION['getConsts']);

	include ($Local);
	include (PF_CONNECT_SERVER);
	include (PD_CONTROLLER_PHP."/ic.config.class.php");

	$Object = new ConfigFile();
	
	$Query = "INSERT INTO ".@$_SESSION['prefix']."control_logout (usr, ip, remember, date_log, date_log_unix) VALUES ('".@$_SESSION['username']."','".$Object->getIpAddr()."','".@$_SESSION['rmb']."','".date('Y-n-j')."','".time()."');";

	if ($IC){
		if (@$IC->query($Query)){
			@session_destroy();
			header("Location: ../../../");
		} else {
			echo "Ha ocurrido un problema al intentar cerrar sesión.";
		}
	} else {
		@session_destroy();
		header("Location: ../../../");
	}
?>