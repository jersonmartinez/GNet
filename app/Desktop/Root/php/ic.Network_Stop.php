<?php
	$fn = "../../../config/Config.tcb";
	include ("../../../config/connect_server/ic.connect_server.php");

	$R = $IC->query("SELECT * FROM ".$X."network ORDER BY id DESC LIMIT 1;")->fetch_array();

	if (!$IC->query("UPDATE ".$X."network SET allow=0 WHERE id=".$R['id'].";")){
		echo "Error al intentar actualizar los permisos para habilitar la red";
	}

	@system("NETSH WLAN STOP HOSTEDNETWORK");
?>