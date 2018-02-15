<?php
	include ($_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php");

	@session_start();
	@$_SESSION['call'] = "On";

	include (PD_DESKTOP_ROOT_PHP."/ssh.class.php");

	$CN = new ConnectSSH();

	$time_start = microtime(true);

	// echo shell_exec("nmap 192.168.100.0/24 -n -sP | grep report | awk '{print $5}'");
	// 	echo " | host: ".$value;
	// }

	$CN->SpaceTest();

	include (PD_DESKTOP_ROOT_PHP."/images.php");

	$time_end = microtime(true);
	$time = $time_end - $time_start;

?>

<input type="hidden" id="input_retardo" value="Retardo de tiempo: <?php echo number_format($time, 2, '.', ''); ?> seg." />

<style>
	.show_elements {
	  padding: 10px; background-color: rgba(0,0,0,.1);
	}
	.show_elements:hover {
	  cursor: pointer;
	  background-color: rgba(0,0,0,.2);
	}
</style>