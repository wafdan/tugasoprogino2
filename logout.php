<?php

/*
	File		logout.php
	Deskripsi	Logout user
 */

include('includes/session.php');
include('includes/auth.php');

authLogout();

sessionSet('splashmsg', 'Logged out');
sessionSet('splashtarget', 'index.php');
header('Location: splash.php');

?>