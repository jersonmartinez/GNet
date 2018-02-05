<?php
	#Author: Jerson Martínez (Side Master)

	#Este fichero contiene todas las CONSTANTES necesarias dentro del proyecto
	#Su mayor funcionamiento será el contenido de rutas, las cuales puedes envocar 
	#incluyendo este fichero en tu proyecto.
	
	#PD = Path Directory
	#PF = Path File

	$Path = $_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1];
	if (explode("/", $_SERVER['REQUEST_URI'])[1] != "InterCloud"){
		$Path = $_SERVER['DOCUMENT_ROOT'];
	}

	define ("PD_INDEX", 	$Path."/");
	define ("PD_APP", 		$Path."/app");

	define ("PF_SOURCE", 	$Path."/source.tcb");

	define ("PD_CONFIG", 	$Path."/app/config");
		define ("PD_CONNECT_SERVER", 	$Path."/app/config/connect_server");
			define ("PF_CONNECT_SERVER", 	$Path."/app/config/connect_server/ic.connect_server.php");
			define ("PF_INSTALLDB", 		$Path."/app/config/connect_server/ic.InstallDB.php");
		
		define ("PD_INSTALL", 			$Path."/app/config/install");
			define ("PD_INSTALL_VIEW", 		$Path."/app/config/install/view");
		
		define ("PF_CONFIG", 			$Path."/app/config/Config.tcb");

	define ("PD_CONTROLLER",$Path."/app/controller");
		define ("PD_CONTROLLER_JS", 	$Path."/app/controller/js");
		define ("PD_CONTROLLER_PHP", 	$Path."/app/controller/php");
		define ("PD_CONTROLLER_SRC", 	$Path."/app/controller/src");
	
	define ("PD_CORE", 		$Path."/app/core");
		define ("PD_CORE_SERVICES", $Path."/app/core/Services");
		
		define ("PF_CORE_HEAD", 		$Path."/app/core/ic.head.php");
		define ("PF_CORE", 				$Path."/app/core/ic.core.php");
		define ("PF_DESKTOP", 			$Path."/app/core/ic.desktop.php");
		define ("PF_CORE_FOOT", 		$Path."/app/core/ic.foot.php");
		
	define ("PD_DESKTOP", 	$Path."/app/Desktop");
		define ("PD_DESKTOP_ROOT", 		$Path."/app/Desktop/Root");
		define ("PD_DESKTOP_ADMIN", 	$Path."/app/Desktop/Administrador");
		define ("PD_DESKTOP_MASTER", 	$Path."/app/Desktop/Master");
		define ("PD_DESKTOP_STUDENT", 	$Path."/app/Desktop/Estudiante");
		define ("PD_DESKTOP_TUTOR", 	$Path."/app/Desktop/Tutor");

	define ("PD_GRAPHIC", 	$Path."/app/graphic");
	define ("PD_SRC", 		$Path."/app/src");

?>