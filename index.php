<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

/**
 * This is a crackerjack MVC PHP framework used just to add some organization to small and medium projects, it handles
 * URI segments addresses and implements the MVC object oriented pattern, capable of manage
 * multiple controllers, models and views with a clear file organization
 *
 *@author 		Mangtomas Ungasis <red.mariano.dejuan@gmail.com>
 *@copyright	Copyright 2012(c) Red Mariano
 */
/*
*Error reporting
E_ERROR | E_WARNING | E_PARSE
*/
error_reporting(E_ERROR | E_WARNING | E_PARSE );

//Define constant

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',realpath(dirname(__FILE__)).DS);
define('SYSLIBS',ROOT.'system'.DS.'core'.DS);
define('APPS',ROOT.'application'.DS);
define('EXT','.php');
define('DEFAULT_APP','main');

//Start the application by the loading of core system

require SYSLIBS.'core.php';

 //    echo $date2 = date("Y-m-d H:i:s");
	// 	echo "<br />";
	// echo$date1 = "2014-01-01 10:10:10";

	// $diff = abs(strtotime($date2) - strtotime($date1));

	// 	echo "<br />";
	// echo $years = floor($diff / (365*60*60*24));
	// 	echo "<br />";
	// echo $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	// 	echo "<br />";
	// echo $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	 // = floor($difference/(86400));
	//echo $lead_time = ($days <0) ? 0 : $days;	
/*
	$now =strtotime("2014-01-01 10:10:10") ; // or your date as well
    $your_date = strtotime(date("Y-m-d H:i:s"));
    $datediff = $now - $your_date;
     echo floor($datediff/(60*60*24));
*/