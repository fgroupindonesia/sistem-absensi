<?php

// this script is called by the client over the browser
// and then sent into the email

// $name = $_GET['name'];
// $code = $_GET['code'];
date_default_timezone_set('Asia/Jakarta');
$date = date('l, d-F-Y H:i:s') . " WIB";
$computerDate = date('Y-m-d');
$computerTime = date('H:i:s');

$link = "http://absensi.fgroupindonesia.com/account/activate?token=" . $code . "&type=student&date=" . $computerDate . "&time=" . $computerTime . "&whatsapp=" . $whatsapp;
// type is both different:
// student who use portal (db)
// client who use sistem_absen (db)
?>
<html>

<head></head>

<body>

	<h1>Aktifasi Akun Sistem Absensi </h1>
	<p><b>Hello <span><?= $name; ?> ! </span> </b></p>
	<p>Kamu dapat melakukan absensi setelah melakukan aktifasi dengan mengklik link berikut ini: </p>

	<a href="<?= $link; ?>">Link Aktifasi</a>.
	<p>
	<b>Catatan:</b> <i>Pastikan kamu melakukan (klik link aktifasi) dari ponsel yang digunakan saat melakukan absensi harian. Untuk pertanyaan dan konsultasi lainnya harap menghubungi admin di nomor official whatsapp FGroupIndonesia.</i>
	<br>  	
		<hr>
		<code>Automatic Generated by FGroupIndonesia 
			at <?= $date; ?> 
		</code>
	</p>
</body>

</html>