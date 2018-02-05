<?php
$objetivo = "origen.ext"; 
$enlace = "nuevo_fichero.ext";

if (symlink($objetivo, $enlace)){
	echo "Bien";
} else {
	echo "Mal";
}
?> 