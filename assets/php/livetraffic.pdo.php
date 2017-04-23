<?php
/*
  � BOBBY RATLIFF 2011-2017

  - Tracks Current Web Traffic
    - Which page they're on
    - Time spent on current page
    - Time and date of first and last visit
  - Gathers Browser Information
    - User's IP Address
    - User's Country
    - User's Browser & Version
    - User's Screen Resolution
    - User's Operating System
    - User's Flash Version
  - Monitors User Drop-off
  - Allows for Future Statistics

*/
session_start();

if (!$_SESSION['sc_session'])
{
  $sc_session = 0;
  if(isset($_GET['surl'])){
$sc_session = @mysql_result(mysql_query("SELECT `session` FROM `livetraffic` WHERE `site`='".$_GET['surl']."' ORDER BY `session` DESC"), 0);
  }else{
  $sc_session = @mysql_result(mysql_query("SELECT `session` FROM `livetraffic` ORDER BY `session` DESC"), 0);
  }
$sc_session++;
  $_SESSION['sc_session'] = $sc_session;
}

$SC['id'] = $_SESSION['sc_id'];
$SC['session'] = $_SESSION['sc_session'];
$SC['site'] = $_POST['site'];
$SC['type'] = $_SESSION['usr_type'];
$SC['ip'] = realip();
$loc = explode(".", $SC['ip']);
$ipnum = 16777216*$loc[0] + 65536*$loc[1] + 256*$loc[2] + $loc[3];
//$SC['country'] = @mysql_result(mysql_query("SELECT `cc` FROM `geoip_ip` NATURAL JOIN `geoip_cc` WHERE ".$ipnum." BETWEEN `start` AND `end`"), 0);
if (!$SC['country']) $SC['country'] = '??';
$SC['browser'] = $_SERVER['HTTP_USER_AGENT'];
$SC['resolution'] = $_POST['resolution'];
$SC['language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$SC['flv'] = $_POST['flv'];
$SC['page'] = $_POST['page'];
$SC['time'] = $_POST['time'];
$SC['date'] = time();
$SC['mobile'] = preg_match('/(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)/i', $_SERVER['HTTP_USER_AGENT']) ? 1 : 0;
$SC['bot'] = preg_match('/(bot)/i', $_SERVER['HTTP_USER_AGENT']) ? 1 : 0;

if ($SC['time'] == 0)
{
  $_SESSION['sc_id'] = '';
  mysql_query("INSERT INTO `livetraffic` (
    `id`,
    `session`,
    `site`,
    `type`,
    `country`,
    `ip`,
    `browser`,
    `resolution`,
    `language`,
    `flashver`,
    `page`,
    `time`,
    `date`,
    `update`,
    `mobile`,
    `bot`
  ) VALUES (
    NULL,
    '".$SC['session']."',
    '".$SC['site']."',
    '".$SC['type']."',
    '".$SC['country']."',
    '".$SC['ip']."',
    '".$SC['browser']."',
    '".$SC['resolution']."',
    '".$SC['language']."',
    '".$SC['flv']."',
    '".$SC['page']."',
    '".$SC['time']."',
    '".$SC['date']."',
    '".$SC['date']."',
    '".$SC['mobile']."',
    '".$SC['bot']."'
  );") or die (mysql_error());
  $_SESSION['sc_id'] = mysql_insert_id(); //@mysql_result(mysql_query("SELECT `id` FROM `livetraffic` ORDER BY `id` DESC"), 0);
  echo "continue";
}
else
{
  mysql_query("UPDATE `livetraffic` SET `time`='".$SC['time']."', `update`='".$SC['date']."' WHERE `id`='".$SC['id']."' AND `session`='".$SC['session']."' AND `page`='".$SC['page']."' LIMIT 1") or die (mysql_error());
  echo "continue";
}


#print_r($SC);
