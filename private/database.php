<?php

  require_once('db-credentials.php');

  /**
   * Connects to the SQL Database using Credentials in db-credentials.php
  
   *
   * @return mysqli the Connection to the database
   */
  function dbConnect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirmDBConnect();
    return $connection;
  }

  /**
   * Disconnects from the current database
   *
   * @param mysqli $connection the database connection to disconnect
   *
   */
  function dbDisconnect($connection) {
    if(isset($connection)) {
      mysqli_close($connection);
    }
  }

  /**
   * Gives error msg if mysqli has trouble connecting
   */
  function confirmDBConnect() {
    if(mysqli_connect_errno()) {
      $msg = "Database connection failed: ";
      $msg .= mysqli_connect_error();
      $msg .= " (" . mysqli_connect_errno() . ")";
      exit($msg);
    }
  }

  /**
   * Checks if a query was successful
   *
   * @param mysqli $resultSet resultset from query
   */
  function confirmResultSet($resultSet) {
    if (!$resultSet) {
    	exit("Database query failed.");
    }
  }

?>
