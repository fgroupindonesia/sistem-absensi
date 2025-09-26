<?php 
$v = "?" . rand(1000, 9999); 
// ini untuk memudahkan all Script JS bawahan
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QR Code - Absensi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .qr-container {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }
    .qr-img {
      max-width: 100%;
      width: 300px;
      height: auto;
    }
    footer {
      text-align: center;
      padding: 1rem;
      background-color: #f8f9fa;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="qr-container text-center">
  <h1>Sistem Kehadiran</h1>
  
  <h3>Checkpoint </h3>
  <h4> <?= $event_name; ?> </h4>
<hr>
<p> Mode : Dinamis </p>
    <input type="hidden" value="<?= $token ?? ''; ?>" id="public_token" >
    <input type="hidden" value="<?= $id ?? ''; ?>" id="id" >

    <img id="qrcode" src="<?= $path ?? ''; ?>" alt="QR Code" class="qr-img mb-3">
    <div id="loadingSpinner" class="mt-3" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p>Memuat QR Code baru...</p>
    </div>

    <a href="#" onclick="window.close();" class="btn btn-danger">Close this page</a>
    <p id="message-recalibrate">Recalibrate after <span id="time-second"> </span> </p>
  </div>

  <footer>
    Sistem Absensi - Solusi Digital - FGroupIndonesia
  </footer>

  <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js<?= $v ;?>" ></script>
  <script src="<?=base_url();?>assets/js/dynamic-frame.js<?= $v ;?>" ></script>

</body>
</html>
