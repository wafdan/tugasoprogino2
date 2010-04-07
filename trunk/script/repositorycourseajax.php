<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();

function ShowCoursesRepository() {
	$courseid = $_POST['courseid'];
	$tampil;
	$ismanager =false;
	$userid =sessionGet("activeUserID");
	$page = $_POST['page'];
	$limit = $_POST['limit'];
	$jumlah;
	databaseconnect();
	$checkuser = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$userid' AND courseinstanceid='$courseid'");
	$checkfollow = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$userid' AND courseinstanceid='$courseid'");
	if(mysql_num_rows($checkuser)>0) {
		$ismanager = true;
		$tampil="SELECT * FROM courseinstancerepository WHERE courseinstanceid='$courseid' ORDER BY category LIMIT $page,$limit";
		$jumlah="SELECT * FROM courseinstancerepository WHERE courseinstanceid='$courseid' ORDER BY category";
	}elseif(mysql_num_rows($checkfollow)>0) {		
		$tampil="SELECT * FROM courseinstancerepository WHERE courseinstanceid='$courseid' AND status='PUBLIC' OR courseinstanceid='$courseid' AND status='FOLLOWER'  ORDER BY category LIMIT $page,$limit";
		$jumlah="SELECT * FROM courseinstancerepository WHERE courseinstanceid='$courseid' AND status='PUBLIC' OR courseinstanceid='$courseid' AND status='FOLLOWER'  ORDER BY category";
	}
	else {
		$tampil="SELECT * FROM courseinstancerepository WHERE courseinstanceid='$courseid' AND status='PUBLIC' ORDER BY category LIMIT $page,$limit";
		$jumlah="SELECT * FROM courseinstancerepository WHERE courseinstanceid='$courseid' AND status='PUBLIC' ORDER BY category";
	}
	$hasil = mysql_query($tampil);
	if(mysql_num_rows($hasil) > 0) {
		echo "<div id='repolist'>
				<table><tr><th>No</th><th>Nama File</th><th>Status</th><th>Category</th><th>Counter</th><th>Aksi</th></tr>";
		$no =1;
		while($data = mysql_fetch_array($hasil)) {
			//echo "<form method=\"POST\" action=\"repositoryhandler.php\">";
			echo "<input type=hidden name=isrepository value=1>
					<input type=hidden name=repositoryid value=$data[repositoryid]>
					<input type=hidden name=filenamehash value=$data[filenamehash]>
					<tr><td class='no'>$no</td>
					<td>$data[filename]</td>";
					if($ismanager) {
				$public='';
				$follower='';
				$private='';
				if($data[status]=='PUBLIC')
				{
					$public='SELECTED';
				}elseif($data[status]=='FOLLOWER')
				{
					$follower='SELECTED';
				}elseif($data[status]=='PRIVATE')
				{
					$private='SELECTED';
					}
				echo "<td>			<select name=\"statusupdate\" value=$data[status] onchange=\"ChangeAttributeStatusCourseAjax($data[repositoryid],this.options[this.selectedIndex].value)\">
						<option value=\"PUBLIC\" $public >PUBLIC</option>
						<option value=\"FOLLOWER\" $follower >FOLLOWER</option>
						<option value=\"PRIVATE\" $private >PRIVATE</option>
						</select></td>
						<td><input name=\"categoryupdate\" type=\"textbox\" value=$data[category] onchange=\"ChangeAttributeCategoryCourseAjax($data[repositoryid],this.value)\"></td>";
						}else{
                    echo "<td>$data[status]</td>
					<td>$data[category]</td>";}
					echo "<td class='count'>$data[counter]</td><td>";
			if($ismanager) {
				echo "<button type=button onclick=\"DeleteRepoCourseAjax( $data[repositoryid] ,'$data[filenamehash]',$userid );\">Delete</button>";
				}
			echo "<button type=button onclick=\"DownloadRepoCourseAjax('$data[filenamehash]',$data[repositoryid],$data[counter]);\">Download</button>";
			echo "</td>
					</tr>";
			//echo "</form>";
			$no++;
		};
		echo "</table>";
		//paginasi
		$jumlahhasil = mysql_query($jumlah);
		$jumlahhasil = mysql_num_rows($jumlahhasil);
		$jumlahhalaman = ceil($jumlahhasil/$limit);
		if($jumlahhalaman>1)
		{
			for($i=1;$i<=$jumlahhalaman;$i++)
			{
				$dest = ($i-1)*$limit;
				echo "<button type=button onclick=\"ShowRepoCourseAjax($activeid, $dest, $limit)\">";
				if($dest==$page)
				{
					echo "<b>$i</b>";
				}
				else{
					echo $i;
				}
				echo "</button>";
				echo " ";
			}
		}
		//
		echo "</div>";
	}
	else {
		echo "<div id='repolist'>Repository Kosong!</div>";
	}
}

ShowCoursesRepository();
?>