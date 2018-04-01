<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			#Agregando fichero head del core.
			include (PF_CORE_HEAD); 
		?>
	</head>
		<?php
			#En caso que sea Root, se muestra el main.php del Root.
			if (@$_SESSION['p'] == "root")
				include (PD_DESKTOP_ROOT."/main.php");
			else if (@$_SESSION['p'] == "admin")
				include (PD_DESKTOP_ADMIN."/main.php");

		?>
	<div>
		<?php
			#Agregando fichero head del core.
			include (PF_CORE_FOOT);
		?>
	</div>
</html>
