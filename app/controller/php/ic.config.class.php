<?php
	#Author: Jerson Martínez (Side Master)

	class ConfigFile {

		public function CreateFile($fn, $data){
			/*Se crea el fichero*/
			touch($fn);

			/*Se le asignan permisos al fichero
			0-rwx-r-x-r-x*/
			chmod($fn, 0744);

			/*Puntero de tipo fichero, $MyFile apunta al fichero*/
			$MyFile = @fopen($fn, "w");

			/*Se tiene un modo escritura, se escriben
			los datos que me enviaron del formulario.*/
			fwrite($MyFile, $data['host'].PHP_EOL);
			fwrite($MyFile, $data['username'].PHP_EOL);
			fwrite($MyFile, $data['password'].PHP_EOL);
			fwrite($MyFile, $data['database'].PHP_EOL);
			fwrite($MyFile, $data['prefix']);

			/*Se cierra el fichero*/
			fclose($MyFile);

			return;
		}

		public function ConfirmFile($fn){
			/*Se verifica que el fichero exista*/
			if (file_exists($fn)){
				/*Si no se puede leer o no se puede escribir
				entonces que intenten crear el fichero nuevamente.*/
				if (!is_readable($fn) && !is_writable($fn)){
					$this->CreateFile($fn);
				} else {
					$error = false;
				}
			} else {
				$this->CreateFile($fn);
			}

			/*Si todo va bien, entonces $error tiene un valor falso,
			indicando que no hay error.*/
		}

		public function CFC($fn){
			#CFC: Create File Config.

			#Crear el fichero $fn.
			@touch($fn);

			#Asignar permisos al fichero $fn.
			@chmod($fn, 0744);

			#Se apertura el fichero en modo escritura, de esto sale un puntero.
			$rf = @fopen($fn, "w");

			#Se escribe los datos de configuración por defecto en el fichero $fn.
			fwrite($rf, "Host".PHP_EOL);
			fwrite($rf, "Nombre de usuario".PHP_EOL);
			fwrite($rf, "Contraseña".PHP_EOL);
			fwrite($rf, "Nombre de la base de datos".PHP_EOL);
			fwrite($rf, "Prefijo");

			#Se cierra el fichero $fn.
			fclose($rf);

			return; #Retornamos nada.
		}

		public function getIpAddr(){
			#Verificación IP de la variable global de servidor HTTP_CLIENT_IP
			#En caso de no estar vacía, retorna esa dirección IP.

			#En caso que HTTP_X_FORWARDED_FOR no esté vacía se retorna la dirección IP.

	        if (!empty(@$_SERVER['HTTP_CLIENT_IP']))
	            return @$_SERVER['HTTP_CLIENT_IP'];
	        else if (!empty(@$_SERVER['HTTP_X_FORWARDED_FOR']))
	            return @$_SERVER['HTTP_X_FORWARDED_FOR'];

	        #Si ha llegado hasta acá, re retorna la dirección IP que contiene REMOTE_ADDR.
	        return @$_SERVER['REMOTE_ADDR'];
	    }

	}

?>