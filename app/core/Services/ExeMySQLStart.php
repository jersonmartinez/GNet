<?php
	execInBackground("MySQLStart.bat");

	function execInBackground($cmd) { 
		exec($cmd);
	}
?>