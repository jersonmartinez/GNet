<?php
	@session_start();
	
	include (@$_SESSION['getConsts']);
	// include ($_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php");

	@$_SESSION['call'] = "On";

	include (PF_CONNECT_SERVER);
	include (PF_SSH);

	$SwitchNetwork = $_POST['SwitchNetwork'];
	// exit();

	$CN = new ConnectSSH();
	$CN->ConnectDB($H, $U, $P, $D, $X);

	$time_start = microtime(true);

	$CN->SpaceTest($SwitchNetwork);

	include (PD_DESKTOP_ROOT_PHP."/vis/images.php");

	$time_end = microtime(true);
	$time = ($time_end - $time_start);

	$time_minutes = ($time / 60);
	$string_show_time = "seg.";

	if ($time_minutes >= 1){
		$time = $time_minutes;
		$string_show_time = "min.";
	}
?>

<input type="hidden" id="input_retardo" value="Retardo de tiempo: <?php echo number_format($time, 2, '.', ''), ' ', $string_show_time; ?>" />

<style>
	.show_elements {
	  padding: 10px; background-color: rgba(0,0,0,.1);
	}
	.show_elements:hover {
	  cursor: pointer;
	  background-color: rgba(0,0,0,.2);
	}
</style>