<?php
	/*Se incluye el fichero que contiene las constantes, 
	listas para ser llamadas*/
	@session_start();
	
	include (@$_SESSION['getConsts']);

	if (file_exists(PF_CONFIG)){
		#Cambiamos el modo
		if (@chmod(PF_CONFIG, 0777)){
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