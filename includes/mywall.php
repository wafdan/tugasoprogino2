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
	$userinfo = mysql_fetch_array($userinfo);
	$hasil = mysql_query("SELECT * FROM userwallpost WHERE userid='$wall_userid'");
	if(mysql_num_rows($hasil) > 0)
	{
		echo "<table>";
		while($data = mysql_fetch_array($hasil))
		{
			echo "<tr><td>$userinfo[username] bilang : </td><td><p>$data[content]</p></td></tr>
				<tr><td></td><td><form action=\"mywallhandler\" method=\"POST\"><input type=hidden name=wallpostid value=$data[wallpostid]> Comment : <input type=textbox name=comment></form></td></tr>";
			}		
		echo "</table>";
	}
	databasedisconnect();
}

function TerimaComment()
{
	}

function mainWall()
{
	if($_POST['content'])
	{
		TerimaPostWall();
	}elseif($_POST['comment'])
	{
		TerimaComment();
		}
}

?>