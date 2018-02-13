<?php
	$fn = "../../../config/Config.tcb";
	include ("../../../config/connect_server/ic.connect_server.php");

	$R = $IC->query("SELECT * FROM ".$X."network ORDER BY id DESC LIMIT 1;")->fetch_array();

	if (!$IC->query("UPDATE ".$X."network SET allow=1 WHERE id=".$R['id'].";")){
		echo "Error al intentar actualizar los permisos para habilitar la red";
	}

	$SetNetwork = 'NETSH WLAN SET HOSTEDNETWORK MODE=ALLOW SSID="'.$R['name'].'" KEY="'.$R['pass'].'"';

	@system($SetNetwork);
	@system("NETSH WLAN START HOSTEDNETWORK");

?>