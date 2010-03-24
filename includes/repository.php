<?php
require_once("databaseconnection.php");
require_once("session.php");
sessionInit();

function ShowRepository($repo_userid)
{
	$tampil;
	databaseconnect();
	if(sessionGet("activeUserID")== $repo_userid)
	{
		$tampil="SELECT * FROM userrepository WHERE userid='$repo_userid'";
	}elseif(isFollower(sessionGet("activeUserID"),$repo_userid))
	{
		$tampil="SELECT * FROM userrepository WHERE userid='$repo_userid' AND status='public' OR userid='$repo_userid' AND status='FOLLOWER'";
		}
	else
	{
		$tampil="SELECT * FROM userrepository WHERE userid='$repo_userid' AND status='public'";
		}
	$hasil = mysql_query($tampil);
	if(mysql_num_rows($hasil) > 0){
		echo "<table><tr><th>No</th><th>Nama File</th><th>Status</th><th>Counter</th><th>Aksi</th></tr>";	
		$no =1;
		while($data = mysql_fetch_array($hasil))
		{
			echo "<form method=\"POST\" action=\"repositoryhandler.php\">";
			echo "<input type=hidden name=repositoryid value=$data[repositoryid]>
					<input type=hidden name=filename value=$data[filename]>
					<tr><td>$no</td><td>$data[filename]</td><td>$data[status]</td><td>$data[counter]</td>
					<td>";
			if(sessionGet("activeUserID")== $repo_userid){
				echo "<input type=submit value=Delete name='deletefileuser'>";
			}
			echo	"<input type=submit value=Download name='downloadfileuser'></td>
					</tr></form>";
			$no++;
		};
		echo "</table>";
	}
	else
	{
		echo "Repository Kosong!";
		}
}

function isFollower($user_id,$target_userid)
{
	$result = mysql_query("SELECT * FROM userfollowing WHERE userid='$user_id' AND targetuserid='$target_userid'");
	if(mysql_num_rows($result)>0)
	{
		return true;
		}
	else
	{
		return false;
		}
}

function UploadFileUser(){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file = $_FILES['fupload']['name'];
	$ukuran_file = $_FILES['fupload']['size'];
	$dummy_userid = sessionGet("activeUserID");
	mkdir("repositoryfiles/$dummy_userid");
	$direktori = "repositoryfiles/$dummy_userid/$nama_file";
	$now = date('Y-m-d H:i:s');
	databaseconnect();
	if(move_uploaded_file($lokasi_file,"$direktori"))
{	
		mysql_query("INSERT INTO userrepository(
					userid,
					uploadtimestamp,
					status,
					filename,
					filenamehash,
					filesize
					)
					VALUES(
					'$dummy_userid',
					'$now',
					'$_POST[status]',
					'$nama_file',
					'$nama_file_hash',
					'$ukuran_file'
					)");
	}else
	{
		echo "File Gagal DiUpload!";
		}
	databasedisconnect();
}

function DeleteFileUser()
{
	databaseconnect();
	mysql_query("DELETE FROM userrepository WHERE repositoryid='$_POST[repositoryid]'");
	$dummy_userid = sessionGet("activeUserID");
	$file2delete = "repositoryfiles/$dummy_userid/$_POST[filename]";
	unlink($file2delete) or die ("Gagal!");
	databasedisconnect();
	}

function DownloadFileUser()
{
	$tempname = $_POST['filename'];
	databaseconnect();
	$count = $_POST['counter']+1;
	$dummy_userid = sessionGet("activeUserID");
	mysql_query("UPDATE userrepository SET counter='$count' WHERE repositoryid='$_POST[repositoryid]'");
	header( "Location: repositoryfiles/$dummy_userid/$tempname") ;
	databasedisconnect();
	}

function RedirectRepository()
{
	header("Location: repository.php");
	}

function mainRepository()
{
	if($_POST['uploadfileuser'])
	{
		RedirectRepository();
		UploadFileUser();
	}
	elseif($_POST['deletefileuser'])
	{
		RedirectRepository();
		DeleteFileUser();
	}elseif($_POST['downloadfileuser'])
	{
		DownloadFileUser();
		}
	else	echo "Tidak Terjadi Apa-apa!";
}
?>