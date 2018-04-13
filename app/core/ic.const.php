<?php
	#Author: Jerson Martínez (Side Master)

	#Este fichero contiene todas las CONSTANTES necesarias dentro del proyecto
	#Su mayor funcionamiento será el contenido de rutas, las cuales puedes envocar 
	#incluyendo este fichero en tu proyecto.
	
	#PD  = Path Directory
	#PDS = Path Directory Static
	#PF  = Path File

	$Path = $_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1];
	if (explode("/", $_SERVER['REQUEST_URI'])[1] != "GNet"){
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

	define ("PD_CTL",$Path."/app/controller");
		define ("PD_CTL_JS", 	$Path."/app/controller/js");
		define ("PD_CTL_PHP", 	$Path."/app/controller/php");
		define ("PD_CTL_SRC", 	$Path."/app/controller/src");

		define ("PDS_CTL_SRC", 			"app/controller/src");
		define ("PDS_CTL_JS", 			"app/controller/js");
		define ("PDS_CTL_PHP", 			"app/controller/php");

	define ("PD_CORE", 		$Path."/app/core");
		define ("PD_CORE_SERVICES", $Path."/app/core/Services");
		
		define ("PF_CORE_HEAD", 		$Path."/app/core/ic.head.php");
		define ("PF_CORE", 				$Path."/app/core/ic.core.php");
		define ("PF_DESKTOP", 			$Path."/app/core/ic.desktop.php");
		define ("PF_SSH", 				$Path."/app/core/gn.ssh.class.php");
		define ("PF_CORE_FOOT", 		$Path."/app/core/ic.foot.php");
		
	define ("PD_DESKTOP", 	$Path."/app/Desktop");
		define ("PD_DESKTOP_ROOT", 		$Path."/app/Desktop/Root");
			define ("PD_DESKTOP_ROOT_PHP", 		$Path."/app/Desktop/Root/php");
				define ("PD_DESKTOP_ROOT_PHP_CLASS", 		$Path."/app/Desktop/Root/php/class");
			define ("PD_DESKTOP_ROOT_GP", 		$Path."/app/Desktop/Root/graphic");
			define ("PD_DESKTOP_ROOT_JS", 		$Path."/app/Desktop/Root/js");

		define ("PDS_DESKTOP_ROOT", "app/Desktop/Root");
			define ("PDS_DESKTOP_ROOT_PHP", 	"app/Desktop/Root/php");
				define ("PDS_DESKTOP_ROOT_PHP_CLASS", 	"app/Desktop/Root/php/class");
			define ("PDS_DESKTOP_ROOT_JS", 		"app/Desktop/Root/js");
			define ("PDS_DESKTOP_ROOT_GP", 		"app/Desktop/Root/graphic");
		
		define ("PD_DESKTOP_ADMIN", 	$Path."/app/Desktop/Administrador");
			define ("PD_DESKTOP_ADMIN_PHP", 	$Path."/app/Desktop/Administrador/php");
			define ("PD_DESKTOP_ADMIN_GP", 		$Path."/app/Desktop/Administrador/graphic");
			define ("PD_DESKTOP_ADMIN_JS", 		$Path."/app/Desktop/Administrador/js");

		define ("PDS_DESKTOP_ADMIN", 	"app/Desktop/Administrador");
			define ("PDS_DESKTOP_ADMIN_PHP", 	"app/Desktop/Administrador/php");
			define ("PDS_DESKTOP_ADMIN_GP", 	"app/Desktop/Administrador/graphic");
			define ("PDS_DESKTOP_ADMIN_JS", 	"app/Desktop/Administrador/js");

	define ("PD_GRAPHIC", 	$Path."/app/graphic");
	define ("PD_SRC", 		$Path."/app/src");

	#Plugins
	define ("PDS_SRC_PLUGINS_ASSETS", "app/controller/src/plugins/assets");
		define ("PDS_SRC_PLUGINS_ASSETS_JS", "app/controller/src/plugins/assets/js");
		define ("PDS_SRC_PLUGINS_ASSETS_ADMINTOOLS", "app/controller/src/plugins/assets/admin-tools");
		define ("PDS_SRC_PLUGINS_ASSETS_FONTS", "app/controller/src/plugins/assets/fonts");
		define ("PDS_SRC_PLUGINS_ASSETS_IMG", "app/controller/src/plugins/assets/img");
		define ("PDS_SRC_PLUGINS_ASSETS_SKIN", "app/controller/src/plugins/assets/skin");

	define ("PDS_SRC_PLUGINS_VENDOR", "app/controller/src/plugins/vendor");
		define ("PDS_SRC_PLUGINS_VENDOR_JQ", "app/controller/src/plugins/vendor/jquery");
		define ("PDS_SRC_PLUGINS_VENDOR_PLUGINS", "app/controller/src/plugins/vendor/plugins");

?>