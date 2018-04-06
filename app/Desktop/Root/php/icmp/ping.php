<?php
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

#!/usr/local/bin/php -q
<?php
include("./class_ICMP.php");

// example callback function; see class_ICMP.php for valid $data values
function timeout_callback($callback_type,$data) {
	echo "Agh!  Request timed out!\n";
}

$icmp = new ICMP();

// example of using callbacks to trap specific events; see class_ICMP.php
// for a list of valid callbacks
$icmp->set_callback("timeout","timeout_callback");

$icmp->display = true;

if ($_SERVER["argc"]<2) {
	echo "Usage: ".$_SERVER["argv"][0]." hostname pingcount\n";
  die;
}
if ($_SERVER["argc"]>1) $hostname = $_SERVER["argv"][1];
if ($_SERVER["argc"]>2) $pingcount = $_SERVER["argv"][2]; else $pingcount = 3;

$pingreceived = $icmp->ping($hostname,$pingcount);

echo "\n";
if ($pingcount==$pingreceived) {
  echo "The server responded to all pings.";
} elseif ($pingreceived>0) {
	echo "The server responded to some pings, but there was intermittent packet loss.";
} else {
	echo "The server did not respond.";
}
echo "\n";
?>

