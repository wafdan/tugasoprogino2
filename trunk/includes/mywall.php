<?php
require_once("databaseconnection.php");
require_once("session.php");
sessionInit();
function TerimaPostWall()
{
	$content = $_POST['content'];
	$userid = sessionGet('activeUserID');
	databaseconnect();
	$now = date('Y-m-d H:i:s');
	mysql_query
	(
		"INSERT INTO userwallpost(userid,
								content,
								timestamp)
						VALUES(
							'$userid',
							'$content',
							'$now')
		"
		);
	databasedisconnect();
}

function DisplayWall($wall_userid)
{
	databaseconnect();
	$userid = sessionGet("activeUserID");
	$userinfo = mysql_query("SELECT * FROM user WHERE userid='$userid'");
	$hasil = mysql_query("SELECT * FROM userwallpost WHERE userid='$wall_userid'");
	if(mysql_num_rows($hasil) > 0)
	{
		echo "<table>";
		while($data = mysql_fetch_array($hasil))
		{
			echo "<td><tr>$userinfo[username] bilang : </tr><tr>$data[content]</tr></td><td><tr></tr><br><tr><form action=\"mywallhandler\" method=\"POST\">Comment : <input type=textbox value=Comment name=comment></form></tr></td>";
			}		
		echo "</table>";
	}
	databasedisconnect();
}

function mainWall()
{
	if($_POST['content'])
	{
		TerimaPostWall();
	}
}

?>