<?php
	$fn = "../../../config/Config.tcb";
	include ("../../../config/connect_server/ic.connect_server.php");

	#Author: Jerson A. Martínez M. (Side Master).
	#Class: Services and Network.

	class Services {
		var $NetworkState, $MySQLState, $ApacheState;
		var $IC, $X;

		public function Load($IC, $X){
			$this->IC = $IC;
			$this->X  = $X;

			$GetData = $this->IC->query("SELECT name, state FROM ".$this->X."services;");

			if ($GetData->num_rows > 0){
				$data = [];

				while ($GD = $GetData->fetch_array(MYSQLI_ASSOC))
					$data += [$GD['name'] => $GD['state']];

				$this->NetworkState = $data['Network'];
				$this->MySQLState 	= $data['MySQL'];
				$this->ApacheState 	= $data['Apache'];
			} else {
				echo "No hay datos";
			}
		}

		public function StateAssign($svc, $state){
			if ($this->IC)
				if ($this->IC->query("UPDATE ".$this->X."services SET state='".$state."' WHERE name='".$svc."';"))
					$this->State($svc, $state);
			else
				echo "Ha ocurrido un problema al intentar conectado con el servidor.";
		}

		public function State($svc, $state){
			if ($svc == "Apache")
				$this->ApacheState = $state;
			else if ($svc == "Network")
				$this->NetworkState = $state;
			else if ($svc == "MySQL")
				$this->MySQLState = $state;
			else
				echo "Error en la lectura del servicio";
		}
	}

	class Network extends Services {
		var $IC;
		var $X;

		function __construct($Connection, $Prefix){
			if ($Connection){
				$this->IC = $Connection;
				$this->X  = $Prefix;
			} else {
				echo "Ha ocurrido un problema al intentar conectado con el servidor.";
			}
		}

		function Add($name, $pass){
			$Insert = "INSERT INTO ".$this->X."network (id, name, pass, allow) VALUES ('','".$name."','".$pass."', '0');";
			
			if ($this->IC->query($Insert))
				return true;
			else
				return false;
		}

		function Delete($id){
			$Del = "DELETE FROM ".$this->X."network WHERE id='".$id."';";

			if ($this->IC->query($Del))
				return true;
			else
				return false;
		}

		function History($order){
			$getHistory = "SELECT * FROM ".$this->X."network ORDER BY id ".$order.";";
			$gH = $this->IC->query($getHistory);

			if ($gH->num_rows <= 0)
				return false;

			return $gH;
		}

		function OnHistory($id){
			$Object = $this->History("ASC");
			$Update = "UPDATE ".$this->X."network SET allow='1' WHERE id='".$id."';";

			if ($Object != false)
				while ($R = $Object->fetch_array(MYSQLI_ASSOC))
					if ($R['id'] != $id)
						$this->IC->query("UPDATE ".$this->X."network SET allow='0' WHERE id='".$R['id']."';");

			if ($this->IC->query($Update))
				return true;
			
			return false;
		}

		function OffHistory($id){
			$Update = "UPDATE ".$this->X."network SET allow='0' WHERE id='".$id."';";

			if ($this->IC->query($Update))
				return true;

			return false;
		}

		function Detail(){
			$Object = $this->History("ASC");
			$id = 0;

			if ($Object != false){
				while ($R = $Object->fetch_array(MYSQLI_ASSOC)){
					if ($R['allow'] == 1){
						$id = $R['id'];
						break;
					}
				}
				
				if ($id == 0)
					return $this->IC->query("SELECT * FROM ".$this->X."network ORDER BY id DESC LIMIT 1;")->fetch_array(MYSQLI_ASSOC);
				else 
					return $this->IC->query("SELECT * FROM ".$this->X."network WHERE id='".$id."';")->fetch_array(MYSQLI_ASSOC);
			}

			return false;
		}

		function OnMain($state){
			$Object = $this->Detail();

			if ($Object != false){
				$Update = "UPDATE ".$this->X."network SET allow='".$state."' WHERE id='".$Object['id']."';";

				if ($this->IC->query($Update))
					return true;
			}

			return false;
		}
	}

	#-> Instancia de los servicios, MySQL, Apache. 
	#$Services = new Services();

	#-> Se cargan los datos registrados. Conexión, Prefijo.
	#$Services->Load($IC, $X);

	#-> Se asigna un nuevo estado, Conexió, prefijo, servicio, estado.
	#$Services->StateAssign($_GET['svc'], $_GET['state']);

	#-> Instancia de Network conectando al servidor.
	#$Network = new Network($IC, $X);

	#-> Agrega nuevo perfil de red. Nombre, Contraseña. Retorna true o false.
	#$Network->Add($_GET['name'], $_GET['pass']);

	#-> Elimina un perfil de red. Identificador. Retorna true o false.
	#$Network->Delete(5);

	#-> Crea un objeto que extrae todos los perfiles de red. Orden.
	#$Object = $Network->History("DESC");
		#-->
			#if ($Object != false){
			#	while ($new = $Object->fetch_array(MYSQLI_ASSOC)){
			#		echo "ID: ".$new['id'].", Nombre: ".$new['name']."<br/>";
			#	}
			#}

	#-> Habilitar un perfil de red del historial. Identificador. Retorna true o false.
	#$Network->OnHistory(2);

	#-> Deshabilitar perfil de red. Identificador. Retorna true o false. 
	#$Network->OffHistory(2);

	#-> Detalles sobre la red habilitada o la última red creada. Retorna true o false.
	#$Object = $Network->Detail();
		#-->
			#if ($Object != false)
			#	echo $Object['name'];
			#else
			#	echo "Problems";

	#-> Habilitar y Deshabilitar perfil de red, última o habilitada. Retorna true o false.
	#$Network->OnMain(1);
?>