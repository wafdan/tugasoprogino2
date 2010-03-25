<?php

/*
	File		administratorhandler.php
	Deskripsi	Handler untuk bagian administrator
 */

require_once('includes/session.php');
require_once('includes/administrator.php');

sessionInit();

if($_POST) {
	/*
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	 */
	 
	$action = $_POST['action'];
	$data = $_POST['data'][$action];
	
	switch($action) {
		// User Management section
		case 'useradd':
			if(userAdd($data)) {
				// Jika userAdd berhasil
			
			} else {
				// Jika userAdd gagal
				sessionSet('msg', 'Add user error.');
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
			if(facultyAdd($data)) {
				
			} else {
				sessionSet('msg', 'Add faculty error.');
			}
			break;
		
		case 'facultydel':
			if(facultyDel($data)) {
				
			} else {
				sessionSet('msg', 'Remove faculty error.');
			}
			break;
		
		case 'programadd':
			if(programAdd($data)) {
			
			} else {
				sessionSet('msg', 'Add program error.');
			}
			break;
		
		case 'programdel':
			if(programDel($data)) {
			
			} else {
				sessionSet('msg', 'Remove program error.');
			}
			break;
		
		case 'courseadd':
			if(courseAdd($data)) {
			
			} else {
				sessionSet('msg', 'Add course error.');
			}
			break;
		
		case 'coursedel':
			if(courseDel($data)) {
			
			} else {
				sessionSet('msg', 'Remove course error.');
			}
			break;
		
		case 'courseinstadd':
			if(courseinstAdd($data)) {
			
			} else {
				sessionSet('msg', 'Add course instance error.');
			}
			break;
		
		case 'courseinstmod':
			break;
		
		case 'courseinstdelegate':
			if(courseinstDelegate($data)) {
				
			} else {
				sessionSet('msg', 'Delegate course instance error.');
			}
			break;
		
		case 'courseinstdel':
			break;
		
		// Default behavior
		default:
			echo 'unexpected input';
	}
	
	sessionSet('splashmsg', 'Processing your action');
	sessionSet('splashtarget', 'administrator.php');
	header('Location: splash.php');
}

?>