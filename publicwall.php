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
        <script type="text/javascript" src="script/pubwall.js"></script>
    </head>
    <body onload="<?php echo "showEntirely({$wall_userid})";?>">
        <div id="toplevel">
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
                            <a href=profile.php?userid=<?php echo $wall_userid; ?>>Profile</a>
                        </li>
                        <li>
                            <a href=publicwall.php?userid=<?php echo $wall_userid; ?>>Public Wall</a>
                        </li>
                        <li>
                            <a href=repository.php?userid=<?php echo $wall_userid; ?>>Repository</a>
                        </li>
                        <li>
                            <a href=courses.php>Kuliah</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <div id="menu2">
                    <ul>
                        <li>
                            <a href="#" onclick="<?php echo "showWallordertime({$wall_userid})";?>">Terbaru</a>
                        </li>
                        <li>
                            <a href="#" onclick="<?php echo "showWallorderpop({$wall_userid})";?>">Terpopuler</a>
                        </li>
                    </ul>
                </div>
            </div><hr />
            <div id="container">
                <div id ="sidebar">
                    <ul>
                        <li id="profile">
                            FOTO
                        </li>
                        <li id="friends">
                            TEMAN
                        </li>
                    </ul>
                </div>
                <div id="wallcontent">
                    ISI WALL
                </div>
                
                <br />
                <fieldset class="information" id="information">
                    INFORMASI
                </fieldset>
            </div>
            <div id="footer">
                <p class="legal"><i>Copyright</i> &copy; 2010 KulOn&trade;. <i>All rights reserved</i>. </p>
            </div>
        </div>
    </body>
</html>