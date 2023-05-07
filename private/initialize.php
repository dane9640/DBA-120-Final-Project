<?php
  ob_start();

  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');
  

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can dynamically find everything in URL up to "/public"
  $publicEnd = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $docRoot = substr($_SERVER['SCRIPT_NAME'], 0, $publicEnd);
  define("WWW_ROOT", $docRoot);
  
  require_once('functions.php');
  require_once('database.php');
  require_once('query-functions.php');

  $db = dbConnect();
?>