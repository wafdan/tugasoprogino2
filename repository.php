<?php
require_once("includes/session.php");
require_once("includes/repository.php");
sessionInit();
//sessionSet("activeUserID",135);
if(!sessionGet("activeUserID"))
{
	header("Location: index.php");
}
?>
<html>
    <head>
<style type="text/css">
table, td, th
{
border:1px solid green;
}
th
{
background-color:green;
color:white;
}
</style>
    </head>
<body>
<div>
<?php
$repo_userid = $_GET['userid'];
if(!$repo_userid)
{
	$repo_userid = sessionGet("activeUserID");
	}
ShowRepository($repo_userid);
?>
</div>

<?php
// form upload
//echo sessionGet("activeUserID");
if(sessionGet("activeUserID")== $repo_userid)
{
	echo
			"
			<div>
			<h1>Upload File!</h1>
			<form enctype=\"multipart/form-data\" method=\"POST\" action=\"repositoryhandler.php\">
			File yang diupload : <input type=\"file\" name=\"fupload\">
			<select name=\"status\">
			<option value=\"PUBLIC\">PUBLIC</option>
			<option value=\"FOLLOWER\">FOLLOWER</option>
			<option value=\"PRIVATE\">PRIVATE</option>
			</select>
			<input type=\"submit\" name=\"uploadfileuser\" value=\"Upload\">
			</form>
			</div>
			</body>
			</html>";
}	
?>
