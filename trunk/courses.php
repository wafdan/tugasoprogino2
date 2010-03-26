<?php
require_once("includes/session.php");
require_once("includes/mywall.php");
sessionInit();
//sessionSet("activeUserID",135);
if(!sessionGet("activeUserID")) {
    header("Location: index.php");
}
$courseid = $_GET['courseid'];
if(!$courseid) {
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
                        <a href="courses.php">Profile</a>
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
                        <a href="discussion.php?courseinstanceid=<?php echo $courseid; ?>">Forum Diskusi Kuliah</a>
                    </li>
                    <li>    
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>

        </div>
        <div id="container">
            <div>
                <?php
                databaseconnect();
                $userid =sessionGet("activeUserID");
                $isfollow = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$userid' AND courseinstanceid='$courseid'");
                $ismanager = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$userid' AND courseinstanceid='$courseid'");
                if((mysql_num_rows($isfollow)>0)||(mysql_num_rows($ismanager)>0)) {
                    echo	"<form action=\"mywallhandler.php\" method=\"POST\">
			<input type=hidden name=\"pagecourseid\" value=$courseid>
			<b>Post Wall : </b><input type=\"textbox\" name=\"coursecontent\" size=70>
			</form>";
                }else {
                    echo "<form action=\"mywallhandler.php\" method=\"POST\">
                  <input name=\"followcourse\" type=\"submit\" value=\"Follow this course\">
			<input name=\"pagecourseid\" type=\"hidden\" value=$courseid>
						</form>";
                }
                databasedisconnect();
                DisplayCoursesWall($courseid,true);
                ?>
            </div>
        </div>
        <div id="footer">
            <p class="legal"><i>Copyright</i> &copy; 2010 Konco&trade;. <i>All rights reserved</i>. </p>
            <p class="credit"><i>Designed by : </i> <a>Andika Pratama</a>, <a>Adityo Jiwandono </a>, <a>Wafdan Musa Nursakti</a></p>
        </div>
    </body>
</html>