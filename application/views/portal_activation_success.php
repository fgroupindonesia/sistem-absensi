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
	<script src="/assets/js/works.js<?= $v ;?>" ></script>
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
		<p>
		Aktifasi Akun Sukses! <br>
		Sebentar lagi kamu dapat melakukan absensi secara leluasa.
		</p>
		<div class="success">
			<img src="/assets/img/complete.png" />
		</div>

		<p>
			<span id="detik">10</span> detik...
		</p>
	</div>

	<script type="text/javascript">
		

	$( document ).ready(function() {
	   
	   fadeInAnimated();
	  
		
	});

	function fadeInAnimated(){

		setTimeout(function(){
		  $('#page0').hide();
		  $('#page1').show();	
		  $('.success').fadeIn(4000); 


		// this is for the activation portal works
	  	updateCountdownAndLink();

		}, 3000);

	}

	function updateCountdownAndLink(){

	    	var countdownSpan = $('#detik');
	        var countdown = parseInt(countdownSpan.text());

	        //console.log('ada ' + countdown);

	        if (countdown > 0) {
	            countdown--;
	            countdownSpan.text(countdown);
	            setTimeout(updateCountdownAndLink, 1000); // Update every second
	        } else {
	            
	        	// save data dulu localstorage
	        	USERNAME = '<?= $username; ?>';
	        	PHONE_NUMBERS = '<?= $phone_numbers ; ?>';
	        	EMAIL = '<?= $email; ?>';
	        	
	        	saveDataLocal();

	        	// forward link to
	        	window.location.href = URL_MAIN_PORTAL;

	        }

	}

	</script>

</body>

</html>