<?php

/*
	File		registerhandler.php
	Deskripsi	Penanganan form registrasi
*/
require_once("includes/session.php");
require_once("includes/databaseconnection.php");
require_once("includes/config.php");

function uploadfile($username) {
    if(!isset($_POST['submit'])) {
        exit(0);
    }else{
        if($_FILES['photo']['tmp_name']=="none") {
            echo '<b>File gagal diupload. Periksa ukuran File, harus tidak lebih dari 2MB</b>';
            exit(0);
        }
        if(!ereg("image",$_FILES['photo']['type'])) {
            echo '<b>Bukan file gambar.</b>';
            exit (0);
        }else {
            $ext = strrchr($_FILES['photo']['name'],'.');
            $destination = 'repositoryfiles'.'\\'.md5($username).$ext;//.$_FILES['photo']['name'];
            $temp = $_FILES['photo']['tmp_name'];
            move_uploaded_file($temp,$destination);
			$nama_file = ''.md5($username).$ext;
			$dummy_userid = mysql_query("SELECT * FROM user WHERE username='$username'");
			$dummy_userid = mysql_fetch_array($dummy_userid);
			$ukuran_file = $_FILES['photo']['size'];
			$now = date('Y-m-d H:i:s');
			mysql_query("INSERT INTO userrepository(
						userid,
						uploadtimestamp,
						status,
						filename,
						filenamehash,
						filesize
						)
						VALUES(
						'$dummy_userid[userid]',
						'$now',
						'PUBLIC',
						'$nama_file',
						'$nama_file',
						'$ukuran_file'
						)");
			mysql_query("UPDATE user SET avatar='$nama_file' WHERE userid='$dummy_userid[userid]'");
            echo '<p><b>File berhasil diupload:</b> {$_FILES["photo"]["name"]}({$_FILES[photo][size]})</p>';
        }
    }
}

function insert() {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthday'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $sql= "INSERT INTO `progin2`.`user`
                (`userid` ,
                `username` ,
                `password` ,
                `fullname` ,
                `email` ,
                `birthdate` ,
                `telephone` ,
                `address` ,
                `gender` ,
                `role` ,
                `status` ,
                `registerdate`)
            VALUES (
                NULL , 
                '$username', 
                '$password', 
                '$fullname', 
                '$email', 
                '$birthdate', 
                '$phone', 
                '$address', 
                '$gender', 
                'USER', 
                'PENDING', 
                NOW());";
    
    databaseconnect();
    //$username= mysql_query("SELECT username FROM user where username='$username'");
    if(mysql_query($sql)) {
        uploadfile($username);
        echo "INSERTED";
    }else {
        echo "NOT INSERTED";
    }
    databasedisconnect();
}; 

sessionInit();

$data = $_POST['registration-form'];
if($_POST['dummy']=='f') {
    header("location:register.php?valid=0");
    exit(0);
}elseif($_POST['dummy']=='t') {
    header("location:register.php?valid=1");
    insert();
    exit(0);
}
?>