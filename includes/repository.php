<?php
require_once("databaseconnection.php");
require_once("session.php");
sessionInit();

function ShowRepository($repo_userid) {
    $tampil;
    databaseconnect();
    if(sessionGet("activeUserID")== $repo_userid) {
		$tampil="SELECT * FROM userrepository WHERE userid='$repo_userid' ORDER BY category";
    }elseif(isFollower(sessionGet("activeUserID"),$repo_userid)) {
		$tampil="SELECT * FROM userrepository WHERE userid='$repo_userid' AND status='PUBLIC' OR userid='$repo_userid' AND status='FOLLOWER' ORDER BY category";
    }
    else {
		$tampil="SELECT * FROM userrepository WHERE userid='$repo_userid' AND status='PUBLIC' ORDER BY category";
    }
    $hasil = mysql_query($tampil);
    if(mysql_num_rows($hasil) > 0) {
		echo "<div id='repolist'>
				<table><tr><th>No</th><th>Nama File</th><th>Status</th><th>Category</th><th>Counter</th><th>Aksi</th></tr>";
        $no =1;
        while($data = mysql_fetch_array($hasil)) {
            echo "<form method=\"POST\" action=\"repositoryhandler.php\">";
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
				echo "<td>			<select name=\"statusupdate\" value=$data[status]>
						<option value=\"PUBLIC\" $public >PUBLIC</option>
						<option value=\"FOLLOWER\" $follower >FOLLOWER</option>
						<option value=\"PRIVATE\" $private >PRIVATE</option>
						</select></td>
						<td><input name=\"categoryupdate\" type=\"textbox\" value=$data[category]></td>";
			}else{
                    echo "<td>$data[status]</td>
					<td>$data[category]</td>";}
					echo "<td class='count'>$data[counter]</td><td>";
            if(sessionGet("activeUserID")== $repo_userid) {
                echo "<input class='repobutton' type=submit value=Delete name='deletefileuser'>";
				echo "<input class='repobutton' type=hidden value=$repo_userid name='pageuserid'>";
                echo "<input class='repobutton' type=submit value='Use as Avatar' name='changeavatar'>";
				echo "<input class='repobutton' type=submit value='Change Attribute' name='changeattribute'>";
            }
            echo "<input class='repobutton' type=submit value=Download name='downloadfileuser'>
                 </td>
		 </tr></form>";
            $no++;
        };
        echo "</table></div>";
    }
    else {
        echo "<div id='repolist'>Repository Kosong!<div>";
    }
}

function ShowCoursesRepository($courseid) {
	$tampil;
	$ismanager =false;
	$userid =sessionGet("activeUserID");
	databaseconnect();
	$checkuser = mysql_query("SELECT * FROM courseinstancemanager WHERE userid='$userid' AND courseinstanceid='$courseid'");
	$checkfollow = mysql_query("SELECT * FROM courseinstancefollowing WHERE userid='$userid' AND courseinstanceid='$courseid'");
	if(mysql_num_rows($checkuser)>0) {
		$ismanager = true;
		$tampil="SELECT * FROM courseinstancerepository WHERE courseinstanceid='$courseid' ORDER BY category";
	}elseif(mysql_num_rows($checkfollow)>0) {
		$tampil="SELECT * FROM courseinstancerepository WHERE courseinstanceid='$courseid' AND status='PUBLIC' OR courseinstanceid='$courseid' AND status='FOLLOWER'  ORDER BY category";
	}
	else {
		$tampil="SELECT * FROM courseinstancerepository WHERE courseinstanceid='$courseid' AND status='PUBLIC' ORDER BY category";
	}
	$hasil = mysql_query($tampil);
	if(mysql_num_rows($hasil) > 0) {
		echo "<div id='repolist'>
				<table><tr><th>No</th><th>Nama File</th><th>Status</th><th>Category</th><th>Counter</th><th>Aksi</th></tr>";
		$no =1;
		while($data = mysql_fetch_array($hasil)) {
			echo "<form method=\"POST\" action=\"repositoryhandler.php\">";
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
				echo "<td>			<select name=\"statusupdate\" value=$data[status]>
						<option value=\"PUBLIC\" $public >PUBLIC</option>
						<option value=\"FOLLOWER\" $follower >FOLLOWER</option>
						<option value=\"PRIVATE\" $private >PRIVATE</option>
						</select></td>
						<td><input name=\"categoryupdate\" type=\"textbox\" value=$data[category]></td>";
						}else{
                    echo "<td>$data[status]</td>
					<td>$data[category]</td>";}
					echo "<td class='count'>$data[counter]</td><td>";
			if($ismanager) {
				echo "<input class='repobutton' type=submit value=Delete name='deletefileuser'>";
				echo "<input class='repobutton' type=hidden value=$repo_userid name='pagecourseid'>";
				echo "<input class='repobutton' type=submit value='Change Attribute' name='changeattribute'>";
			}
			echo "<input class='repobutton' type=submit value=Download name='downloadfileuser'>
					</td>
					</tr></form>";
			$no++;
		};
		echo "</table></div>";
	}
	else {
		echo "<div id='repolist'>Repository Kosong!<div>";
	}
}

function isFollower($user_id,$target_userid) {
    $result = mysql_query("SELECT * FROM userfollowing WHERE userid='$user_id' AND targetuserid='$target_userid'");
    if(mysql_num_rows($result)>0) {
        return true;
    }
    else {
        return false;
    }
}

function UploadFileUser() {
    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $nama_file = $_FILES['fupload']['name'];
    $ext = strrchr($nama_file,'.');
    $ukuran_file = $_FILES['fupload']['size'];
    $dummy_userid = sessionGet("activeUserID");
    $nama_file_hash = md5("$dummy_userid $nama_file").$ext;
    $direktori = "repositoryfiles/$nama_file_hash";
	$category = $_POST['chosencategory'];
    $now = date('Y-m-d H:i:s');
    databaseconnect();
    if(move_uploaded_file($lokasi_file,"$direktori")) {
		if($_POST['isrepository'])
		{
			mysql_query("INSERT INTO courseinstancerepository(
						courseinstanceid,
						uploadtimestamp,
						status,
						filename,
						filenamehash,
						filesize,
						category
						)
						VALUES(
						'$_POST[repocourseid]',
						'$now',
						'$_POST[status]',
						'$nama_file',
						'$nama_file_hash',
						'$ukuran_file',
						'$category'
						)");
			}else{
			mysql_query("INSERT INTO userrepository(
						userid,
						uploadtimestamp,
						status,
						filename,
						filenamehash,
						filesize,
						category
						)
						VALUES(
						'$dummy_userid',
						'$now',
						'$_POST[status]',
						'$nama_file',
						'$nama_file_hash',
						'$ukuran_file',
						'$category'
						)");
		}
    }else {
        echo "File Gagal DiUpload!";
    }
    databasedisconnect();
}

function DeleteFileUser() {
    databaseconnect();
	if($_POST['isrepository'])
		{
		mysql_query("DELETE FROM courseinstancerepository WHERE repositoryid='$_POST[repositoryid]'");
			}else{
		mysql_query("DELETE FROM userrepository WHERE repositoryid='$_POST[repositoryid]'");
	}
    $dummy_userid = sessionGet("activeUserID");
    $file2delete = "repositoryfiles/$_POST[filenamehash]";
    unlink($file2delete) or die ("Gagal!");
    databasedisconnect();
}

function DownloadFileUser() {
    $tempname = $_POST['filenamehash'];
    databaseconnect();
    $count = $_POST['counter']+1;
    $dummy_userid = sessionGet("activeUserID");
	if($_POST['isrepository'])
	{
		mysql_query("UPDATE courseinstancerepository SET counter='$count' WHERE repositoryid='$_POST[repositoryid]'");
		}else{
		mysql_query("UPDATE userrepository SET counter='$count' WHERE repositoryid='$_POST[repositoryid]'");
	}
    header( "Location: repositoryfiles/$tempname") ;
    databasedisconnect();
}

function RedirectRepository() {
	if($_POST['isrepository']){
		$pageuserid = $_POST['repocourseid'];
		if($pageuserid){
			header("Location: courserepository.php?coursesid=$pageuserid");
		}
		else{
			header('Location: courserepository.php');
		}
		}else{
	$pageuserid = $_POST['pageuserid'];
	if($pageuserid){
		header("Location: repository.php?userid=$pageuserid");
	}
		else{
			header('Location: repository.php');
	}
	}
}

function ChangeAvatar() {
    databaseconnect();
    $tempname = $_POST['filenamehash'];
    $dummy_userid = sessionGet("activeUserID");
    mysql_query("UPDATE user SET avatar='$tempname' WHERE userid='$dummy_userid'");
    databasedisconnect();
}

function ChangeAttribute()
{
	databaseconnect();
	$statusupdate = $_POST['statusupdate'];
	$categoryupdate = $_POST['categoryupdate'];
	if($_POST['isrepository'])
	{
		mysql_query("UPDATE courseinstancerepository SET status='$statusupdate',category='$categoryupdate' WHERE repositoryid='$_POST[repositoryid]'");
	}else{
		mysql_query("UPDATE userrepository SET status='$statusupdate',category='$categoryupdate' WHERE repositoryid='$_POST[repositoryid]'");
	}
	databasedisconnect();
	}

function mainRepository() {
    if($_POST['uploadfileuser']) {
        RedirectRepository();
        UploadFileUser();
    }
    elseif($_POST['deletefileuser']) {
        RedirectRepository();
        DeleteFileUser();
    }elseif($_POST['downloadfileuser']) {
        DownloadFileUser();
    }
    elseif($_POST['changeavatar']) {
		RedirectRepository();
		ChangeAvatar();
    }
	elseif($_POST['changeattribute'])
	{
		RedirectRepository();
		ChangeAttribute();
		}
    else {
        echo "Tidak Terjadi Apa-apa!";
    }
}
?>