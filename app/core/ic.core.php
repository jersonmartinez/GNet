<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			#Author: Jerson Martínez (Side Master)			
			// include (@$_SESSION['getConsts']);
			// echo $Const;

			#Se agrega el head del core, utilizando la constante PF_CORE_HEAD.
			include (PF_CORE_HEAD);
		?>
	</head>
	<body class="external-page sb-l-c sb-r-c">
		<?php

			function RefreshPage(){
				header("Refresh:0 url=".$_SERVER['PHP_SELF']."");
			}

			#Se incluye el fichero de conexión, siguiendo la clase ConfigFile.
			include (PD_CTL_PHP."/ic.config.class.php");

			$Config = new ConfigFile(); #Instancia de la clase ConfigFile
			

			#Verificación de la existencia del fichero de configuración. 
			if (file_exists(PF_CONFIG)){
				// echo "Existe el fichero de configuracion";

				#Verificar si existen errores, la variable error es originaria de 
				# el fichero de conexión.
				if ($error == true){					
					$CodeError = @$IC->connect_errno;
					$MessageError = @$IC->connect_error;
					
					#Código de error 1049: La base de datos desconocida.
					$ArrayError = explode("'", $MessageError);
					
					// echo "<br/>"."Hay error en conexion";


					if ($CodeError == 1049){

						#Verificación de la existencia del directorio install/
						if (file_exists(PD_INSTALL)){

							#Instalación en modo gráfico
							include (PD_INSTALL_VIEW."/ic.InstallDesign.php");

							#Ventana modal que anuncia el problema.
							if ($ArrayError[0] == "Unknown database ")
								include (PD_GRAPHIC."/ic.message.unknowndb.php");
						} else {
							#Instalación manual en modo texto.
							@exec("leafpad ".PF_CONFIG);
							// @exec("start notepad ".PF_CONFIG);
							RefreshPage();
						}
					}

					#Código de error 2002: Host desconocido
					if ($CodeError == 2002){

						#Se hacen las misma verificaciones que en la condicional
						#anterior, elección de instalación en modo gráfico o texto.
						if (file_exists(PD_INSTALL)){
							include (PD_INSTALL_VIEW."/ic.InstallDesign.php");

							#Este punto incompleto, debe crear una ventana modal que
							#anuncie el problema con respecto al código de error.
							if ($ArrayError[0] == "Unknown database ")
								include (PD_GRAPHIC."/ic.message.unknowndb.php");
								//include (PD_GRAPHIC."/ic.message.errorfatal.php");
						} else {
							@exec("leafpad ".PF_CONFIG);
							// @exec("start notepad ".PF_CONFIG);
							RefreshPage();
						}
					}
				} else {
					#En caso de haber llegado hasta acá significa que el fichero de
					#configuración no existe.


					#Consulta todos los datos de la tabla con el privilegio root.
					@$URoot = $IC->query("SELECT * FROM ".$X."root;");
					// echo "<br/>"."Caso de error de que el fichero Config.tcb no existe.";

					// exit();
					#En caso de hayan filas.
					if (@$URoot->num_rows != 0){
						// echo "<br/>"."Si hay registros: Line 98";
						

						#Consulta todos los datos de la tabla con el privilegio admin.
						@$RAdmin = $IC->query("SELECT * FROM ".$X."admin;");

						#En caso de que hayan registros.
						if (@$RAdmin->num_rows > 0){

							@$VerifyAttack = $IC->query("SELECT * FROM ".$X."control_attack WHERE attacker='".$Config->getIpAddr()."' ORDER BY id DESC LIMIT 1;");
							
							if (@$VerifyAttack->num_rows == 1){
								$VA = @$VerifyAttack->fetch_array(MYSQLI_ASSOC);
								
								$GetDateLogUNIX = $VA['date_log_unix'];
								$Actual = time() - 300;
								$tiempo = $GetDateLogUNIX - $Actual;

								if ($GetDateLogUNIX >= $Actual){
									$TimeRest = date("i:s", $tiempo);

									@$GetOneSession = "SELECT * FROM ".$X."user_sessions WHERE ip='".$Config->getIpAddr()."' ORDER BY id DESC LIMIT 1;";
									$ThisWell = $IC->query(@$GetOneSession);

									if (@$ThisWell->num_rows > 0){
										@$Gresult = $ThisWell->fetch_array(MYSQLI_ASSOC);

										$SelectLogout = "SELECT * FROM ".$X."control_logout WHERE usr='".@$Gresult['usr']."' AND ip='".$Config->getIpAddr()."' ORDER BY id DESC LIMIT 1;";

	                           			$SLogout = $IC->query($SelectLogout)->fetch_array(MYSQLI_ASSOC);

										if ($SLogout['date_log_unix'] > (time() - 600)){
											echo "Ha excedido el límite de intentos";
											goto Funcionamiento;
										} else {
											include (PD_GRAPHIC."/ic.SecurityAttack.php");
										}	
									}

									echo "Está bloqueado, han intentado hacer un ataque";

								} else {
									goto Funcionamiento;
								}
							} else {
								Funcionamiento:
									#Cadena que contiene una consulta de base de datos que será ejecutada 
										#en la próxima intrucción.

										$GetSessions = "SELECT * FROM ".$X."user_sessions WHERE ip='".$Config->getIpAddr()."' AND remember='1' ORDER BY id DESC LIMIT 1;";

										#Consulta todos los datos de la tabla user_sessions donde la 
										#la dirección IP es igual a la actual y con la sesión en memoria, ordenándolo por
										#el atributo ID de forma descendente, limitando los datos a 1 registro.
										$RGetSession = $IC->query($GetSessions);
										
										#Verificar si existe el registro.
										if (@$RGetSession->num_rows > 0){

											#Extraer columnas de las filas por medio de los atributos, 
											#con un array asociativo.
											@$GameResult = $RGetSession->fetch_array(MYSQLI_ASSOC);
											
											#Se verifica la columna stop de la fila obtenida si es igual a /.
											#El simbolo (/) en esta columna significa que se ha cerrado la sesión recordada.

											if ($GameResult['stop'] == "/"){
												echo "Se ha hecho un ataque, sin embargo, no le he mostrado el ScreenLock";
												include (PD_GRAPHIC."/ic.LoginDesign.php");
											} else {
												include (PD_GRAPHIC."/ic.ScreenLock.php");
											}

											#En caso de no tener (/) significa que aún sigue el usuario recordado en la máquina.

										} else {
											#No hay sesión recordada. Por lo tanto, se muestra la vista del formulario de login.
											// echo "Acá es donde entra la primer página";
											include (PD_GRAPHIC."/ic.LoginDesign.php");
										}
							}

						} else {
							// echo "<br/>"."Registro de administrador";
							// exit();
							#En caso de que no haya registro de administrador, se muestra un formulario
							#donde puede registrar el primero. Esto será solo una vez.
							include (PD_GRAPHIC."/ic.RunLogUser.php");
						}
					} else {
						echo "<br/>"."Instalar DB";
						#En caso de que no exista el usuario Root, se mostrará nuevamente el 
						#formulario de instalación, de esta forma, los datos de usuario Root se registrarán.

						

						include (PF_INSTALLDB);
						// header("Location: ./");
						RefreshPage();

						// $page = $_SERVER['PHP_SELF'];
						// $sec = "10";
						// header("Refresh: $sec; url=$page");
						// exit();
					}
				}
			} else {
				#El fichero de instalación no existe y se verifica el directorio install/
				if (file_exists(PD_INSTALL)){
					#Si este existe, se muestra la instalación en modo gráfico.
					include (PD_INSTALL_VIEW."/ic.InstallDesign.php");
				} else {
					#El fichero y el directorio no existen, la instalación 
					#procede a hacerse manualmente en modo texto.

					#Se crea el fichero Config.tcb y se guardan datos por defecto.
					$Config->CFC(PF_CONFIG);

					#Ejecuta el fichero para reemplazar el contenido inútil por la configuración.
					@exec("leafpad ".PF_CONFIG);

					#Se duerme por 1 segundo y recarga la raíz.
					sleep(1);
					RefreshPage();
				}
			}
		?>
	</body>
</html>