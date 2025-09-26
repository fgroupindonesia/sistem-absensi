<!DOCTYPE html>
<?php // randomizer
$v = "?" . time();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Absensi - FGroupIndonesia</title>
	<script src="<?=base_url();?>/assets/js/jquery.slim.min.js<?= $v ;?>" ></script>
	<script src="<?=base_url();?>/assets/js/bootstrap.bundle.min.js<?= $v ;?>" ></script>
	<script src="<?=base_url();?>/assets/js/jquery-3.3.1.min.js<?= $v ;?>" ></script>
	<link rel="stylesheet" href="<?=base_url();?>/assets/css/bootstrap.min.css<?= $v ;?>" >
	<link rel="stylesheet" href="<?=base_url();?>/assets/css/style.css<?= $v ;?>" >
	<link rel="icon" type="image/x-icon" href="<?=base_url();?>/assets/img/favicon.ico">
</head>

<body>
	<div id="page0" class="container">
		<h2> Portal Absensi </h2>
		<h4>Loading...</h4>
		<img src="<?=base_url();?>/assets/img/loading.gif" />
	</div>

	<div id="page1" class="container">
		<h2> Portal Absensi </h2>
		<h4> Error </h4>
		<p>
		Aktifasi Akun Gagal! <br>
		Harap Hubungi Admin di nomor whatsapp official <b>FGroupIndonesia</b>.
		</p>
		<div class="failed">
			<img src="<?=base_url();?>/assets/img/failed.png" />
		</div>

	
	</div>

	<script type="text/javascript">
		
	var URL_MAIN_PORTAL = "https://absensi.fgroupindonesia.com/portal";

	$( document ).ready(function() {
	   
	   fadeInAnimated();
	  
	});

	function fadeInAnimated(){

		setTimeout(function(){
			$('#page0').hide();
		  $('#page1').show();	
		  $('.failed').fadeIn(3000);  
		}, 7000);

	}


	</script>

</body>

</html>