<?php
require_once("includes/mywall.php");
sessionInit();
if(!sessionGet('activeUserID'))
{
	header("Location: index.php");
}else{
	$wall_userid;
	if($_GET['userid'])
	{
		$wall_userid = $_GET['userid'];
	}else
	{
		$wall_userid = sessionGet('activeUserID');
	}
}
?>
<?php
databaseconnect();
$result = mysql_query("SELECT * FROM user WHERE userid='$wall_userid'");
$data = mysql_fetch_array($result);
databasedisconnect();
				?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Konco&trade;</title>
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/styleprofile1.css" />
        <script type="text/javascript" src="script/script.js"></script>
    </head>
    <body>
        <div id="toplevel">
            <div id="header">
                <div id="logo">
                    <h1>Konco&trade;</h1>
                    <h2><b>Connecting People</b></h2>
                </div>      
                <div id="menu">
                    <ul>
                        <li>
                            <a href="index.php">Home</a>                        </li>
                  <li class="first">
                            <?php echo "<a href=profile.php?userid=$wall_userid"; ?>>Profile</a>
                        </li>
                        <li>
                            <?php echo "<a href=publicwall.php?userid=$wall_userid"; ?>>Public Wall</a>
                        </li>
                        <li>
                            <?php echo "<a href=repository.php?userid=$wall_userid"; ?>>Repository</a>
                        </li>
                        <li>
                            <?php echo "<a href=courses.php"; ?>>Kuliah</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>                        </li>
                  </ul>
                </div>
            </div><hr />
            <div id="container">
                <div id ="sidebar">
                    <ul>
                        <li id="profile">
                            <h2><?php echo "<a href=profile.php?userid=$wall_userid>$data[fullname]</a>"; ?></h2>
<?php
$avatar = $data['avatar'];
echo "<img id=\"primary-photo\" src=\"repositoryfiles/$avatar\" alt=\"Picture not Found\" />";
							?>
                            
                        </li>

                        <li id="friends">
                            <h2><a href="javascript:nothingHappens();">Follower</a></h2>
                            <ul>
							<?php 
							databaseconnect();
							$friendresult = mysql_query("SELECT * FROM userfollowing WHERE targetuserid='$wall_userid'");
while($datafriend=mysql_fetch_array($friendresult))
{
	$userfriend = mysql_query("SELECT * FROM user WHERE userid='$datafriend[userid]'");
	$userfriend = mysql_fetch_array($userfriend );
	echo "<li> <a class=\"friendName\" href=\"profile.php?userid=$datafriend[userid]\">$userfriend[fullname]</a>";
	};
							?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <fieldset class="profile-status">
                    <legend><span>Public Wall</span></legend>
<?php
databaseconnect();
$resultcourse = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$wall_userid'");
$resultmanager = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$wall_userid'");

if((mysql_num_rows($resultcourse)>0)||(mysql_num_rows($resultmanager)>0))
{
	echo "<ul>";
	while($datacourse=mysql_fetch_array($resultcourse))
	{
		$getcourse = mysql_query("SELECT * FROM courseinstance WHERE courseinstanceid='$datacourse[courseinstanceid]'");
		$getcourse = mysql_fetch_array($getcourse);
		$course = mysql_query("SELECT * FROM course WHERE courseid='$getcourse[courseid]'");
		$course = mysql_fetch_array($course);
		echo  "<li>";
		echo "<div class=\"label\">$course[coursecode]</div>";
		echo "<div class=\"info\">:$course[coursename] <a href=\"courses.php?courseid=$getcourse[courseinstanceid]\">Link<a/></div>";
		echo "</li>";
		DisplayCoursesWall($datacourse[courseinstanceid],false);
	};
	echo "</ul";
}
databasedisconnect();
?>
                </fieldset>
                <br />
                <fieldset class="information">
                    <legend><span>Informasi</span></legend>
                    <ul>
                        <li>
                            <div class="label">Nama</div>
                            <div class="info">: <?php echo $data['fullname'];?></div>
                        </li>
                        <li>
                            <div class="label">Tanggal Lahir</div>
                            <div class="info">: <?php echo $data['birthdate'];?></div>
                        </li>
                        <li>
                            <div class="label">Jenis Kelamin</div>
                            <div class="info">: <?php if($data['gender']=='M'){ echo "Laki-laki";}else{echo "Wanita";};?></div>
                        </li>
                        <li>
                            <div class="label">Nomor Telepon</div>
                            <div class="info">:<?php echo $data['telephone'];?></div>
                        </li>
                        <li>
                            <div class="label">Email</div>
                            <div class="info">: <?php echo $data['email'];?></div>
                        </li>
                        <li>
                            <div class="label">Alamat</div>
                            <div class="info">: <?php echo $data['address'];?></div>
                        </li>
                    </ul>
                </fieldset>
            </div>
            <div id="footer">
                <p class="legal"><i>Copyright</i> &copy; 2010 Konco&trade;. <i>All rights reserved</i>. </p>
            </div>
        </div>
    </body>
</html>