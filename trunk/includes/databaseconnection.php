<?php

require_once('config.php');

function databaseconnect() {
	global $cfg;
	
    if(!mysql_connect($cfg['Database']['host'], $cfg['Database']['user'], $cfg['Database']['pass'])) {
        die('Could not connect: '.mysql_error());
    }
	
	mysql_select_db('progin2');
}

function databasedisconnect() {
	mysql_close();
}

?>