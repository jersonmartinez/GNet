<?php
    function know_free_space(){
    	$bytes = disk_free_space(".");
	    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
	    $base = 1024;
	    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
	    return sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
    }
?>