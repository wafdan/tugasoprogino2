<?php

require_once('includes/session.php');
require_once('includes/discussion.php');

if($_POST['action'] || $_GET['action']) {
	sessionInit();
	
	if(!($action = $_POST['action'])) {
		$action = $_GET['action'];
	}
	
	$data = $_POST['data'][$action];
	//print_r($data);
	
	switch($action) {
		case 'addtopic':
			addTopic($data);
			break;
		
		case 'addpost':
			addPost($data);
			break;
	}
}

?>