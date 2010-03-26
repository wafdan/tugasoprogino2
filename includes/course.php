<?php

/*
	File		course.php
	Deskripsi	Penanganan matakuliah
 */

require_once('config.php');
require_once('session.php');

sessionInit();

function courseGetCourseList($start, $count, $sort = 0) {
	// fungsi ini mengembalikan array yang berisi:
	//		- id instance matakuliah
	//		- nama matakuliah
	//		- tahun
	//		- semester
	//		- fakultas
	//		- prodi
	//	kalau mau dibikin kelasnya ya monggo :)
	
	// kerja fungsi ini adalah:
	//	masukkan ke array info matakuliah yang ada di database, mulai entry ke $start sebanyak $count
	//	bisa diurutkan berdasarkan kriteria tertentu melalui parameter $sort (misal $sort = 0 berarti sort by name, 1 = by tahun, dll)
	//  sort diimplementasikan belakangan saja
	
	databaseconnect();
	
	$sql = "SELECT `course`.`courseid` AS `id`, 
				   `course`.`coursecode` AS `code`,
				   `course`.`coursename` AS `name`,
				   `program`.`code` AS `program`,
				   `faculty`.`code` AS `faculty`
			FROM `course`, `program`, `faculty`
			WHERE `course`.`courseprogram` = `program`.`programid` AND
				  `program`.`facultyid` = `faculty`.`facultyid`
			ORDER BY `code` ASC";
	$result = mysql_query($sql);
	if($result) {
		$data = array();
		$n = 0;
		
		while($course = mysql_fetch_assoc($result)) {
			$data[$n]['id'] = $course['id'];
			$data[$n]['code'] = $course['code'];
			$data[$n]['name'] = $course['name'];
			$data[$n]['program'] = $course['program'];
			$data[$n]['faculty'] = $course['faculty'];
			
			$n++;
		}
		
		return $data;
	}
}

function courseGetSelectedCourseList($user, $start, $count, $sort = 0) {
	// mirip dengan courseGetCourseList
	// hanya saja fungsi ini mengembalikan daftar matakuliah yang diambil oleh user
}

?>