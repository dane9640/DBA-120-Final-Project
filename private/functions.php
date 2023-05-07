<?php
/**
 * Creates a URL path from a Relative Path
 *
 * @param String $script_path Relative Path to convert
 *
 * @return String URL Path
 */
function urlFor($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

/**
 * Shortened Version of urlencode (See PHP Docs)
 *
 * @param String $string The String to be encoded
 *
 * @return String encoded string from urlencode()
 */
function u($string="") {
  return urlencode($string);
}

/**
 * Shortened Version of rawurlencode()
 *
 * @param String $string String to encode
 *
 * @return String Encoded string
 */
function rawU($string="") {
  return rawurlencode($string);
}

/**
 * Shortened version of htmlspecialchars() 
 *
 * @param String $string string to use
 *
 */
function h($string="") {
  return htmlspecialchars($string);
}

/**
 * Error 404 error msg
 */
function error404() {
  header($_SERVER['SERVER_PROTOCOL']. " 404 Not Found");
  exit();
}

/**
 * Error 500 error msg
 */
function error500() {
  header($_SERVER['SERVER_PROTOCOL']. " 500 Internal Server Error");
  exit();
}

/**
 * Redirects a page to a new location
 *
 * @param String $location Location to redirect to
 */
function redirectTo($location) {
  header('Location: '. $location);
}

/**
 * Checks if the page call is a POST request
 *
 * @return Boolean True if page call is POST
 */
function isPostRequest(){
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

/**
 * Checks if page call is a GET request
 *
 * @return Boolean True if page call is GET
 */
function isGetRequest(){
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

?>
