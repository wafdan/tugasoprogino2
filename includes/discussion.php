<?php

require_once('session.php');
require_once('databaseconnection.php');

function discussionGetTopic($cinstid) {
	databaseconnect();
	
	$sql = "SELECT `courseinstancetopic`.`topicid` AS `id`,
				   `courseinstancetopic`.`title` AS `title`,
				   `courseinstancetopic`.`timestamp` AS `time`,
				   `courseinstancetopic`.`userid` AS `userid`,
				   `user`.`username` AS `username`
			FROM `courseinstancetopic`, `user`
			WHERE `courseinstancetopic`.`courseinstanceid` = '$cinstid' AND
				  `courseinstancetopic`.`userid` = `user`.`userid`
			ORDER BY `timestamp` DESC";
	$result = mysql_query($sql);
	if($result) {
		$data = array();
		$n = 0;
		
		while($topic = mysql_fetch_assoc($result)) {
			$data[$n]['id'] = $topic['topicid'];
			$data[$n]['title'] = $topic['title'];
			$data[$n]['time'] = $topic['time'];
			$data[$n]['userid'] = $topic['userid'];
			$data[$n]['username'] = $topic['username'];
			
			$n++;
		}
		
		return $data;
	}
}

function addTopic($data) {
	databaseconnect();
	
	$cinstid = $data['cinstid'];
	$title = $data['title'];
	$content = $data['content'];
	$userid = sessionGet('activeUserID');
	$time = date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO `courseinstancetopic`
				(`courseinstanceid`,
				 `title`,
				 `userid`,
				 `timestamp`)
			VALUES(
				 '$cinstid',
				 '$title',
				 '$userid',
				 '$time')";
	$result = mysql_query($sql);
	if($result) {
		return true;
	} else {
		echo mysql_error();
		return false;
	}
}

?>