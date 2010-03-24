<?php

require_once('config.php');

function databaseconnect() {
	global $cfg;
    $con = mysql_connect($cfg['Database']['host'], $cfg['Database']['user'], $cfg['Database']['pass']);
    if(!$con) {
        die('Could not connect: '.mysql_error());
    }
	
	mysql_select_db('progin2', $con);
}

function databasedisconnect() {
	$con = mysql_close();
}

?>