<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			#Agregando fichero head del core.
			include (PF_CORE_HEAD); 

			#Esta confirmación se hace con el propósito de que en casos que esté logueado y 
			#la base de datos se de por eliminada, se retorne a la instalación.
			if ($IC){
				$QueryUserSecure = $IC->query("SELECT username FROM ".$X.$_SESSION['p']." WHERE username='".$_SESSION['username']."';");
				
				if ($QueryUserSecure->num_rows == 0)
					SecureReload();
			} else {
				SecureReload();
			}

			function SecureReload(){
				@$_SESSION['login'] = false;
				header("Location: ", PF_LOGOUT);
			}
		?>
	</head>
		<?php
			#En caso que sea Root, se muestra el main.php del Root.
			if (@$_SESSION['p'] == "root"){
				include (PD_DESKTOP_ROOT."/main.php");
			} else if (@$_SESSION['p'] == "admin"){
				/*Temporalmente, para acceder al Root, será con el usuario Administrador*/
				// include (PD_DESKTOP_ADMIN."/main.php");
				include (PD_DESKTOP_ROOT."/main.php");
			}
		?>
	<div>
		<?php
			#Agregando fichero head del core.
			include (PF_CORE_FOOT);
		?>
	</div>
</html>
