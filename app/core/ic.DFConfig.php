<?php
	/*Se incluye el fichero que contiene las constantes, 
	listas para ser llamadas*/
	$Const = $_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php";
	if (!file_exists($Const))
		$Const = $_SERVER['DOCUMENT_ROOT']."/app/core/ic.const.php";
	
	include ($Const);

	if (file_exists(PF_CONFIG)){
		#Cambiamos el modo a rwx-r---r--
		if (@chmod(PF_CONFIG, 0744)){
			#Se elimina el fichero de configuración
			if (@unlink(PF_CONFIG)){
				echo "OK"; //En caso de que se haya eliminado con éxito, se devuelve OK.
			}
			//En caso contrario no pasa nada.
		}
	} else {
		echo "OK";
	}

?>