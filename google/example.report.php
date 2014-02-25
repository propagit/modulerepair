<?php

$con = mysql_connect($db['default']['hostname'],'propates_admin','pr0p4t3st_4dm1n');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db('propates_wave1', $con);


$result = mysql_query("SELECT * FROM webstat where id = 1")  ;
while($row = mysql_fetch_array($result))
{
	
	
	define('ga_email',$row['web_email']);
	define('ga_password',$row['web_password']);
	define('ga_profile_id',$row['profile_id']);
	
}

require 'gapi.class.php';

$ga = new gapi(ga_email,ga_password);


$start_date = date('Y-m-d');
$start_date = date('Y-m-d', strtotime('-1 day'));
$end_date = date('Y-m-d', strtotime('-1 day'));

$ga->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits', 'newVisits'), 'date', '', $start_date, $end_date, 1, 366);
$yesterday = $ga->getPageviews();


$start_date = date('Y-m-d');
$end_date = date('Y-m-d');

$ga->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits', 'newVisits'), 'date', '', $start_date, $end_date, 1, 366);
$today = $ga->getPageviews();


$start_date = date('Y-m-01', strtotime('-1 month'));
$end_date = date('Y-m-t', strtotime('-1 month'));

$ga->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits', 'newVisits'), 'date', '', $start_date, $end_date, 1, 366);
$lastmonth = $ga->getPageviews();

$start_date = date('Y-m-01');
$end_date = date('Y-m-t');

$ga->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits', 'newVisits'), 'date', '', $start_date, $end_date, 1, 366);
$thismonth = $ga->getPageviews();


#NEW VISIT

$start_date = date('Y-m-d');
$start_date = date('Y-m-d', strtotime('-1 day'));
$end_date = date('Y-m-d', strtotime('-1 day'));

$ga->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits', 'newVisits'), 'date', '', $start_date, $end_date, 1, 366);
$yesterday_unique = $ga->getVisits();


$start_date = date('Y-m-d');
$end_date = date('Y-m-d');
#echo $start_date.$end_date.'<br>';
$ga->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits', 'newVisits'), 'date', '', $start_date, $end_date, 1, 366);
$today_unique = $ga->getVisits();


$start_date = date('Y-m-01', strtotime('-1 month'));
$end_date = date('Y-m-t', strtotime('-1 month'));
#echo $start_date.$end_date.'<br>';
$ga->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits', 'newVisits'), 'date', '', $start_date, $end_date, 1, 366);
$lastmonth_unique = $ga->getVisits();

$start_date = date('Y-m-01');
$end_date = date('Y-m-t');
#echo $start_date.$end_date.'<br>';
$ga->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits', 'newVisits'), 'date', '', $start_date, $end_date, 1, 366);
$thismonth_unique = $ga->getVisits();



mysql_query("UPDATE webstat SET today_pageview=".$today.", yesterday_pageview=".$yesterday.", lastmonth_pageview=".$lastmonth.", thismonth_pageview=".$thismonth.", today_unique=".$today_unique.", yesterday_unique=".$yesterday_unique.", lastmonth_unique=".$lastmonth_unique.", thismonth_unique=".$thismonth_unique." WHERE id=1");
?>