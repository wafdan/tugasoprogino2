<?php
require_once("../includes/databaseconnection.php");
require_once("../includes/session.php");
require_once("../includes/mywall.php");
sessionInit();
$uid = $_GET['userid'];

databaseconnect();
$result = mysql_query("SELECT * FROM user WHERE userid='$uid'");
$data = mysql_fetch_array($result);
databasedisconnect();

echo "<legend><span>Informasi</span></legend>";
echo "<ul>
        <li>
            <div class='label'>Nama</div>
            <div class='info'>: {$data['fullname']}</div>
        </li>
        <li>
            <div class='label'>Tanggal Lahir</div>
            <div class='info'>: {$data['birthdate']}</div>
        </li>
        <li>
            <div class='label'>Jenis Kelamin</div>
            <div class='info'>: ";
            if($data['gender']=='M') {
                echo "Laki-laki";
            }else {
                echo "Wanita";
            }
        echo "</div>
        </li>
        <li>
            <div class='label'>Nomor Telepon</div>
            <div class='info'>: {$data['telephone']}</div>
        </li>
        <li>
            <div class='label'>Email</div>
            <div class='info'>: {$data['email']}</div>
        </li>
        <li>
            <div class='label'>Alamat</div>
            <div class='info'>{$data['address']}</div>
        </li>
    </ul>";

?>