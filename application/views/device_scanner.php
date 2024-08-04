<!DOCTYPE html>
<?php // randomizer
$v = "?" . time();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Absensi - FGroupIndonesia</title>
	<script src="/assets/js/jquery.slim.min.js<?= $v ;?>" ></script>
	<script src="/assets/js/bootstrap.bundle.min.js<?= $v ;?>" ></script>
	<script src="/assets/js/jquery-3.3.1.min.js<?= $v ;?>" ></script>
	<script src="/assets/js/works-device.js<?= $v ;?>" ></script>
	<script src="/assets/js/jsQR.js<?= $v ;?>"></script>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css<?= $v ;?>" >
	<link rel="stylesheet" href="/assets/css/style.css<?= $v ;?>" >
	<link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
</head>

<body>
	<div id="page0" class="container">
		<h2> Portal Absensi </h2>
		<h4>Loading...</h4>
		<img src="/assets/img/loading.gif" />
		
	</div>

	<div id="page1" class="container">
		<h2> Portal Absensi </h2>
		<h4>Selamat Datang!</h4>
		
		<input type="button"  class="btn-gold btn-continue" value="Lanjut" />

	</div>

	<div id="page2" class="container">
		<h2> Portal Absensi </h2>
		<h4>Loading...</h4>
		<img src="/assets/img/loading.gif" />
		
	</div>

	<div id="page3" class="container">
		<h2> Portal Absensi </h2>
		<p class="home">Scan QRCode</p>
			<div id="scan-container">
			
				<span id="error-not-mobile"><b>Gunakan Mobile device untuk melanjutkan absensi!</b></span>

			<div id="rectangle">  
				<div id="scan-line"></div>
				<div id="overlay-camera">
					<div id="coloring-camera"></div>
				</div>
				<video id="video" autoplay playsinline crossorigin="anonymous"></video>
				<img id="screenshot" alt="Screenshot">

			 </div>
			   <span id="coordinates" ></span>

			</div>
				<audio id="click-sound" src="/assets/audio/beep.mp3"></audio>

	</div>

	<div id="page4" class="container">
		<h2> Portal Absensi </h2>
		<h4>Loading...</h4>
		<img src="/assets/img/loading.gif" />
		
	</div>

	<div id="page5" class="container">
		<h2> Portal Absensi </h2>
		<h4>Sukses!</h4>
		<img src="/assets/img/complete.png" />
		
			<input type="button"  class="btn-gold btn-continue" value="Lanjut" />
		
	</div>

	<div id="page6" class="container">
		<h2> Portal Absensi </h2>
		<h4>Gagal!</h4>
		<img src="/assets/img/error.png" />
		
			<input type="button"  class="btn-gold btn-continue" value="Ulangi" />
		
	</div>

	<div id="exit" class="container">
		<h2> Portal Absensi </h2>
			<img src="/assets/img/bye.gif" />
			<label> Selamat berjumpa kembali nanti! </label>
			<p >autoclose dalam <span class="detik">5 detik. </span></p>
	</div>

</body>

</html>