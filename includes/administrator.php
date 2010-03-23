<?php

/*
	File		administrator.php
	Deskripsi	Penanganan input output data untuk urusan administrasi
 */

require_once('session.php');
require_once('databaseconnection.php');

function userAdd($data) {
	databaseconnect();
	$sql = 'select * from user';
	$result = mysql_query($sql);
	echo 'asd';
	
	return false;
}

?>