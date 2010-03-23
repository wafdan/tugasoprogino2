<?php

/*
	File		administrator.php
	Deskripsi	Penanganan input output data untuk urusan administrasi
 */

require_once('session.php');
require_once('databaseconnection.php');

sessionInit();

function userAdd($data) {
	databaseconnect();
	
	print_r($data);
	
	$username = $data['username'];
	$fullname = $data['fullname'];
	$address = $data['address'];
	$email = $data['email'];
	$role = $data['role'];
	$status = $data['status'];
	$password = md5($data['password']);
	
	$now = date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO	`user`
				(`username`,
				 `password`,
				 `fullname`,
				 `email`,
				 `address`,
				 `role`,
				 `status`,
				 `registerdate`)
			VALUES(
				'$username',
				'$password',
				'$fullname',
				'$email',
				'$address',
				'$role',
				'$status',
				'$now')";
	$result = mysql_query($sql);
	echo mysql_error();
	
	return false;
}

?>