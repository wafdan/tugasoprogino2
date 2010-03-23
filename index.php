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

<html>
	<head>
		<title>Home</title>
	</head>
	
	<body>
		<div>
			<?php
			
			if(sessionGet('activeUserID')) {
				?>
			Login
			<form action="loginhandler.php" method="post">
				Username
				<input type="text" name="data[login][username]" />
				Password
				<input type="password" name="data[login][password]" />
				<input type="submit" value="Login" />
			</form>
				<?php
			} else {
			?>
			Selamat datang, <?php echo sessionGet('activeFullname'); ?>
				<?php
			}
			?>
		</div>
	</body>
</html>