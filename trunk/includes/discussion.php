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
			$data[$n]['id'] = $topic['id'];
			$data[$n]['title'] = $topic['title'];
			$data[$n]['time'] = $topic['time'];
			$data[$n]['userid'] = $topic['userid'];
			$data[$n]['username'] = $topic['username'];
			
			$n++;
		}
		
		return $data;
	}
}

function discussionGetTopicDetail($id) {
	databaseconnect();
	
	$sql = "SELECT `courseinstancetopic`.`topicid` AS `id`,
				   `courseinstancetopic`.`title` AS `title`,
				   `courseinstancetopic`.`timestamp` AS `time`,
				   `courseinstancetopic`.`userid` AS `userid`,
				   `user`.`username` AS `username`
			FROM `courseinstancetopic`, `user`
			WHERE `courseinstancetopic`.`topicid` = '$id' AND
				  `courseinstancetopic`.`userid` = `user`.`userid`";
	$result = mysql_query($sql);
	$topic = mysql_fetch_assoc($result);
	
	$data = array();
	$data['topic']['id'] = $topic['id'];
	$data['topic']['title'] = $topic['title'];
	$data['topic']['userid'] = $topic['userid'];
	$data['topic']['username'] = $topic['username'];
	
	$sql = "SELECT `courseinstancetopicpost`.`userid` AS `userid`,
				   `courseinstancetopicpost`.`content` AS `content`,
				   `courseinstancetopicpost`.`timestamp` AS `time`,
				   `user`.`username` AS `username`
			FROM `courseinstancetopicpost`, `user`
			WHERE `courseinstancetopicpost`.`topicid` = '$id' AND
				  `courseinstancetopicpost`.`userid` = `user`.`userid`
			ORDER BY `timestamp` ASC";
	$result = mysql_query($sql);
	$n = 0;
	while($post = mysql_fetch_assoc($result)) {
		$data['post'][$n]['userid'] = $post['userid'];
		$data['post'][$n]['content'] = $post['content'];
		$data['post'][$n]['time'] = $post['time'];
		$data['post'][$n]['username'] = $post['username'];
		
		$n++;
	}
	
	return $data;
}

function addTopic($data) {
	databaseconnect();
	
	$cinstid = $data['cinstid'];
	$title = $data['title'];
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

function addPost($data) {
	databaseconnect();
	
	$cinstid = $data['cinstid'];
	$topicid = $data['topicid'];
	$content = $data['content'];
	$userid = sessionGet('activeUserID');
	$time = date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO `courseinstancetopicpost`
				(`userid`,
				 `topicid`,
				 `content`,
				 `timestamp`)
			VALUES
				('$userid',
				 '$topicid',
				 '$content',
				 '$time')";
	$result = mysql_query($sql);
	header('Location: discussion.php?courseinstanceid='.$cinstid.'&viewtopic='.$topicid);
}

?>