<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
sessionInit();
function DeleteFileUser() {
	databaseconnect();
	mysql_query("DELETE FROM userrepository WHERE repositoryid='$_POST[repositoryid]'");
	$file2delete = "../repositoryfiles/$_POST[filenamehash]";
	unlink($file2delete) or die ("Gagal!");
	databasedisconnect();
}
DeleteFileUser();
?>