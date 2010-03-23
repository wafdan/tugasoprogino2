<?php

/*
	File		administratorhandler.php
	Deskripsi	Handler untuk bagian administrator
 */

require_once('includes/session.php');
require_once('includes/administrator.php');

sessionInit();

if($_POST) {
	$action = $_POST['action'];
	$data = $_POST['data'][$action];
	
	switch($action) {
		// User Management section
		case 'useradd':
			if(userAdd($data)) {
				// Jika userAdd berhasil
			
			} else {
				// Jika userAdd gagal
				sessionSet('msg', 'Error');
			}
			break;
			
		case 'usermod':
			break;
			
		case 'userdisable':
			break;
			
		case 'userdel':
			break;
		
		// Course Management section
		case 'facultyadd':
			break;
		
		case 'facultydel':
			break;
		
		case 'programadd':
			break;
		
		case 'programdel':
			break;
		
		case 'courseadd':
			break;
		
		case 'coursemod':
			break;
		
		case 'coursedel':
			break;
		
		case 'courseinstadd':
			break;
		
		case 'courseinstmod':
			break;
		
		case 'courseinstdelegate':
			break;
		
		case 'courseinstdel':
			break;
		
		// Default behavior
		default:
			echo 'unexpected input';
	}
}

?>