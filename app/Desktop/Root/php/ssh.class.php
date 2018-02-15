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

		public function getMemoryState(){
			$filename = "getMemoryState.sh";
			$ActionArray[] = "MEMORIA=($(free -m | grep 'Mem' | cut -d ':' -f2))";
			array_push($ActionArray, 'echo "${MEMORIA[0]},${MEMORIA[1]},${MEMORIA[2]},${MEMORIA[3]},${MEMORIA[4]},${MEMORIA[5]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getDiskUsage(){
			$filename = "getDiskUsage.sh";
			$ActionArray[] = "DISCO=($(df -PH | grep sda | cut -d '/' -f3))";
			array_push($ActionArray, 'echo "${DISCO[1]},${DISCO[2]},${DISCO[3]},${DISCO[4]},"');
			
			$RL[] = $this->remote_path.$filename;
			array_push($RL, "rm -rf ".$this->remote_path.$filename);
			if ($this->writeFile($ActionArray, $filename) && $this->sendFile($filename))
				return $this->RunLines(implode("\n", $RL));
			return getErrors();
		}

		public function getNetworkInterfaces(){
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
		}

		public function getOpenPorts(){
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
		}

		public function getNetworkConnections(){
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
		}

		public function getUsersConnected(){
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
			if ($this->ConnectDB()->query("INSERT INTO network (ip_net, checked) VALUES ('".$ip_net."','".$checked."');"))
				return true;

			return false;
		}

		public function updateNetwork($ip_net, $checked){
			if ($this->ConnectDB()->query("UPDATE network SET checked='".$checked."' WHERE ip_net='".$ip_net."';"))
				return true;

			return false;
		}

		public function addHost($ip_net, $ip_host, $router, $net_next){
			$query = "INSERT INTO host (ip_net, ip_host, router, net_next) VALUES ('".$ip_net."', '".$ip_host."', '".$router."', '".$net_next."');";
			
			if ($this->ConnectDB()->query($query))
				return true;

			return false;
		}

		public function getHostTypeRouterLast(){
			return $this->ConnectDB()->query("SELECT DISTINCT * FROM host WHERE router='1' AND net_next!='-' ORDER BY ip_net DESC LIMIT 1;");
		}

		public function getHostNetwork($network){
			return $this->ConnectDB()->query("SELECT DISTINCT * FROM host WHERE ip_net='".$network."';");
		}

		public function getHostTypeRouter(){
			return $this->ConnectDB()->query("SELECT DISTINCT * FROM host WHERE router='1' AND net_next!='-';");
		}

		public function getHostTypeSwitch($IPNet){
			return $this->ConnectDB()->query("SELECT DISTINCT * FROM host WHERE ip_net='".$IPNet."' AND router='0';");
		}

		public function getHostTypeHost(){
			return $this->ConnectDB()->query("SELECT DISTINCT * FROM host WHERE router='0';");
		}

		public function getAllHost(){
			return $this->ConnectDB()->query("SELECT DISTINCT * FROM host;");
		}

		public function getIPNetNext($ip_net){
			return $this->ConnectDB()->query("SELECT DISTINCT * FROM network WHERE ip_net>'".$ip_net."' ORDER BY ip_net DESC LIMIT 1;")->fetch_array(MYSQLI_ASSOC)['ip_net'];
		}

		//Extrae todas las direcciones de red.
		public function getIPNet(){
			return @$this->ConnectDB()->query("SELECT DISTINCT * FROM network;");
		}

		public function getIPNetLast(){
			return @$this->ConnectDB()->query("SELECT DISTINCT * FROM network ORDER BY ip_net DESC LIMIT 1;");
		}

		public function getIPNetOnly(){
			return @$this->ConnectDB()->query("SELECT DISTINCT * FROM network LIMIT 1;")->fetch_array(MYSQLI_ASSOC)['ip_net'];
		}

		public $CommandIpRoute = "ip route | sed -e '/src/ !d' | sed '/default/ d' | cut -d ' ' -f1";

		//Limpieza de tablas
		public function InitTables(){
			$this->ConnectDB()->query("TRUNCATE network;");
			$this->ConnectDB()->query("TRUNCATE host;");
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
			return @(int)$this->ConnectDB()->query("SELECT DISTINCT count(*) AS 'count' FROM network;")->fetch_array()['count'];
		}

		public function getCountNetworkChecked(){
			return @(int)$this->ConnectDB()->query("SELECT DISTINCT count(*) AS 'count' FROM network WHERE checked='0';")->fetch_array()['count'];
		}

		public function getAllNetworkChecked(){
			return @$this->ConnectDB()->query("SELECT DISTINCT * FROM network WHERE checked='0' LIMIT 1;");
		}

		public function SpaceTest(){
			//Limpieza de tablas
			// echo "Aplicando limpieza...";
			$this->InitTables();
			// echo "<br/>";

			do {
				//Si esta vacia la tabla network
				if (@!$this->getCountNetwork()){
					//Se agrega la red por omision
					if (@$this->addNetwork($this->getIpRouteLocal())){
						// echo "No hay datos (accion) => Se ha agregado el primer dato de red: ".$this->getIpRouteLocal();
					} else {
						// echo "No hay datos (accion) => No ha podido agregar la primera direccion de red: ".$this->getIpRouteLocal();
					}
				} else {
					// echo "<br/>Hay datos";
				}
				// echo "<br/><br/>";

				// echo "Valor de Checked: ".$this->getCountNetworkChecked()."<br/>";

				if ($this->getAllNetworkChecked()->num_rows > 0){
					$Network = $this->getAllNetworkChecked()->fetch_array(MYSQLI_ASSOC)['ip_net'];

					//Escribir la red que no ha sido sondeada.
					// echo "<br/>Red escrita en la DB: ".$Network." no sondeada.<br/>";

					//Se sondea la red
					$D = $this->SondearRed($Network);

					//Eliminando el ultimo dato \n
					unset($D[count($D) - 1]);

					// echo "Valores sondeados: ";
					foreach ($D as $value) {
						$ip_forward = @$this->IsRouter($value);
						$ArrayNets = @explode("\n", $this->getIpRouteRemote($value));
						
						//Se;alando patrones para extraer el siguiente.
						$NextNet = $ArrayNets[0];
						$NextNet = "-";

						if ($ip_forward){
							$NextNet = $ArrayNets[1];
							if (trim($Network) == trim($NextNet)){
								$NextNet = "-";
							} else {
								if ($this->addNetwork($NextNet)){
									// echo "<br/>IP Network: ".$NextNet." ha sido agregada<br/>";
								}
							}
						}

						if ($this->addHost($Network, $value, $ip_forward, $NextNet)){
		    				// echo "<br/>IP Red: ".$Network." | IP Host: ".$value." | Router: ".$ip_forward." | Proxima red: ".$NextNet."<br/>";
						}
		    		}


		    		// echo "<br/>";

					//Actualizar checked (sondeado)
					if ($this->updateNetwork($Network, 1)){
						// echo "Sondeado<br/>";
					} else {
						// echo "No se ha podido actualzar el dato<br/>";
					}
					

				}


			} while ($this->getCountNetworkChecked());

			// if ($this->getCountNetworkChecked()){
			// 	echo "Si hay datos con checked 1";
			// } else {
			// 	echo "nel, no hay checked 1, solo 0";
			// }

			// echo "<br/>";
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

		public function ConnectDB(){
			return new SideMasters("127.0.0.1", "root", "root", "monitorizador");
		}

	}
	// echo (new ConnectSSH("192.168.100.2", "network", "123"))->getDHCPShowAssignIP();
?>