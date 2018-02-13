
<?php

// this works
 /**
  * Path to the root of the application
  */
define("PATH_ROOT", dirname(__FILE__));

// this does not
 /**
  * Path to configuration files
  */
const PATH_CONFIG = PATH_ROOT . "/config";

// this does
 /**
  * Path to configuration files - DEPRECATED, use PATH_CONFIG
  */
const PATH_CONF = PATH_CONFIG;

$algo = PATH_ROOT;


echo dirname("../".__FILE__);
?> 