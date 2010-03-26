<?php

/*
	File		config.php
	Deskripsi	Penyimpanan variabel-variabel konfigurasi
 */

// Konfigurasi database
$cfg['Database']['host'] = '127.0.0.1';
$cfg['Database']['user'] = 'progin';
$cfg['Database']['pass'] = 'progin';
$cfg['Database']['tableprefix'] = '';

// Konfigurasi session
$cfg['Session']['prefix'] = 'PROGIN_';

// Konfigurasi secret string (untuk salt md5)
$cfg['secret'] = 'salt';
?>