<input type="hidden" id="title_sm" value="" />
<input type="hidden" id="content_sm" value="" />

<?php
  //include ("ic.test.php");

  #Agregando ventana modal, configuración de la red.
  include (PD_DESKTOP_ROOT."/graphic/ic.modal.config_network.php");
  include (PD_DESKTOP_ROOT."/graphic/gn.modal.AddDevicesManagement.php");
?>

<div class="container_platform">

    <?php
        $ip = "192.168.100.3";
        $v = exec("ping -q -c1 ".$ip." >/dev/null 2>&1 ; echo $?");

        if ($v == 0) {
            echo "La conexión está correcta";
        } else if ($v == 1){
            echo "No hay conexión";
        } else if ($v == 2){
            echo "No hay conexion a internet, sin resolver el DNS";
        }

        // $wait = 1; // wait Timeout In Seconds
        // $host = '192.168.102.2';
        // $ports = [
        //     'http'  => 80,
        //     'https' => 443,
        //     'ftp'   => 21,
        //     'ssh'   => 22,
        // ];

        // foreach ($ports as $key => $port) {
        //     $fp = @fsockopen($host, $port, $errCode, $errStr, $wait);
        //     echo "Ping $host:$port ($key) ==> ";
        //     if ($fp) {
        //         echo 'SUCCESS';
        //         fclose($fp);
        //     } else {
        //         echo "ERROR: $errCode - $errStr";
        //     }
        //     echo PHP_EOL;
        // }

        // function ping($host, $timeout = 1) {
        //     /* ICMP ping packet with a pre-calculated checksum */
        //     $package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
        //     $socket  = socket_create(AF_INET, SOCK_RAW, 1);
        //     socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
        //     socket_connect($socket, $host, null);
        //     $ts = microtime(true);
        //     socket_send($socket, $package, strLen($package), 0);
        //     if (socket_read($socket, 255)) {        
        //         $result = microtime(true) - $ts;
        //     } else {
        //         $result = false;
        //     }
        //     socket_close($socket);
        //     return $result;
        // }

        // class ping {
        //     // ICMP ping packet with a pre-calculated checksum
        //     protected static $payload = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
        //     /**
        //      * Send a ping request to a host.
        //      *
        //      * @param   string  $host       Host name or IP address to ping
        //      * @param   int     $timeout    Timeout for ping in seconds
        //      * @return  bool                True if ping succeeds, false if not
        //      */
        //     public static function send($host, $timeout = 1) {
        //         if (extension_loaded('sockets')) {
        //             return self::socketSend($host, $timeout);
        //         } else {
        //             return self::execSend($host);
        //         }
        //     }
        //     *
        //      * Use sockets to ping a host.
        //      *
        //      * Will call function to use exec to send ping request if the socket request fails.
        //      * Socket request will fail if it is unable to find the host.
        //      *
        //      * Using sockets under Windows requires that the Application Pool in IIS be running under an account with local admin rights.
        //      *
        //      * @param   string  $host       Host name or IP address to ping
        //      * @param   int     $timeout    Timeout for ping in seconds
        //      * @return  bool                True if ping succeeds, false if not
             
        //     protected static function socketSend($host, $timeout) {
        //         try {
        //             $socket = socket_create(AF_INET, SOCK_RAW, 1);
        //             socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
        //             socket_connect($socket, $host, null);
        //             socket_send($socket, self::$payload, strLen(self::$payload), 0);
        //             $result = socket_read($socket, 255) ? true : false;
        //             socket_close($socket);
        //             return $result;
        //         } catch (Exception $e) {
        //             return self::execSend($host);
        //         }
        //     }
        //     /**
        //      * Use exec to ping a host.
        //      *
        //      * Ping command is specific to Windows host.
        //      *
        //      * @param   string  $host   Host name or IP address to ping
        //      * @return  bool            True if ping succeeds, false if not
        //      */
        //     protected static function execSend($host) {
        //         $command = escapeshellcmd('ping -n 1 -w 1 ' . $host);
        //         exec($command, $result, $returnCode);
                
        //         return arr::search($result, 'received = 1') ? true : false;
        //     }

        //     public function getPing(){
        //         return self::send("192.168.100.3");
        //     }
        // }

        // if ((new ping())->getPing()){
        //     echo "Si hay conexion";
        // } else {
        //     echo "No hay nada de nada";
        // }

        // if (ping("192.168.1.1") != false){
        //     echo "Hay";
        // } else {
        //     echo "No hay";
        // }


        // if (!extension_loaded('sockets')) {
        //     die('The sockets extension is not loaded.');
        // }

        // $socket = socket_create(AF_UNIX, SOCK_DGRAM, 0);
        // if (!$socket)
        //     die('Unable to create AF_UNIX socket');


        // $addr = my_ip();
          // echo "my ip address is $addr\n";

          // function my_ip($dest='192.168.102.29', $port=80){
          //   $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
          //   socket_connect($socket, $dest, $port);
          //   socket_getsockname($socket, $addr, $port);
          //   socket_close($socket);
          //   return $addr;
          // }

        // function ping($host, $timeout = 1) {
        //     /* ICMP ping packet with a pre-calculated checksum */
        //     $package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
        //     $socket  = socket_create(AF_INET, SOCK_RAW, 1);
        //     socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
        //     socket_connect($socket, $host, null);

        //     $ts = microtime(true);
        //     socket_send($socket, $package, strlen($package), 0);
        //     if (socket_read($socket, 255))
        //         $result = microtime(true) - $ts;
        //     else    
        //         $result = false;
            
        //     socket_close($socket);

        //     return $result;
        // }

        // if (ping("192.168.102.2") == false){
        //     echo "No hay conexion";
        // } else {
        //     echo "Si haaaaay";
        // }

        // $g_icmp_error = "No Error";

        // timeout in ms
        // function ping($host, $timeout){
        //     $port = 0;
        //     $datasize = 64;
        //     global $g_icmp_error;
        //     $g_icmp_error = "No Error";
        //     $ident = array(ord('J'), ord('C'));
        //     $seq   = array(rand(0, 255), rand(0, 255));

        //     $packet = '';
        //     $packet .= chr(8); // type = 8 : request
        //     $packet .= chr(0); // code = 0

        //     $packet .= chr(0); // checksum init
        //     $packet .= chr(0); // checksum init

        //     $packet .= chr($ident[0]); // identifier
        //     $packet .= chr($ident[1]); // identifier

        //     $packet .= chr($seq[0]); // seq
        //     $packet .= chr($seq[1]); // seq

        //     for ($i = 0; $i < $datasize; $i++)
        //             $packet .= chr(0);

        //     $chk = icmpChecksum($packet);

        //     $packet[2] = $chk[0]; // checksum init
        //     $packet[3] = $chk[1]; // checksum init

        //     $sock = socket_create(AF_INET, SOCK_RAW,  getprotobyname('icmp'));
        //     $time_start = microtime();
        //     socket_sendto($sock, $packet, strlen($packet), 0, $host, $port);
       

        //     $read   = array($sock);
        //     $write  = NULL;
        //     $except = NULL;

        //     $select = socket_select($read, $write, $except, 0, $timeout * 1000);
        //     if ($select === NULL){
        //         $g_icmp_error = "Select Error";
        //         socket_close($sock);
        //         return -1;
        //     }
        //     else if ($select === 0){
        //         $g_icmp_error = "Timeout";
        //         socket_close($sock);
        //         return -1;
        //     }

        //     $recv = '';
        //     $time_stop = microtime();
        //     socket_recvfrom($sock, $recv, 65535, 0, $host, $port);
        //     $recv = unpack('C*', $recv);
           
        //     if ($recv[10] !== 1){
        //         $g_icmp_error = "Not ICMP packet";
        //         socket_close($sock);
        //         return -1;
        //     }

        //     if ($recv[21] !== 0){
        //         $g_icmp_error = "Not ICMP response";
        //         socket_close($sock);
        //         return -1;
        //     }

        //     if ($ident[0] !== $recv[25] || $ident[1] !== $recv[{
        //         $g_icmp_error = "Bad identification number";
        //         socket_close($sock);
        //         return -1;
        //     }
           
        //     if ($seq[0] !== $recv[27] || $seq[1] !== $recv[28]){
        //         $g_icmp_error = "Bad sequence number";
        //         socket_close($sock);
        //         return -1;
        //     }

        //     $ms = ($time_stop - $time_start) * 1000;
           
        //     if ($ms < 0){
        //         $g_icmp_error = "Response too long";
        //         $ms = -1;
        //     }

        //     socket_close($sock);

        //     return $ms;
        // }

        // function icmpChecksum($data){
        //     $bit = unpack('n*', $data);
        //     $sum = array_sum($bit);

        //     if (strlen($data) % 2) {
        //         $temp = unpack('C*', $data[strlen($data) - 1]);
        //         $sum += $temp[1];
        //     }

        //     $sum = ($sum >> 16) + ($sum & 0xffff);
        //     $sum += ($sum >> 16);

        //     return pack('n*', ~$sum);
        // }

        // function getLastIcmpError(){
        //     global $g_icmp_error;
        //     return $g_icmp_error;
        // }

        // function pineo($host) {
        //     $package = "\x08\x00\x19\x2f\x00\x00\x00\x00\x70\x69\x6e\x67";

        //     /* create the socket, the last '1' denotes ICMP */   
        //     $socket = socket_create(AF_INET, SOCK_RAW, 1);
           
        //     /* set socket receive timeout to 1 second */
        //     socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 1, "usec" => 0));
           
        //     /* connect to socket */
        //     socket_connect($socket, $host, null);
           
        //     /* record start time */
        //     list($start_usec, $start_sec) = explode(" ", microtime());
        //     $start_time = ((float) $start_usec + (float) $start_sec);
           
        //     socket_send($socket, $package, strlen($package), 0);
           
        //     if(@socket_read($socket, 255)) {
        //         list($end_usec, $end_sec) = explode(" ", microtime());
        //         $end_time = ((float) $end_usec + (float) $end_sec);
           
        //         $total_time = $end_time - $start_time;
               
        //         return $total_time;
        //     } else {
        //         return false;
        //     }
           
        //     socket_close($socket);
        // }

        // if (pineo("192.168.102.2", 1000)){
        //     echo "Esta";
        // } else {
        //     echo "Nel:".pineo("192.168.102.2", 1000);
        // }

        // function ping($ip_net){
        //     for ($i=1; $i<=10; $i++)
        //         if (@fsockopen($ip_net.$i, 80, $errno, $errstr, 1)){
        //             echo "<b>IP Connected: [".$ip_net.$i."]</b><br/>";
        //             // send_ping_request('start cmd.exe @cmd /k "ping "'.$ip_net.$i.'"');
        //         } else {
        //             echo "Falló la: ".$ip_net.$i."<br/>";
        //         }
        // }

        // setcookie("PING", ping("192.168.1."));

        // ping("192.168.102.");
    ?>

    <!-- Tour Activation Btn -->
    <!-- <button class="btn btn-primary" id="tour_start" type="button">Begin Tour</button> -->

    <!-- Tour Steps -->
    <!-- <div class="row">
      <div class="col-md-6">
        <div class="panel" id="tour-item1">
            <div class="panel-heading">
              <span class="panel-title"> Panel 1</span>
            </div>    
            <div class="panel-body" style="min-height: 100px;">
            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel" id="tour-item2">
            <div class="panel-heading">
              <span class="panel-title"> Panel 2</span>
            </div>    
            <div class="panel-body" style="min-height: 100px;">
            </div>
        </div>
      </div>
    </div> -->

    <!-- Wrap content in admin-panel class -->
    <div>

        <div class="row AdminPanel_DevicesManagement">
            <div class="col-md-12">
                 <!-- Create Panel with required unique ID -->
                <div class="panel" id="pUnique_DevicesManagement">
                    <div class="panel-heading">
                        <span class="panel-icon"><i class="fa fa-desktop"></i></span>
                        <span class="panel-title">Gestión de dispositivos</span>
                        
                        <div class="container_options_controls" style="position: absolute; top: 0; right:100px;">
                            <button style="padding: 9px;" class="filter btn btn-primary btn-sm active" data-filter="all">Todo</button>
                            <button style="padding: 9px;" class="filter btn btn-primary btn-sm" data-filter=".category-1">Dispositivos finales</button>
                            <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-2">Enrutadores</button>
                            <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-3">Conmutadores</button>
                            <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-4">Servidores</button>

                            <!-- Orden -->
                            <button class="sort btn btn-default btn-sm btn_Order_Asc" data-sort="myorder:asc" style="display: none;">Asc</button>
                            <button class="sort btn btn-default btn-sm btn_Order_Desc" data-sort="myorder:desc" style="display: none;">Desc</button>

                            <!-- Split button -->
                            <div class="btn-group" style="display: inline-block;">
                                <button type="button" class="btn btn-danger btn_Order_value">Orden</button>
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="li_OrderAsc"><a href="#">Ascendente</a></li>
                                    <li class="li_OrderDesc"><a href="#">Descendente</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body AdminPanel_DevicesManagement_PanelBody">
                        <!-- Content -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Row -->
        <div class="row AdminPanel_TrackingNetwork">

            <!-- Create Column with required .admin-grid class -->
            <div class="col-md-12">

                <!-- Create Panel with required unique ID -->
                <div class="panel" id="pUnique_TrackingNetwork">
                    <div class="panel-heading">

                        <span class="panel-icon"><i class="fa fa-desktop"></i></span>
                        <span class="panel-title">Mapa de Red (Autodescubrir dispositivos)</span>

                        <div class="container_options_controls" style="position: absolute; top: 0; right: 100px;">
                            <button type="button" id="btn_tracking_b1" class="btn btn-dark btn_tracking_device" disabled="disabled">Configurar</button>
                            <button type="button" id="btn_tracking_b2" class="btn btn-dark btn_tracking_device" disabled="disabled">Consola</button>
                            <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Procesos</button>
                            <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Servicios</button>
                            <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Historial</button>
                            <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Propiedades</button>

                            <button type="button" class="btn btn-primary ladda-button progress-button" data-style="expand-right">
                                <span class="ladda-label">Tracking Network</span>
                            </button>
                        </div>

                    </div>
                    <div class="panel-body AdminPanel_TrackingNetwork_PanelBody">
                        <!-- El contenido -->
                    </div>
                </div>
            </div>
            <!-- End Column -->
        </div>

        <div class="row AdminPanel_ResourcesMonitor">

            <!-- Create Column with required .admin-grid class -->
            <div class="col-md-12">

                <!-- Create Panel with required unique ID -->
                <div class="panel" id="pUnique_ResourcesMonitor">
                    <div class="panel-heading">
                        <span class="panel-icon"><i class="fa fa-desktop"></i></span>
                        <span class="panel-title">Monitorizador de Recursos</span>
                    
                        
                        
                    </div>
                    <div class="panel-body AdminPanel_ResourcesMonitor_PanelBody">
                        <!-- El contenido -->
                    </div>
                </div>
            </div>
            <!-- End Column -->
        </div>
    </div>
</div>


<!-- <button type="hidden" class="AddRedactDocumentation" data-toggle="modal" data-target="#NowAddRedactDocumentation"></button> -->

<!-- <!- Modal -->
<!-- <div class="modal fade" id="NowAddRedactDocumentation" tabindex="-1" role="dialog" aria-labelledby="ModalRedactionDocument" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ModalRedactionDocument">Redactar el documento</h4>
      </div>
      <div class="modal-body">
	
			<script src="app/controller/src/plugins/ckeditor/ckeditor.js"></script>
			<script src="app/controller/src/plugins/ckeditor/samples/js/sample.js"></script>
			<link href="app/controller/src/plugins/ckeditor/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css" rel="stylesheet">

			<div class="adjoined-bottom">
				<div class="grid-container">
					<div class="grid-width-100">
						<div id="editor">
							<h1>¡Escribe tu documento!</h1>
						</div>
					</div>
				</div>
			</div>

			<script>
				initSample();
			</script>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-lg btn-primary savechange" data-placement="bottom" data-dismiss="" data-toggle="popover" title="Mensaje de acción" data-content="Los cambios han sido guardados con éxito!.">Guardar cambios</button>
      </div>
    </div>
  </div>
</div> -->