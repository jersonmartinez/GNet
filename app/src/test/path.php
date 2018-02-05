<?php
	// $Path = @$_SERVER['DOCUMENT_ROOT'];
	// echo $Path."<br/>";

	// $nombre_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);


	echo $_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1];


?>