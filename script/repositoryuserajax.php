<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();

function ShowRepository() {
	$repo_userid = $_POST['repo_userid'];
	$activeid = sessionGet("activeUserID");
	$page = $_POST['page'];
	$limit = $_POST['limit'];
	$tampil;
	$jumlah;
	databaseconnect();
	if(sessionGet("activeUserID")== $repo_userid) {
		$tampil="SELECT * FROM userrepository WHERE userid='$repo_userid' ORDER BY category LIMIT $page,$limit";
		$jumlah="SELECT * FROM userrepository WHERE userid='$repo_userid' ORDER BY category";
	}elseif(isFollower(sessionGet("activeUserID"),$repo_userid)) {
		$tampil="SELECT * FROM userrepository WHERE userid='$repo_userid' AND status='PUBLIC' OR userid='$repo_userid' AND status='FOLLOWER' ORDER BY category LIMIT $page,$limit";
		$jumlah="SELECT * FROM userrepository WHERE userid='$repo_userid' AND status='PUBLIC' OR userid='$repo_userid' AND status='FOLLOWER' ORDER BY category";
	}
	else {
		$tampil="SELECT * FROM userrepository WHERE userid='$repo_userid' AND status='PUBLIC' ORDER BY category LIMIT $page,$limit";
		$jumlah="SELECT * FROM userrepository WHERE userid='$repo_userid' AND status='PUBLIC' ORDER BY category";
	}
	$hasil = mysql_query($tampil);
	if(mysql_num_rows($hasil) > 0) {
		echo "<div id='repolist'>
				<table><tr><th>No</th><th>Nama File</th><th>Status</th><th>Category</th><th>Counter</th><th>Aksi</th></tr>";
		$no = $page+1;
		while($data = mysql_fetch_array($hasil)) {
			//echo "<form method=\"POST\" action=\"repositoryhandler.php\">";
			echo "<input type=hidden name=repositoryid value=$data[repositoryid]>
					<input type=hidden name=filenamehash value=$data[filenamehash]>
					<tr><td class='no'>$no</td>
					<td>$data[filename]</td>";
			if(sessionGet("activeUserID")== $repo_userid) {
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
				echo "<td>			<select name=\"statusupdate\" value=$data[status] id=\"selectstatus\" onchange=\"ChangeAttributeStatusUserAjax($data[repositoryid],this.options[this.selectedIndex].value)\">
						<option value=\"PUBLIC\" $public >PUBLIC</option>
						<option value=\"FOLLOWER\" $follower >FOLLOWER</option>
						<option value=\"PRIVATE\" $private >PRIVATE</option>
						</select></td>
						<td><input id=\"selectcategory\" name=\"categoryupdate\" type=\"textbox\" value=$data[category] onchange=\"ChangeAttributeCategoryUserAjax($data[repositoryid],this.value)\"></td>";
			}else{
				echo "<td>$data[status]</td>
					<td>$data[category]</td>";}
			echo "<td class='count'>$data[counter]</td><td>";
			if(sessionGet("activeUserID")== $repo_userid) {
				echo "<button type=button onclick=\"DeleteRepoUserAjax( $data[repositoryid] ,'$data[filenamehash]',$activeid );\">Delete</button>";
				echo "<button type=button onclick=\"ChangeAvatarUserAjax('$data[filenamehash]');\">Use as Avatar</button>";
			}
			echo "<button type=button onclick=\"DownloadRepoUserAjax('$data[filenamehash]',$data[repositoryid],$data[counter]);\">Download</button>";
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
				echo "<button type=button onclick=\"ShowRepoUserAjax($activeid, $dest, $limit)\">";
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
		echo "</div>";
	}
	else {
		echo "<div id='repolist'>Repository Kosong!</div>";
	}
}
ShowRepository();
?>