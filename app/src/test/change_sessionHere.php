<?php

	if (isset($_POST['ready'])){
		if ($_POST['texto'] == ""){
			echo "No hay valor";
		} else {
			@session_start();
			@$_SESSION['id'] += $_POST['texto'];
			echo "Listoooo";
		}
	} else {
		echo "No se ha hecho click";
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Document</title>
	</head>
	<body>
		<form action="" method="post">
			<input type="text" name="texto" />
			<input type="submit" name="ready" value="Incrementar" />
		</form>
	</body>
</html>