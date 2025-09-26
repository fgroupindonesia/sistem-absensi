
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Notifikasi Pendaftaran User Baru</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      background-color: #ffffff;
      margin: 40px auto;
      padding: 20px;
      max-width: 600px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .header {
      background-color: #FF9800;
      padding: 15px;
      color: white;
      text-align: center;
      border-radius: 8px 8px 0 0;
    }
    .content {
      padding: 20px;
      color: #333333;
    }
    .btn {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 20px;
      background-color: #FF9800;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    .footer {
      font-size: 12px;
      color: #888888;
      text-align: center;
      padding: 10px;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Pengguna Baru Telah Mendaftar</h2>
    </div>
    <div class="content">
      <p>Halo Admin,</p>
      <p>Telah terjadi pendaftaran akun baru di <strong>Sistem Kehadiran</strong>.</p>
      <ul>
        <li><strong>Nama Pengguna:</strong> <?= $username; ?></li>
        <li><strong>Jenis Akun:</strong> <?= $jenis; ?></li>
        <li><strong>Tanggal Daftar:</strong> <?= $date; ?></li>
      </ul>
      <p>Silakan pantau akun ini melalui halaman manajemen berikut:</p>

      <p style="text-align:center;">
        <a class="btn" href="<?= $link; ?>">Kelola Pengguna Baru</a>
      </p>
    </div>
    <div class="footer">
      Email ini dibuat secara otomatis pada: <br>
      <?= $date; ?><br>
      <em>Automatic Notification by FGroupIndonesia</em>
    </div>
  </div>
</body>
</html>
