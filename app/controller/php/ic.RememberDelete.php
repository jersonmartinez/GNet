<?php 
	$fn = "../../config/Config.tcb";
	include ("../../config/connect_server/ic.connect_server.php");

	$GetSessions = "SELECT * FROM ".$X."user_sessions WHERE ip='".getIpAddr()."' AND remember='1' AND stop != '/' ORDER BY id DESC LIMIT 1;";
	$Result = $IC->query($GetSessions)->fetch_array(MYSQLI_ASSOC);

	$Q = "UPDATE ".$X."user_sessions SET stop='/' WHERE id='".$Result['id']."';";

	if ($IC->query($Q)){
		echo "OK";
	} else {
		echo "Algo ha salido mal";
	}

	function getIpAddr(){
        if (!empty(@$_SERVER['HTTP_CLIENT_IP']))
            return @$_SERVER['HTTP_CLIENT_IP'];
        else if (!empty(@$_SERVER['HTTP_X_FORWARDED_FOR']))
            return @$_SERVER['HTTP_X_FORWARDED_FOR'];
        return @$_SERVER['REMOTE_ADDR'];
    }

?>