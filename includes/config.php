<?php

/*
	File		config.php
	Deskripsi	Penyimpanan variabel-variabel konfigurasi
 */

// Konfigurasi database
$cfg['Database']['host'] = '127.0.0.1';
$cfg['Database']['user'] = 'root';
$cfg['Database']['pass'] = 'rootpekoktenan';
$cfg['Database']['tableprefix'] = '';
$cfg['Database']['database'] = 'progin2';

// Konfigurasi session
$cfg['Session']['prefix'] = 'PROGIN_';

// Konfigurasi secret string (untuk salt md5)
$cfg['secret'] = 'salt';
?>