<?php

require_once('includes/session.php');
require_once('includes/mywall.php');
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
if($wall_userid = sessionGet('activeUserID'))
{
	echo	"<form action=\"mywallhandler.php\" method=\"POST\">
	Post Wall : <input type=\"textbox\" name=\"content\">
	</form>";
	}
DisplayWall($wall_userid);
?>