<?php
	#Capture the user and IP address in the start session.
	#Add the datas in a table.
	#Indentify the datas in the login.php, try captured.

	#Creo la función para extraer la IP, a partir de aquí se estarán agregando a una clase de seguridad.
	
	$AttackDetect = "";
	$IntCount = 0;
	$RunNum = 5;
	
	$Q = "SELECT * FROM ".$X."control_user ORDER BY id DESC LIMIT ".$RunNum;
	$GetLastNum = $IC->query($Q);

	if ($GetLastNum){
		while ($GLN = $GetLastNum->fetch_array(MYSQLI_ASSOC)){
			if ($GLN['ip'] == getIpAddr() && $GLN['usr'] == $un){
				$IntCount += 1;
			}
		}
		
		if ($IntCount == $RunNum){
			$Q = "SELECT * FROM ".$X."control_user ORDER BY id DESC LIMIT 1";

			$GetFinalNum = $IC->query($Q);

			if ($GetFinalNum){
				$GFN = $GetFinalNum->fetch_array(MYSQLI_ASSOC);

				if ($GFN['finished'] == "/"){
					$IntCount = 0;

					$Q = "INSERT INTO ".$X."control_user (id, usr, ip, count, finished, date_log, date_log_unix) VALUES ('','".$un."','".getIpAddr()."','".($IntCount + 1)."','','".date('Y-n-j')."','".time()."');";

					$IC->query($Q);
					exit();
				} else {

					if ($GFN['count'] == $RunNum){
						$Q = "UPDATE ".$X."control_user SET finished='/' WHERE id='".$GFN['id']."';";
						
						if (!$Val){
							if ($IC->query($Q)){
								$Insert = "INSERT INTO ".$X."control_attack (id, victim, attacker, date_log, date_log_unix) VALUES ('','".$un."','".getIpAddr()."','".date('Y-n-j')."','".time()."');";
								
								if ($IC->query($Insert)){
									$AttackDetect = "AD";
								}
							}
						}
					} else {
						$IntCount = $GFN['count'];
						$Q = "INSERT INTO ".$X."control_user (id, usr, ip, count, finished, date_log, date_log_unix) VALUES ('','".$un."','".getIpAddr()."','".($IntCount + 1)."','','".date('Y-n-j')."','".time()."');";

						$IC->query($Q);
					}
				}
			}
		} else if ($IntCount >= 1 && $IntCount <= ($RunNum - 1)){
			$GetLastThisNum = $IC->query("SELECT * FROM ".$X."control_user ORDER BY id DESC LIMIT ".$IntCount);

			if ($GetLastThisNum){
				$IntCountTwo = 0;

				while ($GLTN = $GetLastThisNum->fetch_array(MYSQLI_ASSOC)){
					if ($GLTN['ip'] == getIpAddr() && $GLTN['usr'] == $un){
						$IntCountTwo += 1;
					}
				}

				if ($IntCountTwo == $IntCount){
					$Q = "INSERT INTO ".$X."control_user (id, usr, ip, count, finished, date_log, date_log_unix) VALUES ('','".$un."','".getIpAddr()."','".($IntCount + 1)."','','".date('Y-n-j')."','".time()."');";

					$IC->query($Q);
				}
			}
		} else {

			$Q = "INSERT INTO ".$X."control_user (id, usr, ip, count, finished, date_log, date_log_unix) VALUES ('','".$un."','".getIpAddr()."','".($IntCount + 1)."','','".date('Y-n-j')."','".time()."');";
			
			$IC->query($Q);
		}
	}
?>