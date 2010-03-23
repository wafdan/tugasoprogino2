<?php

/*
	File		auth.php
	Deskripsi	Penanganan otentikasi
 */

require_once('session.php');
require_once('databaseconnection.php');

function authLogin($user, $pass) {
	/*
		Fungsi authLogin bekerja sebagai berikut:
			mencari user dengan username $user dan password $pass (md5hash) dan statusnya ACTIVE
			jika ada:
				set variabel session activeUserID, activeUsername, activeFullname, activeRole (gunakan sessionSet)
				return true
			jika tidak:
				return false
	 */
	
	databaseconnect();
	
	$pass = md5($pass);
	
	$sql = "SELECT * FROM `user` WHERE `username` = '$user' AND `password` = '$pass'";
	$result = mysql_query($sql);
		
	if(mysql_num_rows($result) > 0) {
		$data = mysql_fetch_array($result);
		
		sessionSet('activeUserID', $data['userid']);
		sessionSet('activeUsername', $data['username']);
		sessionSet('activeFullname', $data['fullname']);
		sessionSet('activeRole', $data['role']);
		
		return true;
	} else {
		return false;
	}
}

function authLogout() {
	// Fungsi ini untuk me-logout user dari sistem
	// dengan melakukan destroy session
	
	session_unset();
}

function isLogin() {
	// Fungsi ini memeriksa apakah user telah login atau belum
	// periksa apakah variabel session activeUsername ada/sudah di-set
	// jika iya: return true
	// jika tidak: return false
}

function authGetRole() {
	// Fungsi ini mengembalikan role user yang sedang login
}

?>