<?php
	@session_start();

	if ($_SESSION['session_expired'])
		header("Location: ../../../");

	if (!isset($_SESSION['getConsts'])){
		echo "Sesión expirada, presione F5 o CTRL + R";
		$_SESSION['session_expired'] = true;
	}

	include (@$_SESSION['getConsts']);

	include (PF_CONNECT_SERVER);
	include (PD_CTL_PHP."/ic.config.class.php");

	$Object = new ConfigFile();
	
	$Query = "INSERT INTO ".@$_SESSION['prefix']."control_logout (usr, ip, remember, date_log, date_log_unix) VALUES ('".@$_SESSION['username']."','".$Object->getIpAddr()."','".@$_SESSION['rmb']."','".date('Y-n-j')."','".time()."');";

	if ($IC){
		if (@$IC->query($Query)){
			@session_destroy();
			header("Location: ../../../");
		} else {
			echo "Ha ocurrido un problema al intentar cerrar sesión.";
			@session_destroy();
		}
	} else {
		@session_destroy();
		header("Location: ../../../");
	}
?>