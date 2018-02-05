<?php
	execInBackground("MySQLStop.bat");

	function execInBackground($cmd) { 
	    if (substr(php_uname(), 0, 7) == "Windows"){ 
	        exec($cmd);
	    } else { 
	        exec($cmd . " > /dev/null &");   
	    }
	}
?>