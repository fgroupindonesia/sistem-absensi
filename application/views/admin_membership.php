<?php $rnum = "?" . rand(1000, 9999); 
// ini untuk memudahkan all Script JS bawahan
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Membership - Settings - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>/assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
    <style>
      @import url('<?=base_url();?>/assets/css/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body >
    <script src="<?=base_url();?>/assets/js/demo-theme.min.js<?=$rnum?>"></script>
    <div class="page">
      <!-- Navbar -->
       <?php include('header.php'); ?>
       <?php include('nav_bar.php'); ?>
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Settings
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
       <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                 <?php include('nav_settings.php'); ?>
                </div>
                <div class="col d-flex flex-column">
                  <div class="card-body">
                    <h2 class="mb-4">Membership</h2>
                    <h3 class="card-title">Akun Saat Ini</h3>
                    <div class="row align-items-center">
                      <div class="col-auto"><img class="avatar avatar-xl" src="<?=base_url();?>/assets/img/membership/<?= $this->akses->getMembershipLogo() ;?>" >
                      </div>
                      <div class="col-auto"><a href="#" class="btn">
                          Upgrade Akun
                        </a></div>
                      
                    </div>
                    <h3 class="card-title mt-4">Features Activated </h3>
                    <div class="row g-3">
                    
                      <div class="col-md">
                        <div class="form-label">Absensi Realtime</div>
                        <input type="checkbox" id="realtime-attendance" class="" > Active
                      </div>
                      <div class="col-md">
                        <div class="form-label">Checkpoint</div>
                        <input type="radio" value="checkpoint-default"> Default | 
                        <input type="radio" value="checkpoint-global"> Global
                      </div>
                    </div>

                    <div class="row">
                    
                      <div class="col-md">
                        <div class="form-label">Customisasi Checkpoint</div>
                        <input type="checkbox" id="realtime-attendance" class="" > Active
                      </div>
                      <div class="col-md">
                        <div class="form-label">GPS Report</div>
                        <input type="checkbox" id="realtime-attendance" class="" > Active
                      </div>

                    </div>

                    <div class="row">
                    
                    <div class="col-md">
                      <div class="form-label">Whatsapp Notification</div>
                      <input type="checkbox" id="realtime-attendance" class="" > Active
                    </div>
                    <div class="col-md">
                      <div class="form-label">Integrasi Multiplatform</div>
                      <input type="checkbox" id="realtime-attendance" class="" > Active
                    </div>

                  </div>

                    <h3 class="card-title mt-4">Quota Limit</h3>
                    <p class="card-subtitle">Limit quota data karyawan anda ialah <b><span> 100  </span> data entry.</b></p>
                    <div>
                      
                      <div class="row g-2">
                       
                        <div class="col-auto">
                        <h4>Terpakai </h4>
                          <input type="numeric" readonly class="form-control plaintext w-fit" value="2">
                        </div>
                      </div>
                    </div>
                   
                    
                  <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                      <a href="#" class="btn">
                        Cancel
                      </a>
                      <a href="#" class="btn btn-primary">
                        Submit
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       <?php include('footer.php'); ?>
      </div>
    </div>
     <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?=base_url();?>/assets/js/tabler.min.js<?=$rnum?>" defer></script>
    <script src="<?=base_url();?>/assets/js/demo.min.js<?=$rnum?>" defer></script>
  </body>
</html>