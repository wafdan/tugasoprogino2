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
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/style1.css" />
    </head>

    <body>
        <div id="header">
            <div id="logo">
                <h1>Konco&trade;</h1>
                <h2><b>Connecting People</b></h2>
            </div>
        </div>
        <div>
            <?php
            if(sessionGet('activeUserID')) {
                ?>
		Selamat datang, <?php echo sessionGet('activeFullname'); ?> <a href="logout.php">[logout]</a>
                <?php
                if(sessionGet('activeRole') == 'ADMIN') {
                    ?>
            <a href="administrator.php">Administrator Page</a>
                    <?php
                }
            } else {
                ?>
            <div id="loginform">
			Login
                <form action="loginhandler.php" method="post">
                    <p>
                        Username
                        <input id="input-username" type="text" name="data[login][username]" />
                    </p>
                    <p>
                        Password
                        <input id="input-password" type="password" name="data[login][password]" />
                    </p>
                    <p>
                        <input name="LoginButton" type="submit" id="LoginButton" value="Login" />
                    </p>
                </form>
                <a href="#">Lupa password</a> | <a href="register.php">Daftar</a>
            </div>
                <?php
            }
            ?>
        </div>
        <div id="footer">
            <p class="legal"><i>Copyright</i> &copy; 2010 Konco&trade;. <i>All rights reserved</i>. </p>
            <p class="credit"><i>Designed by : </i> <a>Andika Pratama</a>, <a>Anggrahita Bayu Sasmita</a>, <a>Alvin Andhika Zulen</a></p>
        </div>
    </body>
</html>