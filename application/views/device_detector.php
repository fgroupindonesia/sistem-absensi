<!DOCTYPE html>
<?php // randomizer
$v = "?" . time();

// ini untuk memudahkan all Script JS bawahan
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Absensi - FGroupIndonesia</title>
	<script src="<?=base_url();?>/assets/js/jquery.slim.min.js<?= $v ;?>" ></script>
	<script src="<?=base_url();?>/assets/js/bootstrap.bundle.min.js<?= $v ;?>" ></script>
	<script src="<?=base_url();?>/assets/js/jquery-3.3.1.min.js<?= $v ;?>" ></script>
	<script src="<?=base_url();?>/assets/js/sweetalert2@11.js<?= $v ;?>" ></script>
	
	<script src="<?=base_url();?>/assets/js/works-device-detector.js<?= $v ;?>" ></script>
	<script src="<?=base_url();?>/assets/js/jsQR.js<?= $v ;?>"></script>
	<link rel="stylesheet" href="<?=base_url();?>/assets/css/bootstrap.min.css<?= $v ;?>" >
	<link rel="stylesheet" href="<?=base_url();?>/assets/css/style.css<?= $v ;?>" >
	<link rel="icon" type="image/x-icon" href="<?=base_url();?>/assets/img/favicon.ico">
</head>

<style>
	body.swal2-shown {
    height: 100% !important;
    overflow: hidden !important;
    padding-right: 0 !important; /* cegah shift horizontal */
}

body.swal2-shown .card {
    position: relative !important;
    top: 0 !important;
    z-index: 1 !important;
    transform: none !important;
}
}
</style>

<body>
	<div id="page0" class="container text-center">
		<h2> Portal Absensi </h2>
		<h4>Loading...</h4>
		<img class="img-fluid" src="<?=base_url();?>/assets/img/loading.gif" />
		
	</div>

	<div id="page1" class="container text-center">
		<h2> Portal Absensi </h2>
		<h4>Selamat Datang!</h4>
		
		
		<input type="button"  class="btn-gold btn-continue" value="Lanjut" />

	</div>

	<div id="page2" class="container text-center">
		<h2> Portal Absensi </h2>
		<h4>Loading...</h4>
		<img src="<?=base_url();?>/assets/img/loading.gif" />
		
	</div>

	<div id="page3" class="container text-center">
		<h2> Portal Absensi </h2>
		
		<p>Device anda belum ter-integrasi untuk absensi</p>
		<input type="button"  class="btn-gold btn-continue" value="Aktifkan" />

	</div>

	<div id="page4" class="container text-center">
		<h2> Portal Absensi </h2>
		<h4>Loading...</h4>
		<img src="<?=base_url();?>/assets/img/loading.gif" />
		
	</div>

	<div id="page5" class="container text-center">
		<h2> Portal Absensi </h2>
		<h4>Aktifasi</h4>
		
		<p id="perintah">Masukkan kode aktifasi Device : </p>

		<form id="periksa-code-form" class="mx-auto" action="/check-code" method="post">
      <div class="kode-aktifasi">
        <input type="text" name="code1" maxlength="1" />
        <input type="text" name="code2" maxlength="1" />
        <input type="text" name="code3" maxlength="1" />
        <input type="text" name="code4" maxlength="1" />
        <input type="text" name="code5" maxlength="1" />
        <input type="text" name="code6" maxlength="1" />
        <input type="text" name="code7" maxlength="1" />
      </div>
      <button class="btn-gold btn-check" type="submit">Aktifkan</button>
    </form>

	</div>

	
	<div id="page4" class="container text-center">
		<h2> Portal Absensi </h2>
		<h4>Loading...</h4>
		<img src="<?=base_url();?>/assets/img/loading.gif" />
		
	</div>

	<div id="page5" class="container text-center">
		<h2> Portal Absensi </h2>
		<h4>Sukses!</h4>
		<img src="<?=base_url();?>/assets/img/complete.png" />
		
			<input type="button"  class="btn-gold btn-continue" value="Lanjut" />
		
	</div>

	<div id="page6" class="container text-center">
		<h2> Portal Absensi </h2>
		<h4>Gagal!</h4>
		<img src="<?=base_url();?>/assets/img/error.png" />
		
			<input type="button"  class="btn-gold btn-continue" value="Ulangi" />
		
	</div>

	<div id="page7" class="container text-center">
		<h2> Portal Absensi </h2>
			<img src="<?=base_url();?>/assets/img/bye.gif" />
			<label> Selamat berjumpa kembali nanti! </label>
			<p >autoclose dalam <span class="detik">5 detik. </span></p>
	</div>

</body>

</html>