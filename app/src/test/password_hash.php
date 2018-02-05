<?php
	$var = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
	echo $var."<br/>";
	echo strlen($var);
?>