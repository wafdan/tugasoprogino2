<?php

/*
	File		register.php
	Deskripsi	Form untuk registrasi
 */

// Data pada form ini akan di-POST ke registerhandler.php
require_once("includes/databaseconnection.php");
$message = 'HALO WORLD';
//databaseconnect();
//insert();
//databasedisconnect();
?>

<html xmlns="http://www.w3.org/1999/xhtml" >

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Register - Konco&trade;</title>
        <link id="global-style" rel="stylesheet" type="text/css" href="css/global.css" />
        <link id="unique-style" rel="stylesheet" type="text/css" href="css/style1.css" />
        <link id="calendar-style" rel="stylesheet" type="text/css" href="css/calendar.css" />
        <script type="text/javascript" src="script/script.js"></script>
    </head>
    <body  onload="setKota()">
	<div id="toplevel">
		<div id="header">
			<div id="logo">	
				<h1>Konco&trade;</h1>
				<h2><b>Connecting People</b></h2>
			</div>
		</div>
		<hr />
        <div id="container">
            <div id="registration">
                <form id="registration-form" action="registerhandler.php" method="post">
                    <fieldset class="general">
                        <legend><span>Selamat Datang di Konco&trade;</span></legend>
                        <ul>
                            <li>
                                <label for="name">Nama</label>
                                <input id="name" name="name" type="text" maxlength="30" size="50" onchange="CheckNama()"  />
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
                                <input id="birthday" name="birthday" type="text" maxlength="10" size="50" onchange="CheckBirthday()" />
								<a href="#" onclick="setYears(1980, 2010); showCalender(this, 'birthday');"><img src="images/calender.png" alt="Picture not Found" /></a>
								
								<!-- Calendar HTML --> 

								<table id="calenderTable">
									<tbody id="calenderTableHead">
										<tr>
											<td colspan="4" align="center">
												<select onchange="showCalenderBody(createCalender(document.getElementById('selectYear').value,
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
												<select onchange="showCalenderBody(createCalender(this.value, document.getElementById('selectMonth').selectedIndex, false));" id="selectYear">
												</select>
											</td>
											<td align="center">
												<a href="#" onclick="closeCalender();"><font color="#003333" size="+1">x</font></a>
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
                                <input id="username" name="username" type="text" maxlength="20" size="50" onchange="CheckUserName()"/>
								<img id="username_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>	
                            </li>
                            <li>
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" maxlength="20" size="50" onchange="CheckPassword()"/>
								<img id="password_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>	
                            </li>
                            <li>
                                <label for="password2">Password Lagi</label>
                                <input id="password2" name="password2" type="password" maxlength="20" size="50" onchange="CheckPassword2()"/>
								<img id="password2_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>	
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset  class="contact">
                        <legend><span>Kontak</span></legend>
                        <ul>
                            <li>
                                <label for="phone">Nomor Telepon</label>
                                <input id="phone" name="phone" type="text" maxlength="20" size="50" onchange="CheckPhone()"/>
								<img id="phone_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>	
                            </li>
                            <li>
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" maxlength="30" size="50" onchange="CheckEmail()"/>
								<img id="email_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>	
                            </li>
							<li>
                                <label for="address">Alamat</label>
                                <textarea id="address" name="address" cols="38" rows="3" onchange="CheckAddress()"></textarea>
								<img id="address_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>	
                            </li>
                            <li>
								<label for="province">Provinsi</label>
								<select id="province" name="province" onchange="setKota()">
                                    <option value="1">DKI Jakarta</option>
                                    <option value="2">Jawa Barat</option>
                                    <option value="3">Sumatera Barat</option>
                                </select>
                            </li>
                            <li>
                                <label for="city">Kota</label>
								<input id="city_text" name="city_text" type="text" maxlength="20" size="28" onchange="SyncKotaText()"/>
                                <select id="city" name="city" onchange="SyncKotaDDList()">
                                </select>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset class="uploadphoto">
                        <legend><span>Upload Foto</span></legend>
                        <ul>
                            <li>
                                <label for="photo">Foto Anda</label>
                                <input id="photo" name="photo" type="file" onchange="CheckPhoto()"/>
								<img id="photo_img" src="images/12-em-trans_12x12.png" style="visibility:hidden;" alt="Picture not Found"/>	
                            </li>
                        </ul>
                    </fieldset>                    
                    <fieldset class="submit">
                        <ul>
                            <li>
                                <label>&nbsp;</label>
                                <input type="submit" value="Buat Akun" onclick="javascript:submitRegistration();"/>
                            </li>
                        </ul>
                    </fieldset>
                </form>
            </div>
			<div id ="sidebar">
				<ul>
					<li>
						<h2><a href="register.html">Konco&trade;</a></h2>
						<p>Sudah memiliki akun Konco&trade; ?</p>
					</li>
					<li>	
						<label for="input-username">Username</label>
						<input id="input-username" name="input-username" type="text" maxlength="20" size="20"/>
					</li>	
					<li>	
						<label for="input-password">Password</label>
						<input id="input-password" name="input-password" type="password" maxlength="20" size="20"/>
					</li>
					<li>
						<input id="loginButton" type="submit" value="Login" onclick="nothingHappens()"/>	
					</li>		
				</ul>				
			</div>
			<div id="style-switcher">
			</div>
        </div>
		<div id="footer">
			<p class="legal"><i>Copyright</i> &copy; 2010 Konco&trade;. <i>All rights reserved</i>. </p>
			<p class="credit"><i>Designed by : </i> <a>Andika Pratama</a>, <a>Anggrahita Bayu Sasmita</a>, <a>Alvin Andhika Zulen</a></p>
		</div>
	</div>	
    </body>
</html>