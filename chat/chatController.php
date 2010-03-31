<?php

require_once('../includes/config.php');
require_once('../includes/databaseconnection.php');
require_once('../includes/session.php');

if($_POST) {
	$json = $_POST['json'];
	
	$array = json_decode($json, true);
	$action = $array['action'];
	$data = $array['data'];
	
	databaseconnect();

	$sender = mysql_real_escape_string($data['sender']);
	$receiver = mysql_real_escape_string($data['recver']);
	
	switch($action) {
		case 'send':
			$message = mysql_real_escape_string(htmlentities($data['message'], ENT_QUOTES));
			
			$sql = "INSERT INTO `chat`
						(`sender`, `receiver`, `message`)
					VALUES
						('$sender',
						 '$receiver',
						 '$message')";
			
			if(mysql_query($sql)) {
				$response = array();
				$response['ack'] = $message;
				
				echo json_encode($response);
			} else {
				echo mysql_error();
			}
			
			break;
			
		case 'poll':
			$response = array();
			
			$sql = "SELECT `userid`
					FROM `presence`
					WHERE NOT(`userid` = '$sender') AND `timestamp` >= DATE_SUB(NOW() , INTERVAL 8 SECOND)";
			$result = mysql_query($sql);
			
			$n = 0;
			while($data = mysql_fetch_assoc($result)) {
				$response['users'][$n]['id'] = $data['userid'];
				
				$n++;
			}
			
			$sql = "INSERT INTO `presence`
						(`userid`)
					VALUES
						('$sender') ON DUPLICATE KEY UPDATE `userid` = '$sender', `timestamp` = NOW()";
			mysql_query($sql);
			
			$sql = "SELECT *
					FROM `chat`
					WHERE `receiver` = '$sender' ORDER BY `chatid`";
			
			if($result = mysql_query($sql)) {
				$n = 0;
				while($data = mysql_fetch_assoc($result)) {
					$response['messages'][$n]['from'] = $data['sender'];
					$response['messages'][$n]['message'] = $data['message'];
					
					$sql = "DELETE FROM `chat` WHERE `chatid` = '$data[chatid]'";
					mysql_query($sql);
					
					$n++;
				}
				
				echo json_encode($response);
			} else {
				echo mysql_error();
			}
			
			break;
	}	
}
?>