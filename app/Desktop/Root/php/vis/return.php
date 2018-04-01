<?php
    // @session_start();

    // include (@$_SESSION['getConsts']);

	include ($_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php");

	?>
		<script type="text/javascript" src="<?php echo PDS_DESKTOP_ROOT; ?>/js/vis/vis.js"></script>
		<link href="<?php echo PDS_DESKTOP_ROOT; ?>/css/vis/vis-network.min.css" rel="stylesheet" type="text/css" />
	<?php
?>

<?php
    // @session_start();
    // if ($_SESSION['call'] != "off"){
		include (PF_CONNECT_SERVER);
        include (PF_SSH);
        $CN = new ConnectSSH();

        $CN->ConnectDB($H, $U, $P, $D, $X);

        include (PD_DESKTOP_ROOT_PHP."/vis/getData.php");
    // }
?>