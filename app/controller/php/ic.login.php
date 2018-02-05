<?php
	$Val = false;
	$ExistUser = false;

	$un = trim($_POST['username']);
	$pw = trim($_POST['password']);
	$tb = trim($_POST['privilege']);

	if (isset($_POST['remember']))
		$rm = 1;

	$password_crypt = password_hash($pw, PASSWORD_DEFAULT);
	if (!get_magic_quotes_gpc())
		$un = addslashes($un);

	#Importar constantes.
	$Local = $_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php";

	if (!file_exists($Local))
		$Local = $_SERVER['DOCUMENT_ROOT']."/app/core/ic.const.php";
	
	include ($Local);
	include (PF_CONNECT_SERVER);

	$un = $IC->real_escape_string($un);

	if ($tb == ""){
		$Val = false;
	} else {
		$Query = "SELECT * FROM ".$X.$tb." WHERE username='".$un."';";
		$R = $IC->query($Query);
		
		@session_start();
		while (@$Check = $R->fetch_array(MYSQLI_ASSOC)){
			if (password_verify($pw, $Check['password'])){
				@$_SESSION['login'] = true;
				@$_SESSION['p'] = $tb;
				@$_SESSION['username'] = $un;
				@$_SESSION['prefix'] = $X;
				@$_SESSION['rmb'] = $rm;
				$Val = true;
			}
			$ExistUser = true;
		}
	}

	if ($ExistUser){
		include (PD_CONTROLLER_PHP."/ic.security.php");
		
		if (!$Val){
			if ($AttackDetect != "AD"){
				echo "Error";
			} else {
				echo $AttackDetect;
			}
		} else {
			$InSession = "INSERT INTO ".$X."user_sessions (id, usr, ip, remember, stop, date_log, date_log_unix) VALUES ('','".@$_SESSION['username']."','".getIpAddr()."','".@$rm."', '','".date('Y-n-j')."','".time()."');";
			if ($IC->query($InSession)){
				echo "OK";
			}
		}
	} else {
		echo "Error";
	}
	
	function getIpAddr(){
        if (!empty(@$_SERVER['HTTP_CLIENT_IP']))
            return @$_SERVER['HTTP_CLIENT_IP'];
        else if (!empty(@$_SERVER['HTTP_X_FORWARDED_FOR']))
            return @$_SERVER['HTTP_X_FORWARDED_FOR'];
        return @$_SERVER['REMOTE_ADDR'];
    }
?>