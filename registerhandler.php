<?php

/*
	File		registerhandler.php
	Deskripsi	Penanganan form registrasi
 */
require_once("includes/databaseconnection.php"); 
require_once("includes/config.php"); 

function insert(){
    // $nama = $_POST['regNama'];
    // $username = $_POST['regUsername'];
    // $password = $_POST['regPassword1'];
    // $filefoto = $_POST['regFile'];
    // $telepon = $_POST['regTelepon'];
    // $email = $_POST['regEmail'];
    //$gender = $_POST['gender'];
    //print_r($_POST[gender]);
    $sql= "INSERT INTO `progin2`.`user` (
            `userid` ,
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
            `registerdate`
            )
            VALUES (
            NULL , '$_POST[username]', '$_POST[password]', '$_POST[name]', '$_POST[email]', '$_POST[birthday]', '$_POST[phone]', '$_POST[address]', '$_POST[gender]', 'USER', 'PENDING', NOW( )
            );";
    /* $con = mysql_connect('localhost','root','');      
    if(!$con) {
        die('Could not connect: '.mysql_error());
    } */
    databaseconnect();
    if(mysql_query($sql)){
        echo "INSERTED";
    }else{
        echo "NOT INSERTED";
    }
}; 

insert();
databasedisconnect();
?>