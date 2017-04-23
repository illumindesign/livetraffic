<?php
/*
  Global Database Connection
*/

// DATABASE ACCESS INFORMATION ====================================================================
$hostname = "localhost";
$database = "";
$db_user =  "";
$db_password = "";

define("server",  $hostname);
define("databasename", $database);
define("user", $db_user);
define("pass", $db_password);

// DATABASE CONNECTION ===========================================================================

function connect()
{
  $connection = mysql_connect(server,user,pass) or die(mysql_error());
  if(!$connection) // are we not connected?
  {
    return "Couldn't make a connection!!!";
    exit;
  }
  $db = mysql_select_db(databasename);
  if(!$db) // is database selected?
  {
    return "The database disapeared!";
    mysql_close($connection);
    exit;
  }
}

echo connect();
