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
	print_r($_FILES);
	
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
	if($result) {
		if($_FILES) {
			$filename = strtolower($_FILES['photo']['name']);
			$filename = md5($filename).substr($filename, strrpos($filename, '.'));
			if(move_uploaded_files($_FILES['photo']['tmp_name'], 'photofiles/'.$filename)) {
				echo 'photo ok';
			} else {
				echo 'error';
			}
		}
	} else {
		echo mysql_error();
	}
	
	return false;
}

?>