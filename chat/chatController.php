<?php

require_once('../includes/config.php');
require_once('../includes/databaseconnection.php');
require_once('../includes/session.php');

if($_POST) {
	$action = $_POST['action'];
	
	databaseconnect();

	$sender = mysql_real_escape_string($_POST['sender']);
	$receiver = mysql_real_escape_string($_POST['receiver']);
	
	switch($action) {
		case 'send':
			$message = mysql_real_escape_string($_POST['message']);
			
			$sql = "INSERT INTO `chat`
						(`sender`, `receiver`, `message`)
					VALUES
						('$sender',
						 '$receiver',
						 '$message')";
			
			if(mysql_query($sql)) {
				echo $message."\n";
			} else {
				echo mysql_error();
			}
			
			break;
			
		case 'poll':
			$sql = "INSERT INTO `presence`
						(`userid`)
					VALUES
						('$sender') ON DUPLICATE KEY UPDATE `userid` = '$sender', `timestamp` = NOW()";
			mysql_query($sql);
			
			$sql = "SELECT *
					FROM `chat`
					WHERE `sender` = '$receiver' AND
						  `receiver` = '$sender'";
			
			if($result = mysql_query($sql)) {
				while($data = mysql_fetch_assoc($result)) {
					echo "$data[message]\n";
					
					$sql = "DELETE FROM `chat` WHERE `chatid` = '$data[chatid]'";
					mysql_query($sql);
				}
			} else {
				echo mysql_error();
			}
			
			break;
			
		case 'getonlineuser':
			$sql = "SELECT `userid`
					FROM `presence`
					WHERE `timestamp` >= DATE_SUB(NOW() , INTERVAL 2 SECOND)";
					
			break;
	}	
}
?>