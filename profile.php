<?php
require_once("includes/mywall.php");
sessionInit();
if(!sessionGet('activeUserID')) {
    header("Location: index.php");
}else {
    $wall_userid;
    if($_GET['userid']) {
        $wall_userid = $_GET['userid'];
    }else {
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
        <title>KulOn&trade;</title>
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/styleprofile1.css" />
        <script type="text/javascript" src="script/script.js"></script>
        <script type="text/javascript" src="script/mywall.js"></script>
		<script type="text/javascript" src="script/profile.js"></script>
    </head>
    <body>
        <div id="toplevel">
            <div id="header">
                <div id="logo">
                    <h1>KulOn&trade;</h1>
                    <h2><b>Kuliah Online</b></h2>
                </div>      
                <div id="menu">
                    <ul>
                        <li>
                            <a href="index.php">Home</a>                        </li>
                        <li class="first">
                            <a<?php echo " href=profile.php?userid=$wall_userid"; ?>>Profile</a>
                        </li>
                        <li>
                            <a<?php echo " href=publicwall.php?userid=$wall_userid"; ?>>Public Wall</a>
                        </li>
                        <li>
                            <a<?php echo " href=repository.php?userid=$wall_userid"; ?>>Repository</a>
                        </li>
                        <li>
                            <a href="courses.php">Kuliah</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <div id="menu2">
                    <ul>
                        <li>
                            <a href="#" onclick="<?php echo "showNotif({$wall_userid})";?>">Notifikasi</a>
                        </li>
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
                        <?php

                        if (!($wall_userid==sessionGet("activeUserID"))) {
                            databaseconnect();
                            $activeuserid =sessionGet("activeUserID");
                            $result = mysql_query("SELECT * FROM userfollowing WHERE targetuserid='$wall_userid' AND userid='$activeuserid'");
                            databasedisconnect();
                            if(mysql_num_rows($result)==0) {
		echo "<button type=\"button\" name=\"followuser\" onclick=\"FollowUserAjax($wall_userid)\">Follow this user</button>";
                            }
                        };
                        ?>

                        <li id="friends">
                            <h2><a href="javascript:nothingHappens();">Follower</a></h2>
                            <ul>
                                <?php
                                databaseconnect();
                                $friendresult = mysql_query("SELECT * FROM userfollowing WHERE targetuserid='$wall_userid'");
                                while($datafriend=mysql_fetch_array($friendresult)) {
                                    $userfriend = mysql_query("SELECT * FROM user WHERE userid='$datafriend[userid]'");
                                    $userfriend = mysql_fetch_array($userfriend );
                                    echo "<li> <a class=\"friendName\" href=\"profile.php?userid=$datafriend[userid]\">$userfriend[fullname]</a>";
                                };
                                ?>
                            </ul>
                        </li>
                        <li id="friends">
                            <h2><a href="javascript:nothingHappens();">Course(s) Followed</a></h2>
                            <ul>
                                <?php
                                $cres = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid={$wall_userid}");
                                while($datac = mysql_fetch_array($cres)) {
                                    $cins = mysql_query("SELECT * FROM courseinstance WHERE courseinstanceid={$datac['courseinstanceid']}");
                                    $courseid = $cins['courseid'];
                                    $cname = mysql_query("SELECT * FROM course WHERE courseid={$courseid}");
                                    echo "<li>{$cname}</li>";
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div id="notifications">
                    
                </div>
                <fieldset class="profile-status">
                    <legend><span>My Wall</span></legend>
					
                    <?php
                    if($wall_userid == sessionGet('activeUserID')) {
	echo	"<b>Post Wall : </b><input type=\"textbox\" name=\"content\" size=70 onKeyPress=\"if(enter_pressed(event)){ PostWallUserAjax(this.value,$wall_userid)}\">";
                    }
					?>
					                    <div id="wallusershow">
					</div>
				<script type="text/javascript">
                <?php
				echo "var userid = $wall_userid;";
				?>
				var page = 0;
				var limit = 5;
				ShowMyWallUserAjax(userid,page,limit)
				</script>
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
                            <div class="info">: <?php if($data['gender']=='M') {
                                    echo "Laki-laki";
                                }else {
                                    echo "Wanita";
                                };?></div>
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
                <p class="legal"><i>Copyright</i> &copy; 2010 KulOn&trade;. <i>All rights reserved</i>. </p>
            </div>
        </div>
    </body>
</html>