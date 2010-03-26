<?php

/*
	File		register.php
	Deskripsi	Form untuk registrasi
*/

// Data pada form ini akan di-POST ke registerhandler.php
require_once("includes/session.php");
require_once("registerhandler.php");

sessionInit();

?>

<html xmlns="http://www.w3.org/1999/xhtml" >

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Register - KulOn&trade;</title>
        <link id="global-style" rel="stylesheet" type="text/css" href="css/global.css" />
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/style1.css" />
        <link id="calendar-style" rel="stylesheet" type="text/css" href="css/calendar.css" />
        <script type="text/javascript" src="script/script.js"></script>
    </head>
    <body  onload="setKota()">
        <div id="toplevel">
            <div id="header">
                <div id="logo">
                    <h1>KulOn&trade;</h1>
                    <h2><b>Kuliah Online</b></h2>
                </div>
                <div id="menu">
                    <ul>
                        <li>
                            <a href="index.php">Home</a></li>
                    </ul>
              </div>
            </div>
            <?php
            if($_GET['valid']=='1') {
                echo '<div class="message">Akun berhasil dibuat, silakan login dari halaman HOME.</div>';
            }elseif($_GET['valid']=='0') {
                echo '<div class="message">Akun gagal dibuat, periksa apakah masih ada field yang kosong atau tidak valid.</div>';
            }
            ?>
            <div id="container">
                <div id="registration">
                    <form id="registration-form"  name="registration-form" method="post" action="registerhandler.php" enctype="multipart/form-data">
                        <fieldset class="general">
                            <legend><span>Selamat Datang di KulOn&trade;</span></legend>
                            <ul>
                                <li>
                                    <label for="name">Nama</label>
                                    <input id="name" name="name" type="text" maxlength="30" size="50" onChange="CheckNama()" />
                                    <img id="name_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found" />
                                </li>
                                <li>
                                    <label for="gender">Jenis Kelamin</label>
                                    <select id="gender" name="gender">
                                        <option value="M">Laki-laki</option>
                                        <option value="F">Perempuan</option>
                                    </select>
                                </li>
                                <li>
                                    <label for="birthday">Tanggal Lahir</label>
                                    <input id="birthday" name="birthday" type="text" maxlength="10" size="50" onChange="CheckBirthday()" />
                                    <a href="#" onClick="setYears(1980, 2010); showCalender(this, 'birthday');"><img src="images/calender.png" alt="Picture not Found" /></a>

                                    <!-- Calendar HTML -->

                                    <table id="calenderTable">
                                        <tbody id="calenderTableHead">
                                            <tr>
                                                <td colspan="4" align="center">
                                                    <select onChange="showCalenderBody(createCalender(document.getElementById('selectYear').value,
                                                        this.selectedIndex, false));" id="selectMonth">
                                                        <option value="0">Jan</option>
                                                        <option value="1">Feb</option>
                                                        <option value="2">Mar</option>
                                                        <option value="3">Apr</option>
                                                        <option value="4">Mei</option>
                                                        <option value="5">Jun</option>
                                                        <option value="6">Jul</option>
                                                        <option value="7">Agu</option>
                                                        <option value="8">Sep</option>
                                                        <option value="9">Okt</option>
                                                        <option value="10">Nov</option>
                                                        <option value="11">Des</option>
                                                    </select>
                                                </td>
                                                <td colspan="2" align="center">
                                                    <select onChange="showCalenderBody(createCalender(this.value, document.getElementById('selectMonth').selectedIndex, false));" id="selectYear">
                                                    </select>
                                                </td>
                                                <td align="center">
                                                    <a href="#" onClick="closeCalender();"><font color="#003333" size="+1">x</font></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody id="calenderTableDays">
                                            <tr style="">
                                                <td>Min</td><td>Sen</td><td>Sel</td><td>Rab</td><td>Kam</td><td>Jum</td><td>Sab</td>
                                            </tr>
                                        </tbody>
                                        <tbody id="calender"></tbody>
                                    </table>

                                    <!-- End Calender HTML  -->

                                    <img id="birthday_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset  class="userpass">
                            <legend><span>Pilih Username dan Password</span></legend>
                            <ul>
                                <li>
                                    <label for="username">Username</label>
                                    <input id="username" name="username" type="text" maxlength="20" size="50" onChange="CheckUserName()"/>
                                    <img id="username_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>
                                </li>
                                <li>
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" maxlength="20" size="50" onChange="CheckPassword()"/>
                                    <img id="password_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>
                                </li>
                                <li>
                                    <label for="password2">Password Lagi</label>
                                    <input id="password2" name="password2" type="password" maxlength="20" size="50" onChange="CheckPassword2()"/>
                                    <img id="password2_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset  class="contact">
                            <legend><span>Kontak</span></legend>
                            <ul>
                                <li>
                                    <label for="phone">Nomor Telepon</label>
                                    <input id="phone" name="phone" type="text" maxlength="20" size="50" onChange="CheckPhone()"/>
                                    <img id="phone_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>
                                </li>
                                <li>
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="text" maxlength="30" size="50" onChange="CheckEmail()"/>
                                    <img id="email_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>
                                </li>
                                <li>
                                    <label for="address">Alamat</label>
                                    <textarea id="address" name="address" cols="38" rows="3" onChange="CheckAddress()"></textarea>
                                    <img id="address_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>
                                </li>
                                <li>
                                    <label for="province">Provinsi</label>
                                    <select id="province" name="province" onChange="setKota()">
                                        <option value="1">DKI Jakarta</option>
                                        <option value="2">Jawa Barat</option>
                                        <option value="3">Sumatera Barat</option>
                                    </select>
                                </li>
                                <li>
                                    <label for="city">Kota</label>
                                    <input id="city_text" name="city_text" type="text" maxlength="20" size="28" onChange="SyncKotaText()"/>
                                    <select id="city" name="city" onChange="SyncKotaDDList()">
                                    </select>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="uploadphoto">
                            <legend><span>Upload Foto</span></legend>
                            <ul>
                                <li>
                                    <label for="photo">Foto Anda</label>
                                    <input id="photo" name="photo" type="file" onChange="CheckPhoto()"/>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                                    <img id="photo_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="submit">
                            <ul>
                                <li>
                                    <label>&nbsp;</label>
                                    <input type="submit" name="submit" value="Buat Akun" onClick="javascript:CheckAll();"/>
                                </li>
                            </ul>
                        </fieldset>
                        <input type="hidden" id="dummy" name="dummy" />
                    </form>
                </div>
            </div>
            <div id="footer">
                <p class="legal"><i>Copyright</i> &copy; 2010 KulOn&trade;. <i>All rights reserved</i>. </p>
                <p class="credit"><i>Designed by : </i> <a>Andika Pratama</a>, <a>Anggrahita Bayu Sasmita</a>, <a>Alvin Andhika Zulen</a></p>
            </div>
        </div>
    </body>
</html>