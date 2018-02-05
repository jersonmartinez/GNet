<?php

	#Importar constantes.
	$Local = $_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php";

	if (!file_exists($Local))
		$Local = $_SERVER['DOCUMENT_ROOT']."/app/core/ic.const.php";

	@session_start();

	include ($Local);
	include (PF_CONNECT_SERVER);
	include (PD_CONTROLLER_PHP."/ic.config.class.php");

	$Object = new ConfigFile();
	
	$Query = "INSERT INTO ".@$_SESSION['prefix']."control_logout (id, usr, ip, remember, date_log, date_log_unix) VALUES ('','".@$_SESSION['username']."','".$Object->getIpAddr()."','".@$_SESSION['rmb']."','".date('Y-n-j')."','".time()."');";

	if (@$IC->query($Query)){
		@session_destroy();
		header("Location: ../../../");
	} else {
		echo "Ha ocurrido un problema al intentar cerrar sesión.";
	}

?>