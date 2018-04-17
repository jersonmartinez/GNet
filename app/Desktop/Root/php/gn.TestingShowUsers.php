<?php
	@session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $R = $CN->getHostWithOutInterfaces();

    $jsondata = array();

    if ($R->num_rows > 0){
   		$jsondata["success"] = true;
   		$jsondata["data"]["message"] = sprintf("Se han encontrado %d registros", $R->num_rows);
   		$jsondata["data"]["count"] = $R->num_rows;
   		$jsondata["data"]["hosts"] = array();

   		while ($row = $R->fetch_object())
   			$jsondata["data"]["hosts"][] = $row;
    } else {
    	$jsondata["success"] = false;
    	$jsondata["data"] = array(
    			"message" => "No se encontraron resultados"
    		);
    }

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
    
    exit();
?>