<!DOCTYPE html>
<html lang="en">
<head>
  <title>Install - Sistem Absensi</title>
   <!--Made with love by FGroupIndonesia  -->

  <script src="/assets/js/jquery-3.3.1.min.js"></script>
   
<link id="bootstrap-css" rel="preload" href="/assets/css/bootstrap.min.css"  as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/assets/css/bootstrap.min.css" ></noscript>

  
  <script src="/assets/js/bootstrap.min.js"></script>

  <link rel="manifest" href="/manifest.json">

<meta name="description" content="Install - Sistem Absensi. A Clever way to add Attendance system to your mobile device quickly and safely!">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#088aff">

<link rel="shortcut icon" href="/assets/img/favicon.png" type="image/png">
<link rel="apple-touch-icon" href="/assets/img/favicon.png" type="image/png">
    
    <!--Fontawesome CDN-->
  <link rel="stylesheet" href="/assets/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="/assets/css/admin_login.css">
</head>
<body>
<div class="container">
  <div class="d-flex justify-content-center h-100">
    <div class="card">
      <div class="card-header middle-install">
        <center>
        <h3>Install Sistem Absensi</h3>
        <img id="gambar" alt="installation Sistem Absensi" src="/assets/img/phone_install.png" /> <br>
        <a id="link-portal" style="color:white;" href="/portal">Click Here to access</a>
        </center>
      </div>
    </div>
  </div>
</div>

<script>

function isRunningStandalone() {
   
 return ["fullscreen", "standalone", "minimal-ui"].some(
        (displayMode) => window.matchMedia('(display-mode: ' + displayMode + ')').matches
    );


}

            var BASE_URL = '<?= base_url() ?>';
            document.addEventListener('DOMContentLoaded', init, false);
           
            function init() {
                if ('serviceWorker' in navigator && navigator.onLine) {
                    navigator.serviceWorker.register( '/sw.js')
                    .then((reg) => {
                        console.log('Registrasi service worker Berhasil', reg);
                    }, (err) => {
                        console.error('Registrasi service worker Gagal', err);
                    });
                }
                
                 if(!isRunningStandalone()){
                    var link = document.getElementById('link-portal');
                    link.style.display = 'none'; 
                }else{
                    var img = document.getElementById('gambar');
                    img.src = "/assets/img/phone_success.png";
                }     
                
            }
</script>

</body>
</html>