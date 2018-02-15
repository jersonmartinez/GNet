<div>
	<table ondblclick="javascript: CloseModal();" style="width: 100%;">
		<!-- <tr>
			<td style="width: 100%; padding: 10px;"><b>Hosts encontrados</b></td>
		</tr> -->

		<?php
			@session_start();
			@$_SESSION['call'] = "On";

			include ("ssh.class.php");
			$CN = new ConnectSSH();

			// echo "Aplicando limpieza...".$CN->InitTables()."<br/>";
			
			$time_start = microtime(true);

			// echo shell_exec("nmap 192.168.100.0/24 -n -sP | grep report | awk '{print $5}'");
			// 	echo " | host: ".$value;
			// }

			$CN->SpaceTest();

			include ("../network/nodeStyles/images.php");

			$time_end = microtime(true);
			$time = $time_end - $time_start;

			?>
				<input type="hidden" id="input_retardo" value="Retardo de tiempo: <?php echo number_format($time, 2, '.', ''); ?> seg." />
			<?php


			// // Dormir por un momento
			// usleep(100);



			// echo "IP de red Local: ".$CN->getIpRouteLocal()."<br/>";

			// $IP = "192.168.100.1";

			// if ($CN->IsRouter($IP)){
			// 	echo "<br/>Es un enrutador<br/>";
			// } else {
			// 	echo "<br/>Es un host<br/>";
			// }

			// echo "IP es esta: ".$CN->getIpRouteRemote($IP);
			


			// echo "IP es: ".$CN->getIpRouteLocal();
			// list ($AHost, $ANetwork) = $CN->Tracking();

			// print_r($AHost);
			// print_r($ANetwork);

		?>

		<!-- <tr>
			<td style="width: 100%; padding: 10px;"><b>Hosts encontrados</b></td>
		</tr> -->
	</table>
	<br>
</div>

<style>
	.show_elements {
	  padding: 10px; background-color: rgba(0,0,0,.1);
	}
	.show_elements:hover {
	  cursor: pointer;
	  background-color: rgba(0,0,0,.2);
	}
</style>