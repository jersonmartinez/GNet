<?php
	class SideMasters extends mysqli {
		public function __construct($host, $user, $pass, $db){
			@parent::__construct($host, $user, $pass, $db);
		}
	}

	class ConnectSSH {
		public $ip_host;
		private $username;
		private $password;
		public $connect;
		private $stream;
		private $errors = array();
		private $local_path = "/var/www/html/NetworkAdmin/php/";
		private $remote_path;
		private $filename;

		public $db_connect;
		public $db_prefix;

		function __construct($ip_host, $username, $password){
			if (!function_exists("ssh2_connect")) {
        		array_push($this->errors, "La función ssh2_connect no existe");
			}

        	if(!($this->connect = @ssh2_connect($ip_host, 22))){
				$this->ip_host = $ip_host;
        		array_push($this->errors, "No hay conexión con al dirección IP: " . $ip_host);
		    } else {
		        if(!ssh2_auth_password($this->connect, $username, $password)) {
        			array_push($this->errors, "Autenticación invalida");
		        } else {
					$this->ip_host 		= $ip_host;
					$this->username 	= $username;
					$this->password 	= $password;
					$this->remote_path 	= "/home/".$username."/";
		        }
		    }
		}

		public function RunLines($RL){
			if(!($this->stream = ssh2_exec($this->connect, $RL)))
		        return "Falló: El comando no se ha podido ejecutar.";
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
			$scp = ssh2_scp_send($this->connect, $this->local_path.$filename, $this->remote_path.$filename, 0777);
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

		/*public function getMemoryState(){
			$filename = "getMemoryState.sh";
			$ActionArray[] = "MEMORIA=($(free -m | grep 'Mem' | cut -d ':' -f2))";
			array_push($ActionArray, 'echo "${MEMORIA[0]},${MEMORIA[1]},${MEMORIA[2]},${MEMORIA[3]},${MEMORIA[4]},${MEMORIA[5]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}*/

		/*public function getDiskUsage(){
			$filename = "getDiskUsage.sh";
			$ActionArray[] = "DISCO=($(df -PH | grep sda | cut -d '/' -f3))";
			array_push($ActionArray, 'echo "${DISCO[1]},${DISCO[2]},${DISCO[3]},${DISCO[4]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}*/

		/*public function getNetworkInterfaces(){
			$filename = "getNetworkInterfaces.sh";
			$ActionArray[] = "INTERFACES=($(ifconfig -a -s | awk {'print $1'}))";
			array_push($ActionArray, 'echo "="');
			array_push($ActionArray, 'NUM_INTER=${#INTERFACES[*]}');
			array_push($ActionArray, 'for (( i = 1; i < $NUM_INTER ; i++ )); do');
			array_push($ActionArray, '	DIRECCION_IP=$(ifconfig ${INTERFACES[$i]} | grep "inet " | cut -d " " -f10)');
			array_push($ActionArray, '	if [[ $DIRECCION_IP != "" ]]; then');
			array_push($ActionArray, '		echo "${INTERFACES[$i]},$DIRECCION_IP,"');
			array_push($ActionArray, "	else");
			array_push($ActionArray, '		echo "${INTERFACES[$i]},No tiene ip asignada"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, 'done');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}*/

		/*public function getOpenPorts(){
			$filename = "getOpenPorts.sh";
			$ActionArray[] = 'echo "="';
			array_push($ActionArray, "PORT_TCP=($(netstat -pltona | grep 'tcp ' | awk {'print $4 ,$1'} | cut -d ':' -f2))");
			array_push($ActionArray, "PORT_TCP6=($(netstat -pltona | grep 'tcp6' | awk {'print $4 ,$1'} | cut -d ':' -f4))");
			array_push($ActionArray, 'echo "${PORT_TCP[*]} ${PORT_TCP6[*]},"');
			array_push($ActionArray, "PORT_UDP=($(netstat -pluona | grep 'udp ' | awk {'print $4 ,$1'} | cut -d ':' -f2))");
			array_push($ActionArray, "PORT_UDP6=($(netstat -pluona | grep 'udp ' | awk {'print $4 ,$1'} | cut -d ':' -f4))");
			array_push($ActionArray, 'echo "${PORT_UDP[*]} ${PORT_UDP6[*]}"');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}*/

		/*public function getNetworkConnections(){
			$filename = "getNetworkConnections.sh";
			$ActionArray[] = 'echo "="';
			array_push($ActionArray, "PROTO=$(netstat -putona | grep -e tcp -e udp | awk {'print $1'})");
			array_push($ActionArray, "DIR_LOCAL=$(netstat -putona | grep -e tcp -e udp | awk {'print $4'})");
			array_push($ActionArray, "DIR_REMOTA=$(netstat -putona | grep -e tcp -e udp | awk {'print $5'})");
			array_push($ActionArray, "ESTADO=$(netstat -putona | grep -e tcp -e udp | awk {'print $6'})");
			array_push($ActionArray, "TEMP1=$(netstat -putona | grep -e tcp -e udp | awk {'print $7'})");
			array_push($ActionArray, 'echo "${PROTO[*]} | "');
			array_push($ActionArray, 'echo "${DIR_LOCAL[*]} | "');
			array_push($ActionArray, 'echo "${DIR_REMOTA[*]} | "');
			array_push($ActionArray, 'echo "${ESTADO[*]} | "');
			array_push($ActionArray, 'echo "${TEMP1[*]} | "');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}*/

		/*public function getUsersConnected(){
			$filename = "getUsersConnected.sh";
			$ActionArray[] = "USUARIOS=($(who | cut -d ' ' -f1))";
			array_push($ActionArray, 'for i in ${USUARIOS[*]}; do');
			array_push($ActionArray, '	echo "$i ,"');
			array_push($ActionArray, 'done');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}*/

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
			return getErrors();
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
			return getErrors();
		}

		public function getHTTPVirtualHost(){
			$filename = "getHTTPVirtualHost.sh";
			$ActionArray[] = "SITIOS=$(ls /etc/apache2/sites-available/)";
			array_push($ActionArray, 'for i in ${SITIOS[*]}; do');
			array_push($ActionArray, '	NAME_SERVER=$(cat /etc/apache2/sites-available/$i | grep "ServerName" | cut -d " " -f2 | tail -n1)');
			array_push($ActionArray, '	SITE_ENABLE=$(ls /etc/apache2/sites-enabled/ | grep $i)');
			array_push($ActionArray, '	if [[ $SITE_ENABLE == "" && $NAME_SERVER == "" ]]; then');
			array_push($ActionArray, '		echo "$i,No identificado,No habilitado"');
			array_push($ActionArray, '	else');
			array_push($ActionArray, '		echo "$i,$NAME_SERVER,Habilitado"');
			array_push($ActionArray, '	fi');
			array_push($ActionArray, 'done');
			array_push($ActionArray, 'echo "="');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
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
		
		public function getErrors(){
			return implode("<br/>", $this->errors);
		}

		public function testing(){
			return "Okay";
		}

		public function getIPLocalCurrent(){
			return shell_exec("ip route show default | awk '/default/ {print $3}'");
		}

		public function getMyIPServer(){
			return shell_exec("ip -4 route get 8.8.8.8 | awk {'print $7'} | tr -d '\n'");
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
					$this->remote_path 	= "/home/".$username."/";
		        }
		    }

		    return true;
		}

		public function addNetwork($ip_net, $checked = "0"){
			if ($this->db_connect->query("INSERT INTO ".$this->db_prefix."network (ip_net, checked) VALUES ('".$ip_net."','".$checked."');"))
				return true;

			return false;
		}

		public function updateNetwork($ip_net, $checked){
			if ($this->db_connect->query("UPDATE ".$this->db_prefix."network SET checked='".$checked."' WHERE ip_net='".$ip_net."';"))
				return true;

			return false;
		}

		public function addHost($ip_net, $ip_host, $router, $net_next){
			$query = "INSERT INTO ".$this->db_prefix."host (ip_net, ip_host, router, net_next) VALUES ('".$ip_net."', '".$ip_host."', '".$router."', '".$net_next."');";
			
			if ($this->db_connect->query($query))
				return true;

			return false;
		}

		public function getHostTypeRouterLast(){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE router='1' AND net_next!='-' ORDER BY ip_net DESC LIMIT 1;");
		}

		public function getHostNetwork($network){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE ip_net='".$network."';");
		}

		public function getHostTypeRouter(){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE router='1' AND net_next!='-';");
		}

		public function getHostTypeSwitch($IPNet){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE ip_net='".$IPNet."' AND router='0';");
		}

		public function getHostTypeHost(){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host WHERE router='0';");
		}

		public function getAllHost(){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."host;");
		}

		public function getIPNetNext($ip_net){
			return $this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."network WHERE ip_net>'".$ip_net."' ORDER BY ip_net DESC LIMIT 1;")->fetch_array(MYSQLI_ASSOC)['ip_net'];
		}

		//Extrae todas las direcciones de red.
		public function getIPNet(){
			return @$this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."network;");
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

		public function IsRouter($IPHost, $user = "network", $pass = "123"){
			$this->FinalConnect($IPHost, $user, $pass);

			$RL[] = "cat /proc/sys/net/ipv4/ip_forward";
			
			//Se obtiene valores booleanos (0, 1 = enrutador)
			$ip_forward = (int)trim($this->RunLines(implode("\n", $RL)));

			return $ip_forward;
		}

		public function getIpRouteLocal(){
			return trim(explode("\n", trim(shell_exec($this->CommandIpRoute)))[0]);
		}

		public function getIpRouteRemote($IPHost, $user = "network", $pass = "123"){
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

		public function getAllNetworkChecked(){
			return @$this->db_connect->query("SELECT DISTINCT * FROM ".$this->db_prefix."network WHERE checked='0' LIMIT 1;");
		}

		public function SpaceTest(){
			$this->InitTables();

			do {
				if (@!$this->getCountNetwork())
					@$this->addNetwork($this->getIpRouteLocal());

				if ($this->getAllNetworkChecked()->num_rows > 0){
					$Network = $this->getAllNetworkChecked()->fetch_array(MYSQLI_ASSOC)['ip_net'];
					$D = $this->SondearRed($Network);
					unset($D[count($D) - 1]);

					foreach ($D as $value) {
						$ip_forward = @$this->IsRouter($value);
						$ArrayNets = @explode("\n", $this->getIpRouteRemote($value));
						
						$NextNet = $ArrayNets[0];
						$NextNet = "-";

						if ($ip_forward){
							$NextNet = $ArrayNets[1];
							if (trim($Network) == trim($NextNet)){
								$NextNet = "-";
							} else {
								$this->addNetwork($NextNet);
							}
						}

						$this->addHost($Network, $value, $ip_forward, $NextNet);
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
				$this->FinalConnect($IPHost, "network", "123");
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

		public function SondearRed($IPNet){
			return explode("\n", shell_exec("nmap ".$IPNet." -n -sP | grep report | awk '{print $5}'"));
		}

		public function RastreoTotal($IPNet){
			return explode("\n", shell_exec("nmap ".$IPNet." -n -sP"));
		}

		public function SrMartinez(){
			return explode("\n", shell_exec("nmap 192.168.100.0/24 -n -sP | grep report | awk '{print $5}'"));
		}

		public function Tracking(){

			$IPLocal = $this->IPRouteShow("localhost");

			$i = 0;
			do {
				$CountNet = $this->getIPNet()->num_rows;
				
				if ($CountNet == 0){
					$Info = $this->SondearRed($IPLocal);

					//Para saber si es enrutador
					$RL[] = "cat /proc/sys/net/ipv4/ip_forward";

					//Para obtener las otras rutas de red
					$RA[] = "ip route | sed '/default/ d' | cut -d ' ' -f1";

					for ($j = 0; $j < sizeof($Info)-1; $j++){
						//Se agregan en un array los dispositivos sondeados
						$ArrayHosts[$i][$j] = trim($Info[$j]);

						//Se aplica una conexion SSH al host
						$this->FinalConnect($ArrayHosts[$i][$j], "network", "123");

						//Se obtiene valores booleanos (0, 1 = enrutador)
						$ip_forward = $this->RunLines(implode("\n", $RL));

						//Se verifica si es enrutador
						if ($ip_forward > 0){
							//Si es enrutador, se le pregunta por las nuevas rutas de red
							$AddrIPNext = $this->IPRouteShow($ArrayHosts[$i][$j]);
							//Si viene un resultado vacio, entonces no hay red siguiente
							$AddrIPNext = empty($AddrIPNext) ? "-" : $AddrIPNext;

							//Si hay red siguiente, entonces se agrega la siguiente red a la tabla de redes
							if ($AddrIPNext != "-"){
								$this->addNetwork($AddrIPNext);
								//Si hay siguiente, este deberia pasar a la otra vuelta del ciclo
								$Feliz = 1;
							}
							
						} else {
							//No es enrutador
							$AddrIPNext = "-";
						}
						echo "<br/>Direccion de Red: ".$IPLocal[$i].", Host: ".$ArrayHosts[$i][$j].", Router: ".$ip_forward.", Siguiente: ".$AddrIPNext."<br/>";
						$this->addHost($IPLocal[$i], $ArrayHosts[$i][$j], $ip_forward, $AddrIPNext); 
					}

				}
				exit();
				
				//Se obtiene la red actual
				$ArrayNetwork = trim($IPLocal);

				
				//Se verifica si hay red
				if ($CountNet == 0){
					echo "<br/>Red inicial: ".$ArrayNetwork."<br/>";
					//Si no hay, se agrega la actual y primera direccion de red
					$this->addNetwork($ArrayNetwork);

					//Obtengo la primer direccion de red de la base de datos
					$AddNet = $this->getIPNetOnly();

					//Se sondea la primera direccion de red
					$Info = explode("\n", shell_exec("nmap ".$AddNet." -n -sP | grep report | awk '{print $5}'"));
					
					//Para saber si es enrutador
					$RL[] = "cat /proc/sys/net/ipv4/ip_forward";

					//Para obtener las otras rutas de red
					$RA[] = "ip route | sed '/default/ d' | cut -d ' ' -f1";
					
					//Se recorren los dispositivos sondeados
					for ($j = 0; $j < sizeof($Info)-1; $j++){
						//Se agregan en un array los dispositivos sondeados
						$ArrayHosts[$i][$j] = trim($Info[$j]);

						//Se aplica una conexion SSH al host
						$this->FinalConnect($ArrayHosts[$i][$j], "network", "123");

						//Se obtiene valores booleanos (0, 1 = enrutador)
						$ip_forward = $this->RunLines(implode("\n", $RL));

						//Se verifica si es enrutador
						if ($ip_forward > 0){
							//Si es enrutador, se le pregunta por las nuevas rutas de red
							$AddrIPNext = trim(explode("\n", $this->RunLines(implode("\n", $RA)))[1]);
							//Si viene un resultado vacio, entonces no hay red siguiente
							$AddrIPNext = empty($AddrIPNext) ? "-" : $AddrIPNext;

							//Si hay red siguiente, entonces se agrega la siguiente red a la tabla de redes
							if ($AddrIPNext != "-"){
								$this->addNetwork($AddrIPNext);
								//Si hay siguiente, este deberia pasar a la otra vuelta del ciclo
								$Feliz = 1;
							}
							
						} else {
							//No es enrutador
							$AddrIPNext = "-";
						}
						echo "<br/>Direccion de Red: ".$ArrayNetwork[$i].", Host: ".$ArrayHosts[$i][$j].", Router: ".$ip_forward.", Siguiente: ".$AddrIPNext."<br/>";
						$this->addHost($ArrayNetwork[$i], $ArrayHosts[$i][$j], $ip_forward, $AddrIPNext); 
					}


				} else if ($CountNet == 1) {
					// Si hay una red

					echo "Finalizando";

				} else if ($CountNet > 1 && !empty($this->getIPNetNext($ArrayNetwork[$i]))){
					//Se extrae la siguiente direccion IP
					$ArrayNetworkNext = $this->getIPNetNext($ArrayNetwork[$i]);

					echo "<br/>Test: ".$ArrayNetworkNext."<br/>";
					//Si no hay, se agrega la actual y primera direccion de red
					// $this->addNetwork($ArrayNetwork[$i]);

					//Obtengo la primer direccion de red de la base de datos
					// $AddNet = $this->getIPNetOnly();

					//Se sondea la primera direccion de red
					$Info = explode("\n", shell_exec("nmap ".$ArrayNetworkNext." -n -sP | grep report | awk '{print $5}'"));
					
					//Para saber si es enrutador
					$RL[] = "cat /proc/sys/net/ipv4/ip_forward";

					//Para obtener las otras rutas de red
					$RA[] = "ip route | sed '/default/ d' | cut -d ' ' -f1";
					
					//Se recorren los dispositivos sondeados
					for ($j = 0; $j < sizeof($Info)-1; $j++){
						//Se agregan en un array los dispositivos sondeados
						$ArrayHosts[$i][$j] = trim($Info[$j]);

						//Se aplica una conexion SSH al host
						echo "Lo hace: ".$ArrayHosts[$i][$j]."<br/><br/>";

						$this->FinalConnect($ArrayHosts[$i][$j], "network", "123");

						//Se obtiene valores booleanos (0, 1 = enrutador)
						$ip_forward = $this->RunLines(implode("\n", $RL));

						//Se verifica si es enrutador
						if ($ip_forward > 0){
							//Si es enrutador, se le pregunta por las nuevas rutas de red
							$AddrIPNext = trim(explode("\n", $this->RunLines(implode("\n", $RA)))[1+$i]);
							//Si viene un resultado vacio, entonces no hay red siguiente
							$AddrIPNext = empty($AddrIPNext) ? "-" : $AddrIPNext;

							//Si hay red siguiente, entonces se agrega la siguiente red a la tabla de redes
							if ($AddrIPNext != "-"){
								$this->addNetwork($AddrIPNext);
								//Si hay siguiente, este deberia pasar a la otra vuelta del ciclo
								echo "Ya hay uno siguiente<br/>";
								$Feliz = 1;
							} else {
								$Feliz = 0;
							}
							
						} else {
							//No es enrutador
							$AddrIPNext = "-";
						}

						echo "<br/>Direccion de Red: ".$ArrayNetworkNext.", Host: ".$ArrayHosts[$i][$j].", Router: ".$ip_forward.", Siguiente: ".$AddrIPNext."<br/>";
						
						$this->addHost($ArrayNetworkNext, $ArrayHosts[$i][$j], $ip_forward, $AddrIPNext); 
					}

					$Feliz = 0;
				}

				// $Feliz = $this->getIPNetNext($ArrayNetwork[$i])->num_rows;
				$i++;
			} while ($Feliz != 0);

			return array ($ArrayHosts, $ArrayNetwork);
		}

		public function getMemoryState(){
			$filename = "getMemoryState.sh";
			$ActionArray[] = "MEMORIA=($(free -m | grep 'Mem' | cut -d ':' -f2))";
			array_push($ActionArray, 'echo "${MEMORIA[0]},${MEMORIA[1]},${MEMORIA[2]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getSwapState(){
			$filename = "getSwapState.sh";
			$ActionArray[] = "SWAP=($(free -m | egrep '(Intercambio|Swap)' | cut -d ':' -f2))";
			array_push($ActionArray, 'echo "${SWAP[0]},${SWAP[1]},${SWAP[2]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getCpuState(){
			$filename = "getcpuState.sh";
			$ActionArray[] = "NameModel=($(cat /proc/cpuinfo | grep name | cut -d ':' -f2))";
			array_push($ActionArray, "Velocidad=$(cat /proc/cpuinfo | grep name | cut -d ' ' -f 10)");
			array_push($ActionArray, "UsoUser=$(top -n1 -b | grep '%Cpu' | cut -d ' ' -f2 | sed 's/,/./g')");
			array_push($ActionArray, "UsoSystem=$(top -n1 -b | grep '%Cpu' | cut -d ' ' -f5 | sed 's/,/./g')");
			array_push($ActionArray, 'UsoTotal=$(echo "$UsoUser + $UsoSystem" | bc)');
			array_push($ActionArray, 'Disponible=$(echo "100 - $UsoTotal" | bc)');
			array_push($ActionArray, "TotalProc=$(ps ax | wc -l)");
			array_push($ActionArray, 'echo "${NameModel[*]},$Velocidad,$UsoUser,$UsoSystem,$UsoTotal,$Disponible,$TotalProc,"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getDiskState(){
			$filename = "getDiskState.sh";
			$ActionArray[] = 'Disk=($(df -H /dev/sda1 | sed "1d" | tr -d "G"))';
			array_push($ActionArray, 'echo "${Disk[2]},${Disk[3]},${Disk[4]},${Disk[5]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getProcState(){
			$filename = "getProcState.sh";
			$ActionArray[] = "Proc=($(ps axo pid,cmd | sed '1d' | awk '{print $1 ,$2}'))";
			// array_push($ActionArray, 'for p in ${PID[*]}; do');
			// array_push($ActionArray, 'echo "$p,"');
			// array_push($ActionArray, 'done');
			array_push($ActionArray, 'echo "${Proc[*]},"');
			// array_push($ActionArray, '|');
			// array_push($ActionArray, "CMD=($(ps axo cmd | sed '1d' | cut -d ' ' -f1))");
			// array_push($ActionArray, 'for c in ${CMD[*]}; do');
			// array_push($ActionArray, 'echo "$c"');
			// array_push($ActionArray, "done");
			// array_push($ActionArray, 'echo "${CMD[*]}"');	
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getNetAddress(){
			$filename = "getNetAddress.sh";
			$ActionArray[] = 'Interfaces=($(ip addr show | egrep "[1-9]: " | cut -d ":" -f2 | tr -d " "))';
			array_push($ActionArray, 'for i in ${Interfaces[*]}; do');
			array_push($ActionArray, 'DirIP=$(ip addr show $i | grep -w inet | cut -d " " -f6 | cut -d "/" -f1)');
			array_push($ActionArray, 'if [[ $DirIP != "" ]]; then');
			array_push($ActionArray, 'echo "$i,$DirIP,"');
			array_push($ActionArray, 'else');
			array_push($ActionArray, 'echo "$i,No tiene IP asignada,"');
			array_push($ActionArray, 'fi');
			array_push($ActionArray, 'done');	
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getPortsListen(){
			$filename = "getPortsListen.sh";
			$ActionArray[] = "Ports=($(lsof -i -nP | sed '1d' | grep -v ESTAB | awk {'print $9 ,$8 ,$5 ,$1'} | cut -d ':' -f2 | uniq))";
			array_push($ActionArray, 'echo "${Ports[*]},"');
			/*array_push($ActionArray, "Service=$(lsof -i -nP | sed '1d' | awk {'print $1'})");
			array_push($ActionArray, 'echo "${Protocol[*]} | "');
			array_push($ActionArray, 'echo "${Type[*]} | "');
			array_push($ActionArray, 'echo "${Ports[*]} | "');
			array_push($ActionArray, 'echo "${Service[*]} | "');*/
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}	

		public function getBatteryState(){
			$filename = "getBatteryState.sh";
			$ActionArray[] = 'Porcentaje=$(upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep percentage | cut -d ":" -f2 | tr -d "%")';
			array_push($ActionArray, 'StatusBat=$(upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep state | cut -d ":" -f2)');
			array_push($ActionArray, 'echo "$Porcentaje,$StatusBat,"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
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
			return getErrors();
		}

		public function getUsersConnected(){
			$filename = "getUsersConnected.sh";
			$ActionArray[] = "Users=($(w | sed '1,2d' | awk {'print $1 ,$4'}))";
			array_push($ActionArray, 'echo "${Users[*]},"');
			/*array_push($ActionArray, 'for i in ${Users[*]}; do');
			array_push($ActionArray, 'echo "$i,"');
			array_push($ActionArray, "done");*/
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function ConnectDB($H, $U, $P, $D, $X){
			$this->db_connect = new GNet($H, $U, $P, $D);
			$this->db_prefix = $X;
		}

	}
	// echo (new ConnectSSH("192.168.100.2", "network", "123"))->getDHCPShowAssignIP();
?>