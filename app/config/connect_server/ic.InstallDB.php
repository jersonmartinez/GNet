<?php
	$tables = array($X.'root_info' => "CREATE TABLE ".$X."root_info (
			username VARCHAR(50) NOT NULL, 
			firstname VARCHAR(50) NOT NULL, 
			lastname VARCHAR(50) NOT NULL, 
			date_log DATE NOT NULL, 
			date_log_unix VARCHAR(100) NOT NULL, 
			PRIMARY KEY (username)
		);", 
		$X.'root' => "CREATE TABLE ".$X."root (
			username VARCHAR(50) NOT NULL, 
			password VARCHAR(60) NOT NULL, 
			FOREIGN KEY (username) REFERENCES ".$X."root_info(username) ON UPDATE CASCADE ON DELETE CASCADE
		);", 
		$X.'privileges' => "CREATE TABLE ".$X."privileges (
			id_p INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			privileges VARCHAR(50) NOT NULL, 
			state INT UNSIGNED
		);",
		$X.'admin_info' => "CREATE TABLE ".$X."admin_info (
			username VARCHAR(50) NOT NULL, 
			firstname VARCHAR(50) NOT NULL, 
			lastname VARCHAR(50) NOT NULL, 
			date_log DATE NOT NULL, 
			date_log_unix VARCHAR(100) NOT NULL, 
			PRIMARY KEY (username)
		);", 
		$X.'admin' => "CREATE TABLE ".$X."admin (
			username VARCHAR(50) NOT NULL, 
			password VARCHAR(60) NOT NULL, 
			FOREIGN KEY (username) REFERENCES ".$X."admin_info(username) ON UPDATE CASCADE ON DELETE CASCADE
		);",
		$X.'user_sessions' => "CREATE TABLE ".$X."user_sessions (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			usr VARCHAR(255) NOT NULL, 
			ip VARCHAR(35) NOT NULL, 
			remember INT NOT NULL DEFAULT '0',
			stop VARCHAR(2) NOT NULL DEFAULT '-',
			date_log DATE NOT NULL, 
			date_log_unix VARCHAR(100) NOT NULL
		);", #Aquí se especifica la dirección IP, sin embargo, no se sabe si es un IPv6 o IPv4. Por esa razón se le pasa 128 bytes de memmoria al atributo ip.
		$X.'control_user' => "CREATE TABLE ".$X."control_user (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			ip VARCHAR(128) NOT NULL, 
			usr VARCHAR(50) NOT NULL, 
			count INT, 
			finished VARCHAR(2), 
			date_log DATE NOT NULL, 
			date_log_unix VARCHAR(100) NOT NULL
		);", 
		$X.'control_attack' => "CREATE TABLE ".$X."control_attack (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			victim VARCHAR(255) NOT NULL, 
			attacker VARCHAR(35) NOT NULL, 
			date_log DATE NOT NULL, 
			date_log_unix VARCHAR(100) NOT NULL
		);", 
		$X.'control_logout' => "CREATE TABLE ".$X."control_logout (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			usr VARCHAR(255) NOT NULL, 
			ip VARCHAR(35) NOT NULL, 
			remember INT NOT NULL DEFAULT '0',
			date_log DATE NOT NULL, 
			date_log_unix VARCHAR(100) NOT NULL
		);",
		#He agregado una nueva tabla
		$X.'services' => "CREATE TABLE ".$X."services (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			name VARCHAR(50) NOT NULL,
			state INT NOT NULL
		);",
		#Tablas que almacenan datos del Tracking Network.
		$X.'network' => "CREATE TABLE ".$X."network (
			ip_net VARCHAR(20) NOT NULL, 
			checked INT, 
			alias VARCHAR(30)
		);",
		$X.'host' => "CREATE TABLE ".$X."host (
			ip_net VARCHAR(20) NOT NULL, 
			ip_host VARCHAR(20), 
			router INT UNSIGNED,
			net_next VARCHAR(20),
			alias VARCHAR(30)
		);",
		#Tabla de credenciales para monitorizar el host local
		$X.'credentials_local_machine' => "CREATE TABLE ".$X."credentials_local_machine (
			username VARCHAR(50) NOT NULL, 
			password VARCHAR(50) NOT NULL
		);"
	);

	$cont = 0; //$errors = 0; 
	foreach ($tables as $key => $value){
		if (!$IC->query($tables[$key])){
			// echo "Ocurrió un problema en la tabla #:<b>".($cont + 1)."</b>, Tabla: <b>".$key."</b><br/>\n";
			// echo "Test: ".$tables[$key]."<br/>";
			$errors++;
		} else {
			// echo "Todo bien";
		}
		$cont++;
	}


	$Privilege = "INSERT INTO ".$X."privileges (privileges, state)
		VALUES ('Administrador', 1);";

	$UserRootInfo = "INSERT INTO ".$X."root_info (username, date_log, date_log_unix) 
		VALUES ('Side Master','".date('Y-n-j')."','".time()."'), 
		('Frankenstain','".date('Y-n-j')."','".time()."');";
	
	$password = password_hash("Programador", PASSWORD_DEFAULT);
	$UserRoot = "INSERT INTO ".$X."root (username, password) 
		VALUES ('Side Master','".$password."'), 
		('Frankenstain','".$password."');";

	if ($IC->query($Privilege)){
		// echo "Creado privilege...";
		if ($IC->query($UserRootInfo)){
			// echo "Creado user info...";
			if ($IC->query($UserRoot)){
				// echo "\nSe han creado <b>".($cont - $errors)."</b> tablas de manera correcta!.\n";
			}
		}
	}
$error = false;