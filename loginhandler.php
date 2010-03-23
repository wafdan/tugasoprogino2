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

if($_POST['data']) {
	if(authLogin($_POST['data']['login']['username'], $_POST['data']['login']['password'])) {
		echo 'ok';
	} else {
		echo 'gagal';
	}
}

?>