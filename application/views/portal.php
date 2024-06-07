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
		<p>
		Pilih Mode Kamu (sebagai) :
		</p>
		<div class="menu menu-user" data-user="peserta">
			<img src="/assets/img/user.png" />
			<label><b>Peserta (Kursus)</b></label>
		</div>

		<div class="menu menu-user" data-user="pengajar">
			<img src="/assets/img/staff.png" />
			<label><b>Pengajar (Instruktur)</b></label>
		</div>
	</div>

	<div id="page2" class="container">
		<h2> Portal Absensi </h2>
		<h4>Mode Verifikasi</h4>
		<p>
		Mana jalur verifikasi yang kamu dapat akses? :
		</p>
		<div id="wa-verifikasi" class="menu" data-user="wa">
			<img src="/assets/img/wa.png" />
			<label><b>Whatsapp</b></label>
		</div>

		<div id="email-verifikasi" class="menu" data-user="email">
			<img src="/assets/img/email.png" />
			<label><b>Email</b></label>
		</div>
	</div>


	<div id="page3" class="container">
		<h2> Portal Absensi </h2>
			<form id="form-awal-verifikasi" action="/portal/verifikasi" method="post">
			<div class="form-group">
				<div class="form-wa">
			    <label for="phone_numbers">Verifikasi Nomor Whatsapp</label>
			    <input type="text" name="phone_numbers" class="form-control" id="phone_numbers" aria-describedby="phoneHelp">
			    <small id="phoneHelp" class="form-text text-muted">Tuliskan nomor aktif kamu.</small>
			    <p class="error-phone-numbers"> Nomor Whatsapp tidak valid!
				</p>

		    	</div>

		    	<div class="form-email">
			    <label for="email">Email</label>
			    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
			    <small id="emailHelp" class="form-text text-muted">Tuliskan email yang aktif di handphone kamu.</small>
				</div>

		 	<input type="submit" id="btn-phone-ok" class="btn-gold" value="OK" />
		 	<img id="img-loading" src="/assets/img/loading.gif" />
		 	</div>
		 	</form>
	</div>

	<div id="page4" class="container">
		<h2> Portal Absensi </h2>
		<div class="form-group" id="check-email">
				 	<h4> Check Inbox Email </h4>
				 	<img src="/assets/img/email.png" />
				    <p> Klik Link aktifasi akun agar dapat melakukan absensi. </p> 
		</div>
		<div class="form-group" id="check-kode-wa">
				<form id="form-digit-verifikasi" action="/portal/verifikasiwa" method="post" >
				 	<h4> Input 7 Digit Kode </h4>
				 	<img src="/assets/img/wa.png" />
				    <p> Isilah dengan nomor kode verifikasi agar dapat melakukan absensi menggunakan akun ini.</p>
				    <p class="error-kode-wa"> Kode Anda Salah! 
				    	Harap Ketik kode yang valid.
				    </p>
				    <p class="error-kode-wa-terbatas"> <b>Percobaan anda habis!</b> Harap hubungi <b>admin</b>.
				    </p>
				    <center>
				    <input type="text" class="form-control kode-wa" id="kode-wa1"> - 
				    <input type="text" class="form-control kode-wa" id="kode-wa2"> - 
				    <input type="text" class="form-control kode-wa" id="kode-wa3"> - 
				    <input type="text" class="form-control kode-wa" id="kode-wa4"> - 
				    <input type="text" class="form-control kode-wa" id="kode-wa5"> - 
				    <input type="text" class="form-control kode-wa" id="kode-wa6"> - 
				    <input type="text" class="form-control kode-wa" id="kode-wa7">

				    <input type="hidden" name="code" id="kode-wa-all"> </span>
				    <img id="loading-kode-wa" src="/assets/img/loading.gif" />
				    </center> 

				    <input type="submit" id="btn-kode-wa-ok" class="btn-gold" value="OK" />
				</form>
		</div>
	</div>

	<div id="page5" class="container">
		<h2> Portal Absensi </h2>
		<div class="form-group welcome">
				 	<h4> Selamat Datang </h4>
				    <span id="nama-lengkap" > </span> <br>
				   <input type="button" id="btn-nama-lengkap-ok" class="btn-gold" value="OK" />
		</div>
	</div>

	<div id="page6" class="container">
		<h2> Portal Absensi </h2>
			<div id="absen-hadir" class="menu">
			<img src="/assets/img/new.png" />
			<label><b>Mau Absen Sekarang</b></label>
			</div>
			<div id="absen-sebelum" class="menu">
			<img src="/assets/img/search.png" />
			<label><b>Check Absen Sebelumnya</b></label>
			</div>
			<div id="cancel" class="menu">
			<img src="/assets/img/cancel.png" />
			<label><b>Batal </b></label>
			</div>	
	</div>

	<div id="page7" class="container">
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
				<audio id="click-sound" src="/audio/beep.mp3"></audio>

	</div>

	<div id="page8" class="container">
		<h2> Portal Absensi </h2>
		<p class="home">Data Absen Sebelumnya</p>

		<select id="filter-absen" >
			<option value="all">all data</option>
			<option value="hadir">hadir</option>
			<option value="idzin">idzin sakit &#47; berhalangan</option>
			<option value="alpha">tanpa keterangan</option>	
		</select>

		<table id="table-absen">
		<thead>
            <tr>
              <th>Hari</th>
              <th>Tanggal</th>
              <th>Jam</th>
            </tr>
        </thead>
        <tbody></tbody>
		</table>

	</div>

	<div id="loading" class="container">
		<h2> Portal Absensi </h2>
		<p >Sedang diproses dalam <span class="detik">5 detik. </span></p>
		<img src="/assets/img/loading.gif" />
	</div>
	
	<div id="final"> 
		<h2> Portal Absensi </h2>
		<div id="success">
		<p> Anda <b>Telah Absen Kehadiran dengan baik!</b> </p>
		<img src="/assets/img/good.gif" />
		</div>

		<div id="failed">
		<p> Data <b>Absen Gagal!</b> </p>
		<img src="/assets/img/bad.gif" />
		</div>

	</div>

	<div id="exit" class="container">
		<h2> Portal Absensi </h2>
			<img src="/assets/img/bye.gif" />
			<label> Selamat berjumpa kembali nanti! </label>
			<p >autoclose dalam <span class="detik">5 detik. </span></p>
	</div>

</body>

</html>