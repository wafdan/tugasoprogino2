<?php
require_once("databaseconnection.php");
require_once("session.php");

function ShowRepository()
{
	echo "<table><tr><th>No</th><th>Nama File</th><th>Status</th><th>Counter</th><th>Aksi</th></tr>";
	databaseconnect();
	mysql_select_db("tugasprogin");
	$tampil="SELECT * FROM userrepository";
	$hasil = mysql_query($tampil);
	$no =1;
	while($data = mysql_fetch_array($hasil))
	{
		echo "<form method=\"POST\" action=\"repositoryhandler.php\">";
		echo "<input type=hidden name=repositoryid value=$data[repositoryid]>
				<input type=hidden name=filenamehash value=$data[filenamehash]>
				<tr><td>$no</td><td>$data[filename]</td><td>$data[filesize]</td><td>$data[counter]</td>
				<td><input type=submit value=Delete name='deletefileuser'><input type=submit value=Download name='downloadfileuser'></td>
				</tr></form>";
		$no++;
		};
	echo "</table>";
	}

function UploadFileUser(){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file = $_FILES['fupload']['name'];
	$ukuran_file = $_FILES['fupload']['size'];
	$nama_file_hash = md5($nama_file + sessionGet("activeUserID"));
	$direktori = "repositoryfiles/$nama_file_hash";
	
	$dummy_userid = 12;
	databaseconnect();
	mysql_select_db("tugasprogin");
	if(move_uploaded_file($lokasi_file,"$direktori"))
	{
		mysql_query("INSERT INTO userrepository(
					userid,
					status,
					filename,
					filenamehash,
					filesize
					)
					VALUES(
					'$dummy_userid',
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
	mysql_select_db("tugasprogin");
	mysql_query("DELETE FROM userrepository WHERE repositoryid='$_POST[repositoryid]'");
	$file2delete = "repositoryfiles/$_POST[filenamehash]";
	unlink($file2delete) or die ("Gagal!");
	databasedisconnect();
	}

function DownloadFileUser()
{
	$Location = 'http://localhost/tugasoprogino2';
	$tempname = $_POST['filenamehash'];
	databaseconnect();
	mysql_select_db("tugasprogin");
	$count = $_POST['counter']+1;
	mysql_query("UPDATE userrepository SET counter='$count' WHERE repositoryid='$_POST[repositoryid]'");
	header( "Location: $Location/repositoryfiles/$tempname") ;
	databasedisconnect();
	}

function RedirectRepository()
{
	header("Location: http://localhost/tugasoprogino2/repository.php'");
	}

function mainRepository()
{
	if($_POST['uploadfileuser'])
	{
		UploadFileUser();
	}
	elseif($_POST['deletefileuser'])
	{
		DeleteFileUser();
		RedirectRepository();
	}elseif($_POST['downloadfileuser'])
	{
		DownloadFileUser();
		}
	else	echo "Tidak Terjadi Apa-apa!";
}
?>