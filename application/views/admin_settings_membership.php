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

                   
                  </div>
                  
                  <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                      <a href="#" class="btn">
                        Cancel
                      </a>
                      <a href="#" id="btn-submit" class="btn btn-primary">
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
    <script src="<?=base_url();?>/assets/js/jquery-3.7.1.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>/assets/js/tabler.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>/assets/js/demo.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>/assets/js/sweetalert2@11.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>/assets/js/admin-settings.js<?=$rnum?>" ></script>
  

  </body>
</html>