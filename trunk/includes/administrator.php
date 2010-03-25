<?php

/*
	File		administrator.php
	Deskripsi	Penanganan input output data untuk urusan administrasi
 */

require_once('session.php');
require_once('databaseconnection.php');

function facultyAdd($data) {
	databaseconnect();
	
	$code = $data['code'];
	$name = $data['name'];
	
	$sql = "INSERT INTO `faculty`
				(`code`,
				 `name`)
				
			VALUES(
				 '$code',
				 '$name')";
	
	$result = mysql_query($sql);
	if($result) {
		return true;
	} else {
		echo mysql_error();
		return false;
	}
}

function facultyDel($data) {
	databaseconnect();
	
	$facultyid = $data['facultyid'];
	
	$sql = "DELETE FROM `faculty` WHERE `facultyid` = '$facultyid';";
	if(mysql_query($sql)) {
		return true;
	} else {
		echo mysql_error();
		return false;
	}
}

function getFacultyList() {
	databaseconnect();
	
	$sql = "SELECT * FROM `faculty` ORDER BY `code` ASC";
	$result = mysql_query($sql);
	
	$data = array();
	$n = 0;
	while($item = mysql_fetch_assoc($result)) {
		$data[$n]['facultyid'] = $item['facultyid'];
		$data[$n]['code'] = $item['code'];
		$data[$n]['name'] = $item['name'];
		
		$n++;
	}
	
	return $data;
}

function programAdd($data) {
	databaseconnect();
	
	$facultyid = $data['facultyid'];
	$code = $data['code'];
	$name = $data['name'];
	
	$sql = "INSERT INTO `program`
				(`facultyid`,
				 `code`,
				 `name`)
				
			VALUES(
				 '$facultyid',
				 '$code',
				 '$name')";
	
	$result = mysql_query($sql);
	if($result) {
		return true;
	} else {
		echo mysql_error();
		return false;
	}
}

function getProgramList() {
	databaseconnect();
	
	$sql = "SELECT
				`faculty`.`facultyid` AS `facultyid`,
				`program`.`programid` AS `programid`,
				`faculty`.`code` AS `facultycode`,
				`program`.`code` AS `code`,
				`program`.`name` AS `name`
			FROM `faculty`, `program` 
			WHERE `program`.`facultyid` = `faculty`.`facultyid`
			ORDER BY `facultycode` ASC, `name` ASC";
	$result = mysql_query($sql);
	
	$data = array();
	$n = 0;
	while($item = mysql_fetch_assoc($result)) {
		$data[$n]['programid'] = $item['programid'];
		$data[$n]['facultycode'] = $item['facultycode'];
		$data[$n]['code'] = $item['code'];
		$data[$n]['name'] = $item['name'];
		
		$n++;
	}
	
	return $data;
}

function getCourseList() {
	databaseconnect();
	
	$sql = "SELECT * FROM `course` ORDER BY `coursecode` ASC";
	$result = mysql_query($sql);
	
	$data = array();
	$n = 0;
	while($item = mysql_fetch_assoc($result)) {
		$data[$n]['id']	= $item['courseid'];
		$data[$n]['code'] = $item['coursecode'];
		$data[$n]['name'] = $item['coursename'];
		
		$n++;
	}
	
	return $data;
}

function courseAdd($data) {
	databaseconnect();
	
	$programid = $data['courseprogram'];
	$code = $data['coursecode'];
	$name = $data['coursename'];
	
	$sql = "INSERT INTO `course`
				(`coursecode`,
				 `coursename`,
				 `courseprogram`)
				
			VALUES
				('$code',
				 '$name',
				 '$programid')";
	$result = mysql_query($sql);
	
	if($result) {
		return true;
	} else {
		echo mysql_error();
		return false;
	}
}

function courseinstAdd($data) {
	databaseconnect();
	
	$courseid = $data['courseid'];
	$year = $data['year'];
	$semester = $data['semester'];
	
	$sql = "INSERT INTO `courseinstance`
				(`courseid`,
				 `year`,
				 `semester`)
				
			VALUES
				('$courseid',
				 '$year',
				 '$semester')";
	$result = mysql_query($sql);
	
	if($result) {
		return true;
	} else {
		echo mysql_error();
		return false;
	}
}

function courseinstDelegate($data) {
	databaseconnect();
	
	$courseid = $data['courseid'];
	$year = $data['year'];
	$semester = $data['semester'];
	$username = $data['username'];
	
	// check for course instance existence
	$sql = "SELECT * FROM `courseinstance`
			WHERE `courseid` = '$courseid' AND
				  `year` = '$year' AND
				  `semester` = '$semester'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 0) {
		return false;
	} else {
		$courseinstancedata = mysql_fetch_assoc($result);
		$courseinstanceid = $courseinstancedata['courseinstanceid'];
		
		// check for username existence
		$sql = "SELECT * FROM `user`
				WHERE `username` = '$username'";
		$result = mysql_query($sql);
		echo mysql_error();
		if(mysql_num_rows($result) == 0) {
			return false;
		} else {
			$userdata = mysql_fetch_assoc($result);
			$userid = $userdata['userid'];
			
			// insert into courseinstance
			$sql = "INSERT INTO `courseinstancemanager`
						(`userid`, `courseinstanceid`)
					VALUES
						('$userid', '$courseinstanceid')";
			$result = mysql_query($sql);
			if($result) {
				return true;
			} else {
				echo mysql_error();
				return false;
			}
		}
	}
}

?>