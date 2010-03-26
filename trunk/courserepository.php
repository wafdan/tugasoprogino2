<?php
require_once("includes/session.php");
require_once("includes/repository.php");
sessionInit();
//sessionSet("activeUserID",135);
if(!$_GET['coursesid'])
{
	header("Location: index.php");
}
$courseid = $_GET['coursesid'];
if(!sessionGet("activeUserID")) {
    header("Location: index.php");
}
?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/style1.css" />
    </head>
    <body>
        <div id="header">
            <div id="logo">
                <h1>Konco&trade;</h1>
                <h2><b>Connecting People</b></h2>
            </div>      
            <div id="menu">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="first">
                        <a href="profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="repository.php">Repository</a>
                    </li>
                    <li>
                        <a href="courses.php">Kuliah</a>
                    </li>
                    <li>
                        <a href="courserepository.php?coursesid=<?php echo $courseid; ?>">Repository Kuliah</a>
                    </li>
                    <li>
                        <a href="#">Forum Diskusi Kuliah</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
              </ul>
          </div>
            <div>
                <?php
                
				ShowCoursesRepository($courseid);
                ?>
            </div>
        </div>
        <div id="container">

            <?php
// form upload
//echo sessionGet("activeUserID");
databaseconnect();
$userid = sessionGet('activeUserID');
$checkuser = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$userid' AND courseinstanceid='$courseid'");
if(mysql_num_rows($checkuser)>0) {
			echo "<h2>Upload File</h2>";
                echo
                "
			<div>
			<form enctype=\"multipart/form-data\" method=\"POST\" action=\"repositoryhandler.php\">
			<input type=hidden name=isrepository value=1>
			<input type=hidden name=repocourseid value=$courseid>
			Pilih file yang diupload : <input type=\"file\" name=\"fupload\">
			<select name=\"status\">
			<option value=\"PUBLIC\">PUBLIC</option>
			<option value=\"FOLLOWER\">FOLLOWER</option>
			<option value=\"PRIVATE\">PRIVATE</option>
			</select>
			Kategori : <input type=\"textbox\" name=\"chosencategory\" value=\"Uncategorized\">
			<input type=\"submit\" name=\"uploadfileuser\" value=\"Upload\">
			</form>
                        </div>
			";
            }
databasedisconnect();
            ?>
        </div>
      	<div id="footer">
            <p class="legal"><i>Copyright</i> &copy; 2010 Konco&trade;. <i>All rights reserved</i>. </p>
            <p class="credit"><i>Designed by : </i> <a>Andika Pratama</a>, <a>Anggrahita Bayu Sasmita</a>, <a>Alvin Andhika Zulen</a></p>
        </div>
    </body>
</html>