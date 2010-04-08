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
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/styleprofile1.css" />
		<script type="text/javascript" src="script/mywall.js"></script>
	</head>
    <body>
        <div id="header">
            <div id="logo">
                <h1>KulOn&trade;</h1>
                <h2><b>Kuliah Online</b></h2>
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
            <fieldset class="profile-status">
                <?php
                databaseconnect();
                $cname = mysql_query("SELECT * FROM course WHERE courseid={$courseid}");
                $cname2 = $cname['coursename'];
                echo "<h1>Kuliah  {$cname2}</h1>";
                databaseconnect();
                $userid =sessionGet("activeUserID");
                $isfollow = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$userid' AND courseinstanceid='$courseid'");
                $ismanager = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$userid' AND courseinstanceid='$courseid'");
                if((mysql_num_rows($isfollow)>0)||(mysql_num_rows($ismanager)>0)) {
	echo	"<b>Post Wall : </b><input type=\"textbox\" name=\"content\" size=70 onKeyPress=\"if(enter_pressed(event)){ PostWallCourseAjax(this.value,$courseid)}\">";
}else {
	echo "<form action=\"mywallhandler.php\" method=\"POST\">
			<input name=\"followcourse\" type=\"submit\" value=\"Follow this course\">
			<input name=\"pagecourseid\" type=\"hidden\" value=$courseid>
			</form>";
};
                databasedisconnect();
                ?>
					                    <div id="wallcourseshow">
					</div>
				<script type="text/javascript">
                <?php
				echo "var userid = $courseid;";
				?>
				var page = 0;
				var limit = 5;
				ShowMyWallCourseAjax(userid,page,limit)
				</script>
                
            </fieldset>
        </div>
        <div id="footer">
            <p class="legal"><i>Copyright</i> &copy; 2010 KulOn&trade;. <i>All rights reserved</i>. </p>
            <p class="credit"><i>Designed by : </i> <a>Andika Pratama</a>, <a>Adityo Jiwandono </a>, <a>Wafdan Musa Nursakti</a></p>
        </div>
    </body>
</html>