<?php
	class ConnectSSH {
		public $ip_host;
		private $username;
		private $password;
		public $connect;
		public $CN = false;
		private $stream;
		private $errors = array();
		private $local_path = "/var/www/html/GNet/app/scripts/";
		private $remote_path;
		private $filename;

		public $db_connect;
		public $db_prefix;

		function __construct($ip_host = "127.0.0.1", $username = "root", $password = "123"){			
			if (!function_exists("ssh2_connect")) {
        		array_push($this->errors, "La función ssh2_connect no existe");
			}

        	if(!(@$this->connect = @ssh2_connect($ip_host, 22))){
				$this->ip_host = $ip_host;
        		array_push($this->errors, "No hay conexión con al dirección IP: " . $ip_host);
		    } else {
		        if(@!ssh2_auth_password($this->connect, $username, $password)) {
        			array_push($this->errors, "Autenticación invalida");
		        } else {
					$this->ip_host 		= $ip_host;
					$this->username 	= $username;
					$this->password 	= $password;
					$this->remote_path 	= "/home/";
					$this->CN 			= true;
		        }
		    }
		}

		public function FinalConnect($ip_host, $username, $password){
			if (!function_exists("ssh2_connect")) {
        		array_push($this->errors, "La función ssh2_connect no existe");
			}

        	if(!($this->connect = ssh2_connect($ip_host, 22))){
				$this->ip_host = $ip_host;
        		array_push($this->errors, "No hay conexión con al dirección IP: " . $ip_host);
		    } else {
		        if(!ssh2_auth_password($this->connect, $username, $password)) {
        			array_push($this->errors, "Autenticación invalida");
		        } else {
					$this->ip_host 		= $ip_host;
					$this->username 	= $username;
					$this->password 	= $password;
					$this->remote_path 	= "/home/";
		        }
		    }

		    return true;
		}

		public function RunLines($RL){
			if(!($this->stream = ssh2_exec($this->connect, $RL)))
		        return "Falló: El comando no se ha podido ejecutar.";
				
			$data = "";	
			stream_set_blocking($this->stream, true);
			while ($buf = fread($this->stream, 4096))
                $data .= $buf;
            
            if (fclose($this->stream))
            	return $data;
		}

		public function writeFile($Instructions, $filename){
			$inputfile = file_put_contents($this->local_path.$filename, implode("\n", $Instructions));
			if ($inputfile === false)
				die("El script <b>".$filename."</b>, no se ha podido crear.");
			@chmod($this->local_path.$filename, 0777);
		
			return true;
		}

		public function sendFile($filename){
			$scp = @ssh2_scp_send($this->connect, $this->local_path.$filename, $this->remote_path.$filename, 0777);
			if (!$scp){
				return false;
			} else {
				return true;
			}
		}

		public function recvFile($remotePath){
			$scp = ssh2_scp_recv($this->connect, $remotePath, "/Backups");
			if (!$scp){
				return false;
			} else {
				return true;
			}
		}

		public function deleteFile($filename){
			if (!unlink($this->local_path.$filename))
				return false;
			return true;
		}

		public function ConfigSyslogClient($ServerSyslog){
			$filename = "ConfigSyslogClient.sh";

			$ActionArray[] = 'echo "*.*	@@$1:514" > /etc/rsyslog.d/gnet_syslog.conf';
			array_push($ActionArray, 'service rsyslog restart');

			$RL[] = $this->remote_path.$filename." ".$ServerSyslog;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			
			return false;
		}

		public function ConfigSyslogServer($IP, $DB, $User, $Pass, $Level){
			$filename = "ConfigSyslogServer.sh";

			$ActionArray[] = 'Servidor=$1 DB=$2 User=$3 Pass=$4 Severity=$5 FileConf="/etc/rsyslog.d/mysql.conf"';
			array_push($ActionArray, 'echo "$"ModLoad imtcp > $FileConf');
			array_push($ActionArray, 'echo "$"InputTCPServerRun 514 >> $FileConf');
			array_push($ActionArray, 'echo "$"ModLoad ommysql >> $FileConf');
			array_push($ActionArray, "case $5 in");
			array_push($ActionArray, '	"emergencia")');
			array_push($ActionArray, '		echo "*.emerg :ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf');
			array_push($ActionArray, '	;;');
			array_push($ActionArray, '	"alerta")');
			array_push($ActionArray, '		echo "*.alert :ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf');
			array_push($ActionArray, '	;;');
			array_push($ActionArray, '	"critico")');
			array_push($ActionArray, '		echo "*.crit :ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf');
			array_push($ActionArray, '	;;');
			array_push($ActionArray, '	"error")');
			array_push($ActionArray, '		echo "*.err :ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf');
			array_push($ActionArray, '	;;');
			array_push($ActionArray, '	"advertencia")');
			array_push($ActionArray, '		echo "*.warn :ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf');
			array_push($ActionArray, '	;;');
			array_push($ActionArray, '	"notificacion")');
			array_push($ActionArray, '		echo "*.notice :ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf');
			array_push($ActionArray, '	;;');
			array_push($ActionArray, '	"informacion")');
			array_push($ActionArray, '		echo "*.info :ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf');
			array_push($ActionArray, '	;;');
			array_push($ActionArray, '	"depuracion")');
			array_push($ActionArray, '		echo "*.debug :ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf');
			array_push($ActionArray, '	;;');
			array_push($ActionArray, '	"todo")');
			array_push($ActionArray, '		echo "*.* :ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf');
			array_push($ActionArray, '	;;');
			array_push($ActionArray, 'esac');
			array_push($ActionArray, 'service rsyslog restart');

			$RL[] = $this->remote_path.$filename." ".$IP." ".$DB." ".$User." ".$Pass." ".$Level;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			
			return false;
		}

		public function getDHCPShowAssignIP(){
			$filename = "getDHCPShowAssignIP.sh";
			$ActionArray[] = 'echo "="';
			array_push($ActionArray, "MES=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $1'})");
			array_push($ActionArray, "DIA=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $2'})");
			array_push($ActionArray, "HORA=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $3'})");
			array_push($ActionArray, "IP=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $8'})");
			array_push($ActionArray, "MAC=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print $10'})");
			array_push($ActionArray, "INTERFAZ=$(service isc-dhcp-server status | tail -n10 | grep 'DHCPACK' | awk {'print \$NF'})");
			array_push($ActionArray, 'echo "${MES[*]} | "');
			array_push($ActionArray, 'echo "${DIA[*]} | "');
			array_push($ActionArray, 'echo "${HORA[*]} | "');
			array_push($ActionArray, 'echo "${IP[*]} | "');
			array_push($ActionArray, 'echo "${MAC[*]} | "');
			array_push($ActionArray, 'echo "${INTERFAZ[*]} | "');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getDNSFileZones(){
			$filename = "getDNSFileZones.sh";
			$ActionArray[] = "ZONAS=($(cat /etc/bind/named.conf.local | grep 'file' | awk {'print $2'} | tr -d '\";'))";
			array_push($ActionArray, 'CANT_ZONAS=${#ZONAS[*]}');
			array_push($ActionArray, 'for (( i = 0; i < $CANT_ZONAS; i++ )); do');
			array_push($ActionArray, '	DOMINIO=$(cat ${ZONAS[$i]} | grep "SOA" | awk {"print $4"} | sed "s/.$//g")');
			array_push($ActionArray, '	TRADUC=$(cat ${ZONAS[$i]} | grep -e "IN" | tail -n1 | awk "! /$DOMINIO/ {print $1}")');
			array_push($ActionArray, '	IP=$(cat ${ZONAS[$i]} | grep "IN" | tail -n1 | awk "! /$DOMINIO/ {print $4}")');
			array_push($ActionArray, '	echo " ${ZONAS[$i]},$DOMINIO,${TRADUC[*]}.$DOMINIO,${IP[*]}"');
			array_push($ActionArray, "done");
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getNetworkIPLocal(){
			$IP 		= shell_exec('ip route show | awk {"print $NF"}');
			$ArrayIP 	= explode("metric ", $IP);
			$ArrayFinal = array();
			for ($i=0; $i < count($ArrayIP); $i++){
				$ArrayIPTwo = explode(" dev ", $ArrayIP[$i]); 
				for ($j=0; $j < count($ArrayIPTwo); $j++)
					if (strpos($ArrayIPTwo[$j], 'static') != true && strpos($ArrayIPTwo[$j], 'link src') != true && strpos($ArrayIPTwo[$j], 'via') != true)	
					  	array_push($ArrayFinal, trim(substr($ArrayIPTwo[$j], 4)));
			}
			return $ArrayFinal;
		}

		public function getNmapTrackingIP($RangeIPAddress){
			if (is_array($RangeIPAddress)){
				for ($i = 0; $i < count($RangeIPAddress); $i++){
					$val = shell_exec("nmap -sP ".$RangeIPAddress[$i]);
					$ArrayContent 	= explode("Host is up", $val); 
					$ArrayData 		= array();
					for ($i=0; $i < count($ArrayContent); $i++) { 
						$ArrayContentTwo = explode("Nmap scan report for ", $ArrayContent[$i]); 
						for ($j=0; $j < count($ArrayContentTwo); $j++) 
							if (filter_var(trim($ArrayContentTwo[$j]), FILTER_VALIDATE_IP))
							    array_push($ArrayData, $ArrayContentTwo[$j]);
							
					}
				}
				return $ArrayData; 
			} else if (is_string($RangeIPAddress)) {
				$val = shell_exec("nmap -sP ".$RangeIPAddress);
				$ArrayContent 	= explode("Host is up", $val); 
				$ArrayData 		= array();
				for ($i=0; $i < count($ArrayContent); $i++) { 
					$ArrayContentTwo = explode("Nmap scan report for ", $ArrayContent[$i]); 
					for ($j=0; $j < count($ArrayContentTwo); $j++)
						if (filter_var(trim($ArrayContentTwo[$j]), FILTER_VALIDATE_IP))
						    array_push($ArrayData, $ArrayContentTwo[$j]);
						
				}
				return $ArrayData; 
			}
		}
		
		// public function getErrors(){
		// 	return implode("<br/>", $this->errors);
		// }

		public function testing(){
			return "Okay";
		}

		public function getIPLocalCurrent(){
			return shell_exec("ip route show default | awk '/default/ {print $3}'");
		}

		public function getMyIPServer(){
			return shell_exec("ip -4 route get 1.1.1.1 | awk {'print $7'} | tr -d '\n'");
		}

		public function checkNetwork($ip_net){
			if ($this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."network WHERE ip_net='".trim($ip_net)."';")->num_rows > 0)
				return true;

			return false;
		}

		public function checkHost($ip_host){
			if ($this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE ip_host='".trim($ip_host)."';")->num_rows > 0)
				return true;

			return false;
		}

		public function addNetwork($ip_net, $checked = "0", $alias = ""){
			if ($this->db_connect->query("INSERT INTO ".$this->db_prefix."network (ip_net, checked, alias) VALUES ('".trim($ip_net)."','".$checked."', '".$alias."');"))
				return true;

			return false;
		}

		public function updateNetwork($ip_net, $checked){
			if ($this->db_connect->query("UPDATE ".$this->db_prefix."network SET checked='".$checked."' WHERE ip_net='".$ip_net."';"))
				return true;

			return false;
		}

		public function updateNetworkNextRouterAlias($ip_net_next, $alias){
			if ($this->db_connect->query("UPDATE ".$this->db_prefix."host SET alias='".$alias."' WHERE net_next='".$ip_net_next."';"))
				return true;

			return false;
		}

		public function updateNetworkAlias($ip_net, $alias){
			if ($this->db_connect->query("UPDATE ".$this->db_prefix."network SET alias='".$alias."' WHERE ip_net='".$ip_net."';"))
				return true;

			return false;
		}

		public function updateHostAlias($ip_host, $alias){
			if ($this->db_connect->query("UPDATE ".$this->db_prefix."host SET alias='".$alias."' WHERE ip_host='".$ip_host."';"))
				return true;

			return false;
		}

		public function updateHostRouterAlias($ip_net, $alias){
			if ($this->db_connect->query("UPDATE ".$this->db_prefix."host SET alias='".$alias."' WHERE ip_net='".$ip_net."' AND router='1';"))
				return true;

			return false;
		}

		public function addHost($ip_net, $ip_host, $router, $net_next, $alias = ""){
			$query = "INSERT INTO ".$this->db_prefix."host (ip_net, ip_host, router, net_next, alias) VALUES ('".$ip_net."', '".$ip_host."', '".$router."', '".$net_next."', '".$alias."');";
			
			if ($this->db_connect->query($query))
				return true;

			return false;
		}

		public function addCredentialsLocalMachine($user, $pass){
			$query = "INSERT INTO ".$this->db_prefix."credentials_local_machine (username, password) VALUES ('".$user."', '".$pass."');";
			
			if ($this->db_connect->query($query))
				return true;

			return false;
		}

		public function getCountCredentialsLocalMachine(){
			return @(int)$this->db_connect->query("SELECT count(*) AS 'count' FROM ".$this->db_prefix."credentials_local_machine;")->fetch_array()['count'];
		}

		public function getCredentialsLocalMachine(){
			return $this->db_connect->query("SELECT username, password FROM ".$this->db_prefix."credentials_local_machine;")->fetch_array();
		}

		public function truncateCredentialsLocalMachine(){
			if ($this->db_connect->query("TRUNCATE TABLE ".$this->db_prefix."credentials_local_machine;"))
				return true;
		
			return false;
		}

		public function getIPNetFromIPHost($ip_host){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE ip_host='".$ip_host."' LIMIT 1;");
		}

		public function getHostTypeRouterLast(){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE router='1' AND net_next!='-' ORDER BY ip_net DESC LIMIT 1;");
		}

		public function getHostNetwork($network){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE ip_net='".$network."';");
		}

		public function getHostTypeRouter(){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE router='1' ORDER BY ip_net ASC;");
		}

		public function getHostTypeSwitch($IPNet){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE ip_net='".$IPNet."' AND router='0';");
		}

		public function getHostTypeHost(){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE router='0' ORDER BY ip_net ASC;");
		}

		public function getAllHost(){
			return @$this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host;");
		}

		public function getHostCheckNetNext($NetNext){
			if (strlen($NextNet) > 6 && strlen($NextNet) < 19){
				return ($this->db_connect->query("SELECT * FROM ".$this->db_prefix."host WHERE net_next='".$NetNext."';")->num_rows > 0);
			}

			return false;
		}

		public function getHostWithOutInterfaces(){
			return @$this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE NOT (router='1' AND net_next='-');");
		}

		# Extract all IP Address of network.
		public function getIPNet(){
			return @$this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."network ORDER BY ip_net ASC;");
		}

		# Extract the number of records.
		public function getIPNetNumber(){
			return @$this->db_connect->query("SELECT DISTINCT count(*) as 'number' FROM ".$this->db_prefix."network;");
		}

		public function getIPNetNext($ip_net){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."network WHERE ip_net>'".$ip_net."' ORDER BY ip_net DESC LIMIT 1;")->fetch_array(MYSQLI_ASSOC)['ip_net'];
		}

		public function getIPNetLast(){
			return @$this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."network ORDER BY ip_net DESC LIMIT 1;");
		}

		public function getIPNetOnly(){
			return @$this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."network LIMIT 1;")->fetch_array(MYSQLI_ASSOC)['ip_net'];
		}

		public $CommandIpRoute = "ip route | sed -e '/src/ !d' | sed '/default/ d' | cut -d ' ' -f1";

		//Limpieza de tablas
		public function InitTables(){
			$this->db_connect->query("TRUNCATE ".$this->db_prefix."network;");
			$this->db_connect->query("TRUNCATE ".$this->db_prefix."host;");
		}

		public function IsRouter($IPHost, $user = "root", $pass = "123"){
			$this->FinalConnect($IPHost, $user, $pass);

			$RL[] = "cat /proc/sys/net/ipv4/ip_forward";
			
			//Se obtiene valores booleanos (0, 1 = enrutador)
			$ip_forward = (int)trim($this->RunLines(implode("\n", $RL)));

			return $ip_forward;
		}

		public function getIpRouteLocal(){
			return  shell_exec($this->CommandIpRoute);
		}

		public function getIpRouteRemote($IPHost, $user = "root", $pass = "123"){
			$this->FinalConnect($IPHost, $user, $pass);

			$RA[] = $this->CommandIpRoute;

			return implode("\n", explode("\n", $this->RunLines(implode("\n", $RA))));
		}

		public function getCountNetwork(){
			return @(int)$this->db_connect->query("SELECT DISTINCT count(*) AS 'count' FROM ".$this->db_prefix."network;")->fetch_array()['count'];
		}

		public function getCountNetworkChecked(){
			return @(int)$this->db_connect->query("SELECT DISTINCT count(*) AS 'count' FROM ".$this->db_prefix."network WHERE checked='0';")->fetch_array()['count'];
		}

		#Obtiene una sola red por la que no se ha sondeado.
		public function getOnlyOneNetworkChecked(){
			return @$this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."network WHERE checked='0' ORDER BY ip_net ASC LIMIT 1;");
		}

		#Rastreo de Red
		public function SpaceTest(){
			#Limpiar las tabalas: network, host.
			$this->InitTables();

			do {
				#Verificar si hay redes escritas en la tabla: network.
				if (@!$this->getCountNetwork()){ #No hay redes [0]
					#Si no hay redes, se agrega la local.
					$getIPRouterLocalVals = $this->getIpRouteLocal();

					// var_dump(explode("\n", trim($getIPRouterLocalVals)));

					$getIPRouterLocalVals = explode("\n", trim($getIPRouterLocalVals));

					if (is_array($getIPRouterLocalVals)){
						foreach ($getIPRouterLocalVals as $ValTemp){
							@$this->addNetwork($ValTemp);
						}
					}
				}

				// exit();

				#Obtiene una sola red por la que no se ha sondeado.
				if ($this->getOnlyOneNetworkChecked()->num_rows > 0){

					#Se obtiene la dirección de red no escaneada.
					$Network = $this->getOnlyOneNetworkChecked()->fetch_array(MYSQLI_ASSOC)['ip_net'];
					
					#Se toma una red no escaneada y se aplica el sondeo de dispositivos.
					$ArrayIPAddress = $this->SondearRed($Network);
					#$D = Array
					// 192.168.100.1
					// 192.168.100.4
					// 192.168.100.6
					// 192.168.100.20
					// --

					# Se elimina el último elemento del array (este se encuentra vacío)
					unset($ArrayIPAddress[count($ArrayIPAddress)-1]);

					$Index = 0;

					# Se recorren todas direcciones IP almacenadas en el Array.
					foreach ($ArrayIPAddress as $value) {
						# Elimina el host (servidor de monitorizaciòn) actual. 
						if ($value == $this->getMyIPServer())
							// unset($ArrayIPAddress[$Index]);

						$Index++;
					}

					// #$D = Array
					// 192.168.100.1 --


					foreach ($ArrayIPAddress as $value) {
						#192.168.100.1 --, 192.168.100.4
						$ip_forward = @$this->IsRouter($value); #Es Router (100.1 = yes)
						
						// if ($ip_forward){
						// 	echo "<br/>La direccion: ",$value," es enrutador";
						// } else {
						// 	echo "<br/>La direccion: ",$value," no es enrutador";
						// }
					
						// exit();

						$ArrayNets = @explode("\n", $this->getIpRouteRemote($value));
						
						# En caso de ser un enrutador
						# ArrayNets: 192.168.100.1
						#				192.168.100.0/24 [0]
						# 				192.168.101.0/24 [1]
						# 				192.168.103.0/24 [2]

						#Elimino el ultimo estado vacio.
						unset($ArrayNets[count($ArrayNets)-1]); 
						
						// echo " Para el host: ", $value, "[";						
						// foreach ($ArrayNets as $key) {
						// 	echo $key, ", ";
						// }
						// echo "] -- Cantidad: ", count($ArrayNets), " ";

						// echo "<br/>";

						// $iter = 0;
						// foreach ($ArrayNets as $values) {
						// 	echo "[",$iter++,"] IP Net: ",$values;
						// 	echo "<br/>";
						// }


						# Eliminar la posición del array donde este comparta la misma dirección de red.
						# Agregar las direcciones de red distintas en la DB.

						// $NextNet = $ArrayNets[0]; #192.168.100.0/24
						$NextNet = "-";

						// echo "Network: ",$Network," |  Value: ",$value," | IP Forward: ",$ip_forward," | Next Net: ",$NextNet;
						
						// break;
						// exit;

						$CountArrayNets = count($ArrayNets);

						if ($ip_forward){
							// if ($CountArrayNets > 1){
								for ($i = 0; $i < $CountArrayNets; $i++){
									
									// if (trim($Network) == trim($NextNet)){
									// 	$NextNet = "-";
									// } else {
									// 	$this->addNetwork($NextNet);
									// }

									if (!$this->checkNetwork($ArrayNets[$i])){
										$this->addNetwork($ArrayNets[$i]);
									}
								}
							// }	
						}

						$NextNet = $ArrayNets[1];
						// echo "Cantidad del arreglo: ", count($ArrayNets), "; deberían ser 3";
						// foreach ($ArrayNets as $side){
						// 	echo $side, ", ";
						// }
						if (trim($Network) == trim($NextNet)){
							$NextNet = "-";
						}


						// if ($ip_forward){
						// 	$NextNet = $ArrayNets[1];
						// 	if (trim($Network) == trim($NextNet)){
						// 		$NextNet = "-";
						// 	} else {
						// 		$this->addNetwork($NextNet);
						// 	}
						// }

						# (192.168.100.0/24)
						if (!$this->getHostCheckNetNext($NextNet)){
							$this->addHost($Network, $value, $ip_forward, $NextNet);
						}
		    		}

					$this->updateNetwork($Network, 1);					
				}
			} while ($this->getCountNetworkChecked());
		}

		public function IPRouteShow($IPHost){
			$R = $this->getIPNet();

			if ($IPHost == "localhost"){
				$AddrIPNext = explode("\n", $this->getIPLocal());

				return trim($AddrIPNext[0]);
			} else {
				$this->FinalConnect($IPHost, "root", "123");
				$RA[] = "ip route | sed '/default/ d' | cut -d ' ' -f1";

				$AddrIPNext = explode("\n", $this->RunLines(implode("\n", $RA)));
			}

			if ($R->num_rows > 0){
				while ($row = $R->fetch_array(MYSQLI_ASSOC)){
					if (in_array($row['ip_net'], $AddrIPNext)){
						return $row['ip_net'];
					}
				}
			}
		}

		public function OnlyMonitoring($Host){
			return explode("\n", $this->RunLines("nmap -sV -O -v ".$Host));
		}

		public function SondearRed($IPNet){
			return explode("\n", shell_exec("nmap ".$IPNet." --host-timeout 95s -n -sP | grep report | awk '{print $5}'"));
		}

		public function RastreoTotal($IPNet){
			return explode("\n", shell_exec("nmap ".$IPNet." --host-timeout 95s -n -sP"));
		}

		public function SrMartinez(){
			return explode("\n", shell_exec("nmap 192.168.100.0/24 -n -sP | grep report | awk '{print $5}'"));
		}

		public function getMemoryState(){
			$filename = "getMemoryState.sh";
			$ActionArray[] = "MEMORIA=($(free -m | grep 'Mem' | cut -d ':' -f2))";
			array_push($ActionArray, 'echo "${MEMORIA[0]},${MEMORIA[1]},${MEMORIA[2]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getSwapState(){
			$filename = "getSwapState.sh";
			$ActionArray[] = "SWAP=($(free -m | egrep '(Intercambio|Swap)' | cut -d ':' -f2))";
			array_push($ActionArray, 'echo "${SWAP[0]},${SWAP[1]},${SWAP[2]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getCpuState(){
			$filename = "getcpuState.sh";
			$ActionArray[] = "NameModel=($(cat /proc/cpuinfo | grep name | cut -d ':' -f2))";
			array_push($ActionArray, "Velocidad=$(cat /proc/cpuinfo | grep name | cut -d ' ' -f 10)");
			array_push($ActionArray, "UsoUser=$(top -n1 -b | grep '%Cpu' | awk {'print $2'} | sed 's/,/./g')");
			array_push($ActionArray, "UsoSystem=$(top -n1 -b | grep '%Cpu' | awk {'print $4'} | sed 's/,/./g')");
			// array_push($ActionArray, 'UsoTotal=$(echo "$UsoUser + $UsoSystem" | bc)');
			// array_push($ActionArray, 'Disponible=$(echo "100 - $UsoTotal" | bc)');
			array_push($ActionArray, "TotalProc=$(ps ax | wc -l)");
			array_push($ActionArray, 'echo "${NameModel[*]},$UsoUser,$UsoSystem,$TotalProc,"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getDiskState(){
			$filename = "getDiskState.sh";
			$ActionArray[] = 'Disk=($(df -H /dev/sda1 | sed "1d" | sed "s/,/./g" | tr -d "G"))';
			array_push($ActionArray, 'echo "${Disk[1]},${Disk[2]},${Disk[3]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getProcState(){
			$filename = "getProcState.sh";
			$ActionArray[] = "Proc=($(ps axo pid,pcpu,size,time,cmd --sort -pcpu | sed '1d' | awk {'print $1 ,$2 ,$3 ,$4 ,$5'}))";
			array_push($ActionArray, 'echo "${Proc[*]},"');	
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getNetAddress(){
			$filename = "getNetAddress.sh";
			$ActionArray[] = 'Interfaces=($(ip addr show | egrep "[1-9]: " | cut -d ":" -f2 | tr -d " "))';
			array_push($ActionArray, 'for i in ${Interfaces[*]}; do');
			array_push($ActionArray, '	DirIP=$(ip addr show "$i" | grep -w inet | cut -d " " -f6 | cut -d "/" -f1)');
			array_push($ActionArray, '	Ether=$(ip addr show "$i" | grep -w ether | cut -d " " -f6)');
			array_push($ActionArray, '	if [[ $DirIP != "" ]]; then');
			array_push($ActionArray, '		echo "$i|$DirIP|$Ether,"');
			array_push($ActionArray, '	else');
			array_push($ActionArray, '		echo "$i|No tiene IP asignada|$Ether,"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, 'done');	
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getTableRoute(){
			$filename = "getTableRoute.sh";
			$ActionArray[] = "Net=$(ip route show | awk {'print $1'})";
			array_push($ActionArray, 'for i in ${Net[*]}; do');
			array_push($ActionArray, '	Comp=$(ip route show | grep -w "$i" | grep -w via)');
			array_push($ActionArray, '	if [[ $Comp != "" ]]; then');
			array_push($ActionArray, '		Int=$(ip route show | grep -w "$i" | cut -d " " -f5)');
			array_push($ActionArray, '		Salt=$(ip route show | grep -w "$i" | cut -d " " -f3)');
			array_push($ActionArray, '		echo "$i|$Int|$Salt,"');
			array_push($ActionArray, '	else');
			array_push($ActionArray, '		Int=$(ip route show | grep -w "$i" | cut -d " " -f3)');
			array_push($ActionArray, '		echo "$i|$Int|-,"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, 'done');	
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getPortsListen(){
			$filename = "getPortsListen.sh";
			$ActionArray[] = "Ports=($(lsof -i -nP | sed '1d' | egrep -v '(ESTAB|WAIT)' | awk {'print $9 ,$8 ,$5 ,$1'} | cut -d':' -f2 | uniq))";
			array_push($ActionArray, 'echo "${Ports[*]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $ActionArray));
			// return getErrors();
			return false;
		}	

		public function getStatisticsNetwork(){
			$filename = "getStatisticsNetwork.sh";
			$ActionArray[] = "IP=($(netstat -s | grep -w Ip: -A8 | sed '1,2d' | awk {'print $1'}))";
			// array_push($ActionArray, "ForwardIp=$(netstat -s | grep -w Ip: -A1 | sed '1d' | awk {'print $2'})");
			array_push($ActionArray, 'echo "${IP[*]} "');
			array_push($ActionArray, 'echo "="');
			array_push($ActionArray, "TCP=($(netstat -s | grep -w Tcp: -A10 | sed '1d' | awk {'print $1'}))");
			array_push($ActionArray, 'echo "${TCP[*]} "');
			array_push($ActionArray, 'echo "="');
			array_push($ActionArray, "UDP=($(netstat -s | grep -w Udp: -A6 | sed '1d' | awk {'print $1'}))");
			array_push($ActionArray, 'echo "${UDP[*]} "');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $ActionArray));
			// return getErrors();
			return false;
		}

		public function getBatteryState(){
			$filename = "getBatteryState.sh";
			$ActionArray[] = "Porcentaje=$(upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep percentage | awk {'print $2'} | tr -d '%')";
			array_push($ActionArray, "StatusBat=$(upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep state | awk {'print $2'})");
			array_push($ActionArray, 'echo "$Porcentaje,$StatusBat,"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getInfoOS(){
			$filename = "getInfoOS.sh";
			$ActionArray[] = "HostName=$(hostname)";
			array_push($ActionArray, "NameOs=$(lsb_release -si)");
			array_push($ActionArray, "Version=$(lsb_release -sr)");
			array_push($ActionArray, "TypeMachine=$(uname -m)");
			array_push($ActionArray, "Kernel=$(uname -r)");
			array_push($ActionArray, 'echo "$HostName,$NameOs,$Version,$TypeMachine,$Kernel,"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getUsersConnected(){
			$filename = "getUsersConnected.sh";
			$ActionArray[] = "Users=($(w | sed '1,2d' | awk {'print $1 ,$4'}))";
			array_push($ActionArray, 'echo "${Users[*]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getNetworkServices() {
			$filename = "getNetworkServices.sh";
			$ActionArray[] = "Services=$(lsof -i -n | egrep -v '(ESTAB|WAIT)' | sed '1d' | awk {'print $1'} | uniq)";
			array_push($ActionArray, 'echo "${Users[*]},"');
			array_push($ActionArray, 'for i in ${Services[*]}; do');
			array_push($ActionArray, 'case $i in');
			array_push($ActionArray, '"sshd" )');
			array_push($ActionArray, 'echo "SSH,"');
			array_push($ActionArray, ';;');
			array_push($ActionArray, '"apache2" )');
			array_push($ActionArray, 'echo "HTTP,"');
			array_push($ActionArray, ';;');
			array_push($ActionArray, '"mysqld" )');
			array_push($ActionArray, 'echo "MySQL,"');
			array_push($ActionArray, ';;');
			array_push($ActionArray, '"named" )');
			array_push($ActionArray, 'echo "DNS,"');
			array_push($ActionArray, ';;');
			array_push($ActionArray, '"vsftpd" )');
			array_push($ActionArray, 'echo "FTP,"');
			array_push($ActionArray, ';;');
			array_push($ActionArray, 'esac');
			array_push($ActionArray, 'done');

			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getWebServer(){
			$filename = "getWebServer.sh";
			$ActionArray[] = "Sites=($(ls /etc/apache2/sites-available/))";
			array_push($ActionArray, 'for i in ${Sites[*]}; do');
			array_push($ActionArray, '	ServerName=$(cat /etc/apache2/sites-available/$i | grep "ServerName" | cut -d " " -f2 | tail -n1)');
			array_push($ActionArray, '	SitesEnable=$(ls /etc/apache2/sites-enabled/ | grep "$i")');
			array_push($ActionArray, '	if [[ $SitesEnable == "" && $ServerName == "" ]]; then');
			array_push($ActionArray, '		echo "$i|No identificado|No habilitado,"');
			array_push($ActionArray, '	else');
			array_push($ActionArray, '		echo "$i|$ServerName|Habilitado,"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, 'done');
			array_push($ActionArray, 'echo "="');
			array_push($ActionArray, "NumAccesos=$(cat /var/log/apache2/access.log | wc -l)");
			array_push($ActionArray, "ConHttp=$(lsof -i -nP | egrep '(CONNECTED|ESTAB)' | grep '80' | wc -l)");
			array_push($ActionArray, "ConHttps=$(lsof -i -nP | egrep '(CONNECTED|ESTAB)' | grep '443' | wc -l)");
			array_push($ActionArray, "TimeWaitHttp=$(lsof -i -nP | grep TIME_WAIT | grep '80' | wc -l)");
			array_push($ActionArray, "TimeWaitHttps=$(lsof -i -nP | grep TIME_WAIT | grep '443' | wc -l)");
			array_push($ActionArray, "APID=$(ps axo pid,cmd,user | grep apache2 | grep root | grep -v $0 | grep -v g | cut -d' ' -f2)");
			array_push($ActionArray, "DateInit=$(ls -od --time-style=+%d-%m-%y,%H-%M /proc/$APID | cut -d' ' -f5)");
			array_push($ActionArray, "CantRestart=$(cat /var/log/apache2/*.log | grep 'resuming normal operations' | wc -l)");
			array_push($ActionArray, 'echo "$NumAccesos,$ConHttp,$ConHttps,$TimeWaitHttp,$TimeWaitHttps,$DateInit,$CantRestart,"');

			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function getAccessWebServer(){
			$filename = "getAccessWebServer.sh";
			// $ActionArray[] = addslashes('p="/var/log/apache2/access.log"');
			$ActionArray[] = 'hs=(0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0)';
			// array_push($ActionArray, 'hs=(0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0)');
			array_push($ActionArray, "for h in $(cat /var/log/apache2/access.log | cut -d '[' -f2 | cut -d ']' -f1 | cut -d ' ' -f1 | cut -d ':' -f2 | sed 's/^0//'); do");
			array_push($ActionArray, '	(( hs[$h]++ ))');
			array_push($ActionArray, 'done');
			array_push($ActionArray, 'hora="0"');
			array_push($ActionArray, 'for h3 in ${hs[@]}; do');
			// array_push($ActionArray, '	if [[ $hora == "0" ]]; then');
			// array_push($ActionArray, '		echo "0"');
			// array_push($ActionArray, '	else');
			// array_push($ActionArray, '		echo "$hora"');
			// array_push($ActionArray, "	fi");
			// array_push($ActionArray, '	echo ":00,"');
			array_push($ActionArray, '	echo "$h3,"');
			array_push($ActionArray, "	(( hora++ ))");
			array_push($ActionArray, "done");

			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}

		public function PercentageCPU() {
			$CPUStatus = explode(",", $this->getCpuState());
			
			if (isset($CPUStatus[1]) && isset($CPUStatus[2]))
				return ($CPUStatus[1] + $CPUStatus[2]);

			return 0;
	    }

	    public function PercentageMemory() {
	    	$MemoryStatus = explode(",", $this->getMemoryState());
			
			if (isset($MemoryStatus[0]) && isset($MemoryStatus[1])) {
				$MemoryStatus[1] = ($MemoryStatus[1] * 100) / $MemoryStatus[0];

				if (is_float($MemoryStatus[1]))
					return number_format($MemoryStatus[1], 2, '.', '');
			}
			
			return 0;
		}
		
		public function ConvertUnit($InputValue) {
			if ($InputValue >= 1024) {
				$InputValue = ($InputValue / 1024);
				if(is_float($InputValue)) {
					$ValueFloat = number_format($InputValue, 2, '.', '');
					return $ValueFloat." GB";
				} else {
					return $InputValue." GB";
				}
			} else {
				$InputValue = $InputValue;
				return $InputValue." MB";
			}
		}
	
		// Método para calcular el uso de la CPU
		public function OperacionCPU($UsoUser, $UsoSystem, $Operacion) {
			$UsoTotal = $UsoUser + $UsoSystem;
			if ($Operacion == "uso") {
				return $UsoTotal;   
			} else if ($Operacion == "disponible") {
				$Disponible = 100 - $UsoTotal;
				return $Disponible;
			}
		}
	
		// Conversión: Uso de memoria de los procesos
		public function ConvertMemoryProc($MemoryProc) {
			if ($MemoryProc >= 1024) {
				$MemoryProc = ($MemoryProc / 1024);
				if(is_float($MemoryProc)) {
					$ValFloat = number_format($MemoryProc, 2, '.', '');
					return $ValFloat." MB";   
				} else {
					return $MemoryProc." MB";
				}
			} else {
				return $MemoryProc." KB";
			}
		}

		/*public function getDHCPServer(){
			$filename = "getDHCPServer.sh";
			$ActionArray[] = 'IntListen=($(cat /etc/default/isc-dhcp-server | grep INTERFACES | cut -d " -f2))';
			array_push($ActionArray, 'echo "${IntListen[*]},"');
			array_push($ActionArray, 'echo "="');
			array_push($ActionArray, 'Fichero="/var/lib/dhcp/dhcpd.leases"');
			array_push($ActionArray, "Leases=($(cat $Fichero | grep lease | sed '1,2d' | tr -d '{' | cut -d ' ' -f2))");
			array_push($ActionArray, 'if [[ ${Leases[*]} != "" ]]; then');
			array_push($ActionArray, '	for i in ${Leases[*]}; do');
			array_push($ActionArray, "		Mac=$(cat $Fichero | grep -A7 $i | grep ethernet | awk {'print $3'} | tr -d ';')");
			array_push($ActionArray, '		echo "$i,$Mac,"');
			array_push($ActionArray, "	done");
			array_push($ActionArray, 'fi');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			// return getErrors();
			return false;
		}*/

		/**
			* Método que verifica las credenciales de logueo de un usuario.
			*@param: $usr (Nombre de usuario), $pwd (Contraseña), $prefix (Prefijo de tabla), $privilege (Privilegio del usuario).
		*/
		public function UserLogin($usr, $pwd, $prefix, $privilege){
	    	$usr = $this->CleanString($usr);
	    	$pwd = trim($pwd);

	    	if (!get_magic_quotes_gpc())
				$usr = addslashes($usr);

			$Query = $this->db_connect->query("SELECT * FROM ".$prefix.$privilege." WHERE username='".$usr."';");
	    	
			while (@$Check = $Query->fetch_array(MYSQLI_ASSOC)){
				if (password_verify($pwd, $Check['password'])){
					return true;
				}
			}

	    	return false;
	    }

	    /**
			* Método que actualiza el nombre de usuario.
			*@param: $new_usr (Nuevo nombre de usuario), $usr (Nombre de usuario), $pwd (Contraseña), $prefix (Prefijo de tabla), $privilege (Privilegio del usuario).
		*/
	    public function UserUpdateUN($new_usr, $usr, $pwd, $prefix, $privilege){
	    	@session_start();

	    	$new_usr = $this->CleanString($new_usr);

	    	if ($this->UserLogin($usr, $pwd, $prefix, $privilege)){
	    		if ($this->db_connect->query("UPDATE ".$prefix.$privilege." SET username='".$new_usr."' WHERE username='".$usr."';")){
	    			@$_SESSION['username'] = $new_usr;
	    			return true;
	    		}
	    	}

	    	return false;
	    }

	    /**
			* Método que actualiza o agrega un nombre y apellido de un respectivo usuario.
			*@param: $usr (Nombre de usuario), $firstname (Nombre/s), $lastname (Apellido/s), $prefix (Prefijo de tabla), $privilege (Privilegio del usuario).
		*/
	    public function UserAddOrUpdateFirstAndLastName($usr, $firstname, $lastname, $prefix, $privilege){
	    	@session_start();

	    	$firstname 	= $this->CleanString($firstname);
	    	$lastname 	= $this->CleanString($lastname);

	    	if ($this->db_connect->query("UPDATE ".$prefix.$privilege." SET firstname='".$firstname."' AND lastname='".$lastname."' WHERE username='".$usr."';")){
	    		@$_SESSION['usr_firstname'] = $firstname;
	    		@$_SESSION['usr_lastname'] 	= $lastname;
	    		return true;
	    	}

	    	return false;
	    }

	    /**
			* Método que obtiene el nombre, puede ser primero o segundo.
			*@param: $usr (Nombre de usuario), $prefix (Prefijo de tabla), $privilege (Privilegio del usuario).
		*/
	    public function UserGetFirstname($usr, $prefix, $privilege){
	    	$Firstname = $this->db_connect->query("SELECT firstname FROM ".$prefix.$privilege." WHERE username='".$usr."';");

	    	if ($Firstname->num_rows > 0)
	    		return $Firstname->fetch_array(MYSQLI_ASSOC)['firstname'];

	    	return false;
	    }

	    /**
			* Método que obtiene el apellido, puede ser primero o segundo.
			*@param: $usr (Nombre de usuario), $prefix (Prefijo de tabla), $privilege (Privilegio del usuario).
		*/
	    public function UserGetLastname($usr, $prefix, $privilege){
	    	$Lastname = $this->db_connect->query("SELECT lastname FROM ".$prefix.$privilege." WHERE username='".$usr."';");

	    	if ($Lastname->num_rows > 0)
	    		return $Lastname->fetch_array(MYSQLI_ASSOC)['lastname'];

	    	return false;
	    }

		public function ConnectDB($H = null, $U = null, $P = null, $D = null, $X = null){
			@$FirstConnect = new mysqli($H, $U, $P);

			if (!$FirstConnect->connect_error)
				$FirstConnect->query("CREATE DATABASE ".$D.";");

			@$this->db_connect = new GNet($H, $U, $P, $D);
			$this->db_prefix = $X;

			@$FirstConnect->close();
		}

		public function getStringFormatSize($str){
	        if (strlen($str) >= 28)
	            $str = substr($str, 0, 25)."...";

	        echo $str;
		}

		public function CleanString($str) {
 			
 			#Se limpian los espacios de inicio y de fin.
		    $str = trim($str);
		 	
		 	#Reemplaza todas las apariciones del string buscado con el string de reemplazo.
		 	#str_replace: http://php.net/manual/es/function.str-replace.php
		    #--------------------------------------------------------------------------------

		    $str = str_replace(
		        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		        $str
		    );
		 	
		 	#--------------------------------------------------------------------------------

		    $str = str_replace(
		        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		        $str
		    );
		 
		    #--------------------------------------------------------------------------------

		    $str = str_replace(
		        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		        $str
		    );
		 
		    #--------------------------------------------------------------------------------

		    $str = str_replace(
		        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		        $str
		    );
		 
		    #--------------------------------------------------------------------------------

		    $str = str_replace(
		        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		        $str
		    );
		 
		    #--------------------------------------------------------------------------------

		    $str = str_replace(
		        array('ñ', 'Ñ', 'ç', 'Ç'),
		        array('n', 'N', 'c', 'C',),
		        $str
		    );

		    #--------------------------------------------------------------------------------
		 
		    #Se retorna el nuevo string.
		    return $str;
		}

	}
	// echo (new ConnectSSH("192.168.100.2", "network", "123"))->getDHCPShowAssignIP();

?>