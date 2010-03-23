<?php

/*
	File		session.php
	Deskripsi	Penanganan session
 */

require_once("config.php");

function sessionInit() {
	session_start();
}

function sessionSet($svar, $value) {
	$_SESSION[$cfg['Session']['prefix'].$svar] = $value;
}

function sessionGet($svar) {
	if(isset($_SESSION[$cfg['Session']['prefix'].$svar])) {
		return $_SESSION[$cfg['Session']['prefix'].$svar];
	} else {
		return false;
	}
}

function sessionUnset($svar) {
	unset($_SESSION[$cfg['Session']['prefix'].$svar]);
}

?>