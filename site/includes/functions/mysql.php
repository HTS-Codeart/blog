<?php
  require_once('mysqlinfo.php');
  /* Here we'll have all of the DB access functions and shit */
  function db_connect() {
    $dbinfo = get_mysqlinfo();
    return mysqli_connect($dbinfo['host'],$dbinfo['username'],$dbinfo['pass'],$dbinfo['db']);
  }

  function db_query($sql) {
    $con = db_connect();
    $result = mysqli_query($con, $sql);
    if(!$result) {
      die("Error in SQL Query");
    } else {
      return $result;
    }
  }

  function row_count($sql) {
    $con = db_connect();
    $result = db_query($sql);
    $count = mysqli_num_rows($result);
    return $count;
  }

  function db_escape($string) {
    $con = db_connect();
    return mysqli_real_escape_string($con,$string);
  }
?>