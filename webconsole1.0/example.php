<?php
	/****************************************************************************************************

		This example demonstrates the use of the ProcessList class.
		It works the same way for both Windows and Unix platforms.

	 ****************************************************************************************************/

	// This package requires the Wmi package for Windows platforms : 
	//	http://www.phpclasses.org/package/10001-PHP-Provides-access-to-Windows-WMI.html
	// A version of this package is provided here for convenience, but it may not be the latest release.
	require_once ( 'Wmi.phpclass' ) ;

	require_once ( 'ProcessList.phpclass' ) ;

	if  ( php_sapi_name ( )  !=  'cli' )
		echo ( "<pre>" ) ;

	// Get the process list and print it
	$ps	=  new ProcessList ( ) ;
	
	foreach  ( $ps  as  $process )
	   {
		print_r ( $process ) ;
		echo ( "\n" ) ;
	    }