<?php

/*
	File		course.php
	Deskripsi	Penanganan matakuliah
 */

require_once('config.php');
require_once('session.php');

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
}

function courseGetSelectedCourseList($user, $start, $count, $sort = 0) {
	// mirip dengan courseGetCourseList
	// hanya saja fungsi ini mengembalikan daftar matakuliah yang diambil oleh user
}

?>