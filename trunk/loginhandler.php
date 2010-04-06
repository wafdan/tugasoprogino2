<?php

/*
	File		loginhandler.php
	Deskripsi	Handler untuk form login
 */

require_once('includes/session.php');
require_once('includes/auth.php');

// Masukan dari form login dari home akan diproses di sini
// setelah input diproses, baik gagal maupun berhasil
// akan diredirect kembali ke halaman home (pakai meta http-equiv refresh, macam di rileks)

sessionInit();

if($_POST['data']) {
	if(authLogin($_POST['data']['login']['username'], $_POST['data']['login']['password'])) {
		sessionSet('splashmsg', 'Logged in');
		sessionSet('splashtarget', 'index.php');
		setCookie('myUserID', $_POST['data']['login']['username']);
		header('Location: splash.php');
	} else {
		sessionSet('msg', 'Incorrect username and/or password.');
		header('Location: index.php');
	}
}

?>