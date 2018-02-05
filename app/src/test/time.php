<?php
	echo date('Y-n-j | H:m:s', time());
	echo "<br/>";
	echo date('Y-n-j | H:m:s', (time() - 1000));

	echo "<br/>";

	echo date('l jS \of F Y h:i:s A');

	echo "<br/>";
	echo date('h:i:s A', time() - 600);


	echo "<br/> Time: ".time();
	echo "<br/> Time - 10min: ".(time()-600);

	echo "<br/> Time: ".time();

	echo "<br/><br/>";

	$DB = 1477626734;
	$Actual = time() - 60;
	$tiempo = $DB-$Actual;

	if ($DB >= $Actual){
		echo date("i:s", $tiempo);
	} else {
		echo "Ya puedes acceder";
	}


?>