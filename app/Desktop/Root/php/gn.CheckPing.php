<?php
	@session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

	include (PD_DESKTOP_ROOT_PHP_CLASS."/gn.class.ping.php");

    $CD = new CheckDevice();

    echo ($CD->ping($_POST['ip_addr'])) ? "1" : "0";
?>