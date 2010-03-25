<?php
require_once('includes/databaseconnection.php');
require_once('includes/session.php');
function NewTopic()
{
	databaseconnect();
	$title = $_POST['newtopic'];
	$dummy_courseinstanceid = 13;
	$dummy_userid =12;
	mysql_select_db("tugasprogin");
	mysql_query("INSERT INTO courseinstancetopic(courseinstanceid,
													userid,
													title
													)
													VALUES
													(
													'$dummy_courseinstanceid',
													'$dummy_userid',
													'$title'
													)
													");
	databasedisconnect();
}

function ShowTopics()
{
	echo "<table><tr><th>No</th><th>Topic</th><th>Oleh</th><th>Aksi</th></tr>";
	databaseconnect();
	mysql_select_db("tugasprogin");
	$tampil="SELECT * FROM courseinstancetopic";
	$hasil = mysql_query($tampil);
	$no =1;
	while($data = mysql_fetch_array($hasil))
	{
		echo "<form method=\"POST\" action=\"discussionhandler.php\">";
		echo "<input type=hidden name=courseinstanceid value=$data[courseinstanceid]>
				<tr><td>$no</td><td><b>$data[title]</b><br>$data[subtitle]</td><td>$data[userid]</td>
				<td><input type=submit value=Delete name='deletetopic'><input type=submit value=Masuk name='masuktopic'></td>
				</tr></form>";
		$no++;
		};
	echo "</table>";
}	


function mainDiscussion()
{
	if($_POST['newtopic'])
	{
		NewTopic();
		}
	}
?>