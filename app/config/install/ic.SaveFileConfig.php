<?php
	/*Se incluye el fichero que contiene las constantes, 
	listas para ser llamadas*/
	
	@session_start();
	include (@$_SESSION['getConsts']);

	/*Se incluye una clase que contiene los métodos 
	necesarios para realizar las operaciones 
	de configuración*/

	// if (file_exists($_SESSION['getConsts'])){
	// 	echo "Consts Existe> ".$_SESSION['getConsts'];
	// } else {
	// 	echo "Consts No existe";
	// }

	// if (file_exists(PD_CTL_PHP."/ic.config.class.php")){
	// 	echo "Config Class existe";
	// } else {
	// 	echo "Config Class no existe: ".PD_CONTROLLER_PHP."/ic.config.class.php";
	// }

	include (PD_CTL_PHP."/ic.config.class.php");
	// include (PD_CONTROLLER_PHP."/ic.config.class.php");
	
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