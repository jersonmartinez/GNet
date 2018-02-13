<?php
	/*Se incluye el fichero que contiene las constantes, 
	listas para ser llamadas*/
	$Const = $_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php";
	if (!file_exists($Const))
		$Const = $_SERVER['DOCUMENT_ROOT']."/app/core/ic.const.php";
	
	include ($Const);

	/*Se incluye una clase que contiene los métodos 
	necesarios para realizar las operaciones 
	de configuración*/
	include (PD_CONTROLLER_PHP."/ic.config.class.php");
	
	/*Se crea un objeto Config, 
	instanciando la clase ConfigFile*/
	$Config = new ConfigFile();
	
	/*Se crea el fichero, se le pasa por 
	parámetros la ruta del fichero y los datos.*/
	$Config->CreateFile(PF_CONFIG, $_POST);

	/*Se confirma el fichero en dicha ruta*/
	$Config->ConfirmFile(PF_CONFIG);
	
	/*Creando la conexión al servidor*/
	include (PF_CONNECT_SERVER);

	/*Creando tablas en la base de datos seleccionada*/
	include (PF_INSTALLDB);

	/*Con respecto a la conexión y creación de tablas
	me devuelven la variable error, por si hay error.*/
	if ($error == false)
		echo "OK";
	else if ($error == true)
		echo "Error";

?>