<?php
	$Algo = "netsh wlan set hostednetwork mode=allow ssid=Quepasoahi key='ExcelenteSmithers'";
	system($Algo);
	system("netsh wlan start hostednetwork");
	echo "Fin";
?>