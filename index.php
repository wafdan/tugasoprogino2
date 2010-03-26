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
	
	echo '<ul>';
	foreach($data as $course) {
		echo '<li><a href="courses.php?courseid='.$course['id'].'">'.$course['faculty'].' - '.$course['program'].' - '.$course['name'].'</li>';
	}
	echo '</ul>';
}

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
            <?php echo '</div>'; ?>
            <div id="loginstatus">Selamat datang, <?php echo sessionGet('activeFullname'); ?>
                <?php

                if(sessionGet('activeRole') == 'ADMIN') {?>
            	<a href="administrator.php">Administrator Page</a></div>
            <div id="container">
                <?php

                if(sessionGet('activeRole') == 'ADMIN') {
					?>
            	<a href="administrator.php">Administrator Page</a>
			</div>
					<?php
                }
                
                /**/
                $userido = sessionGet('activeUserID');
                databaseconnect();
//                $resulto = mysql_query("SELECT coursecode,coursename,year,semester
//                              FROM course,courseinstance,courseinstancefollowing
//                              WHERE userid =.'$userido'.");
                  $query = "SELECT *
                            FROM course JOIN courseinstance;";
                $rs = mysql_query($query);
		while($data = mysql_fetch_array($rs)) {
                    $cid = $data['courseinstanceid'];
                    echo "<div class='course-list'>Course";
                    echo "<ul>";
                    echo "<li><a href='courses.php?courseid={$cid}'>
                          <b>{$data['coursecode']} : </b>
                          {$data['coursename']}, Tahun : 
                          {$data['year']}, Semester : 
                          {$data['semester']}
                          </a>
                          </li>";
                    echo "</ul>";
                    echo "</div>";
		}
		?>
            </div>
                <?php
                databasedisconnect();
                /**/
                
            } else {?>
            
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
			<div>
				<?php generateCourseList(); ?>
			</div>
        </div>
		<div id="footer">
            <p class="legal"><i>Copyright</i> &copy; 2010 Konco&trade;. <i>All rights reserved</i>. </p>
        </div>
    </body>
</html>