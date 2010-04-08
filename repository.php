<?php
require_once("includes/session.php");
require_once("includes/repository.php");
sessionInit();
//sessionSet("activeUserID",135);
if(!sessionGet("activeUserID")) {
    header("Location: index.php");
}

$repo_userid = $_GET['userid'];
if(!$repo_userid) {
    $repo_userid = sessionGet("activeUserID");
}
?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/style1.css" />
        <script type="text/javascript" src="script/repository.js"></script>
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
                        <a href="profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="publicwall.php">Public Wall</a>
                    </li>
                    <li>
                        <a href="repository.php">Repository</a></li>
                    <li> </li>
                    <li>
                        <a href="courses.php">Kuliah</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <script type="text/javascript">
            </script>

            <div id ="reposhow">
                <script type="text/javascript">
                            <?php
                            echo "var userid = $repo_userid;";
                            ?>
                            var page = 0;
                            var limit = 10;
                            ShowRepoUserAjax(userid,page,limit)
                </script>
            </div>
        </div>
        <div id="container">

            <?php
// form upload
//echo sessionGet("activeUserID");
            if(sessionGet("activeUserID")== $repo_userid) {
                echo "<h2>Upload File</h2>";
                echo
                "
			<div>
			<form enctype=\"multipart/form-data\" method=\"POST\" action=\"repositoryhandler.php\" target=\"upload_target\">
			Pilih file yang diupload : <input type=\"file\" name=\"fupload\">
			<select name=\"status\">
			<option value=\"PUBLIC\">PUBLIC</option>
			<option value=\"FOLLOWER\">FOLLOWER</option>
			<option value=\"PRIVATE\">PRIVATE</option>
			</select>
			Kategori : <input type=\"textbox\" name=\"chosencategory\" value=\"Uncategorized\">
			<input type=\"submit\" name=\"uploadfileuser\" value=\"Upload\" onclick=\"ShowRepoUserAjax($repo_userid,0,10)\">
			</form>
			<iframe id=\"upload_target\" name=\"upload_target\" src=\"\" style=\"width:0;height:0;border:0px solid #fff;\"></iframe>
                        </div>
                ";
            }
            ?>
        </div>
        <div id="footer">
            <p class="legal"><i>Copyright</i> &copy; 2010 KulOn&trade;. <i>All rights reserved</i>. </p>
        </div>
    </body>
</html>