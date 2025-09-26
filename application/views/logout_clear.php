<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Redirecting…</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

  <!-- fallback kalau JS mati -->
  <meta http-equiv="refresh" content="3;url=<?= base_url();?>portal/admin">
</head>

<style>
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.custom-spin {
  display: inline-block;
  animation: spin 1s linear infinite;
}
</style>

<body class="d-flex justify-content-center align-items-center vh-100 bg-dark text-light">
  <div class="text-center">
    <i class="fa-solid fa-spinner custom-spin fa-2x"></i>
    <h4>Penyimpanan seluruh data...</h4>
    <p>Tunggu sebentar dalam <span id="sec">3</span> detik.</p>
  </div>

  <script>
  	localStorage.removeItem('isLoggedIn');

    const TARGET_URL = '<?= base_url();?>portal/admin'; // ganti URL tujuan
    const DELAY_MS   = 3000;

    const secEl = document.getElementById('sec');

    let remaining = Math.ceil(DELAY_MS / 1000);
    secEl.textContent = remaining;

    const interval = setInterval(() => {
      remaining--;
      secEl.textContent = remaining;
      if (remaining <= 0) {

        clearInterval(interval);
        window.location.href = TARGET_URL;
      }
    }, 1000);
  </script>
</body>
</html>
