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

function generateCourseList() {
	$data = courseGetCourseList(0, 0, 0);

	echo '<h2>Courses List</h2>';
	echo '<ul>';
	foreach($data as $course) {
		echo '<li><a href="courses.php?courseid='.$course['id'].'">'.$course['faculty'].' - '.$course['program'].' - ['.$course['code'].'] '.$course['name'].'</li>';
	}
	echo '</ul>';
}

function generateCourseInstanceList() {
	$data = courseGetCourseInstanceList();
	
	echo '<h2>Courses List</h2>';
	echo '<ul>';
	foreach($data as $course) {
		echo '<li><a href="courses.php?courseid='.$course['courseinstanceid'].'">'.$course['faculty'].' - '.$course['program'].' - ['.$course['code'].'] '.$course['name'].' ('.$course['year'].' semester '.$course['semester'].')</li>';
	}
	echo '</ul>';
}

function generateUserList()
{
	databaseconnect();
	$pageuserid = sessionGet('activeUserID');
	$result = mysql_query("SELECT * FROM user WHERE NOT userid='$pageuserid'");
	if(mysql_num_rows($result)>0)
	{
		echo '<h2>User List</h2>';
		echo '<ul>';
		while($datauser=mysql_fetch_array($result))
		{
			echo '<li><a href="profile.php?userid='.$datauser['userid'].'">'.$datauser['username'].' - '.$datauser['fullname'].'</li>';
			}
		echo '</ul>';
		}
	databasedisconnect();
	}

?>

<html>
    <head>
        <title>Home</title>
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/style1.css" />
    </head>

    <body>
		<div id="chatcontainer">
			aefhaksdhflaksdhfk
		</div>
		
        <div id="header">
            <div id="logo">
                <h1>KulOn&trade;</h1>
                <h2><b>Kuliah Online</b></h2>
            </div>
            <?php
            if(sessionGet('activeUserID')) {
                ?>
                <div id="menu">
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li class="first">
                            <a href="profile.php">Profile</a>
                        </li>
                        <li>
                            <a href="publicwall.php">Public Wall</a>
                        </li>
                        <li>
                            <a href="repository.php">Repository</a>
                        </li>
                        <li>
                            <a href="courses.php">Kuliah</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            
            <div id="loginstatus">Selamat datang, <?php echo sessionGet('activeFullname'); ?>
                <?php
                if(sessionGet('activeRole') == 'ADMIN') {
					?>
            	<a href="administrator.php">Administrator Page</a>
			</div>
        </div>
        <div id="container">
					<?php
                }

                /**/
                $userido = sessionGet('activeUserID');
                databaseconnect();
                $resulto = mysql_query("SELECT coursecode,coursename,year,semester
                              FROM course,courseinstance,courseinstancefollowing
                              WHERE userid =.'$userido'.");
                if($resulto){?>
                <div>
                    <ul>
                        <li>

                        </li>
                    </ul>
                </div>
                <?php
                }
                databasedisconnect();
                /**/
                ?>
	<?php generateCourseInstanceList(); 
				generateUserList();?>
            </div>
            <?php } else {?>
            <div id="container">
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
            </div>
                <?php
            }
            ?>
		<div id="footer">
            <p class="legal"><i>Copyright</i> &copy; 2010 KulOn&trade;. <i>All rights reserved</i>. </p>
        </div>
		
		</div>
    </body>
    
</html>