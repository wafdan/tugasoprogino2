<?php

/*
	File		index.php
	Deskripsi	Halaman utama (home)
 */

require_once("includes/session.php");
require_once("includes/auth.php");
require_once("includes/course.php");

sessionInit();

/*
 */

/*
	Periksa status otentikasi user (apakah sudah login apa belum)
	kemudian tampilkan konten sesuai status login dan rolenya.

	Ada menu "Home", "Register", "Profile", "Courses", "Logout"
	Menu "Profile", "Courses", "Logout" hanya muncul jika user sudah login
	Menu "Register" hanya muncul saat user belum login
	
	Belum login:
		Tampilkan kotak login
		Tampilkan daftar matakuliah
	Sudah login:
		User biasa (mahasiswa):
			Tampilkan daftar matakuliah yang ditangani
			Tampilkan daftar matakuliah yang diambil
			Tampilkan daftar matakuliah
		Admin:
			Tampilkan daftar matakuliah
			Tampilkan menu manajemen/admin
	
	Form pada kotak login di-POST ke loginhandler.php
 */


?>