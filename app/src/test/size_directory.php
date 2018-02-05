<?php 
/** 
  * Get the directory size 
  * @param directory $directory 
  * @return integer 
  */ 
	function dirSize($directory) { 
	    $size = 0; 
	    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){ 
	        $size+=$file->getSize(); 
	    } 

	    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
	    $base = 1024;
		$class = min((int)log($size , $base) , count($si_prefix) - 1);
	    $size = sprintf('%1.2f' , $size / pow($base,$class)) . ' ' . $si_prefix[$class];

	    return $size; 
	} 

?> 