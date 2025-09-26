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
    <title>Upgrade Membership Akun - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>/assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/custom-package-style.css<?=$rnum?>" rel="stylesheet"/>
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
                  Upgrade Membership Akun
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="table-responsive d-none d-md-block">

                <table class="table table-vcenter table-bordered table-nowrap card-table">
                  <thead>
                    <tr>
                      <td class="w-50">
                        <h2>Paket pilihan sesuai kebutuhan anda!</h2>
                        <div class="text-muted text-wrap">
                          Pilihlah paket yang disediakan dengan kelengkapan fitur yang memudahkan performa dan management bisnis yang anda miliki sekarang.
                        </div>
                      </td>
                        <td class="text-center">
                        <div class="text-uppercase text-muted font-weight-medium">Gratis</div>
                        <div class="display-6 fw-bold my-3">Rp.0</div>
                        <a href="#" class="btn w-100">Terpakai</a>
                      </td>
                      <td class="text-center">
                        <div class="text-uppercase text-muted font-weight-medium">Sederhana</div>
                        <div class="display-6 fw-bold my-3">Rp.50rb</div>
                        <a href="<?=base_url();?>upgrade-akun/sederhana" btn_sederhana_disabled class="btn <?= $btn_sederhana_disabled ?> <?= $btn_sederhana ?> w-100">Daftarkan</a>
                      </td>
                      <td class="text-center">
                        <div class="text-uppercase text-muted font-weight-medium">Developer</div>
                        <div class="display-6 fw-bold my-3">Rp.150rb</div>
                        <a href="<?=base_url();?>upgrade-akun/developer" class="btn <?= $btn_developer_disabled ?> <?= $btn_developer ?> w-100">Daftarkan</a>
                      </td>
                      <td class="text-center">
                        <div class="text-uppercase text-muted font-weight-medium">Ultimate</div>
                        <div class="display-6 fw-bold my-3">Rp.450rb</div>
                        <a href="<?=base_url();?>upgrade-akun/ultimate" class="btn <?= $btn_ultimate ?> <?=$btn_ultimate_disabled;?> w-100">Daftarkan</a>
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="bg-light">
                      <th colspan="4" class="subheader">Fitur Yang Disediakan</th>
                    </tr>
                    <tr>
                      <td >Absensi Realtime</td>
                       <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                    </tr>
                    <tr>
                      <td>Mode Checkpoint</td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                    </tr>
                    <tr>
                      <td>Quota Data Karyawan</td>
                      <td class="text-center">
                        5
                      </td>
                      <td class="text-center">
                        25
                      </td>
                      <td class="text-center">
                        100
                      </td>
                      <td class="text-center">
                        &gt; 1000
                      </td>
                    </tr>
                     <tr>
                      <td>Integrasi Sistem</td>
                       <td class="text-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                      </td>
                      <td class="text-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                      </td>
                      <td class="text-center">
                         Balanced
                      </td>
                      <td class="text-center">
                        Unlimited
                      </td>
                    </tr>
                    <tr class="bg-light">
                      <th colspan="4" class="subheader">Customisasi Checkpoint</th>
                    </tr>
                    <tr>
                      <td>Bebas watermark</td>
                        <td class="text-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                    </tr>
                    <tr>
                      <td>GPS Report</td>
                        <td class="text-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                    </tr>
                    <tr class="bg-light">
                      <th colspan="4" class="subheader">Notifikasi</th>
                    </tr>
                    <tr>
                      <td>Email</td>
                         <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/x -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/x -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/x -->
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                    </tr>
                    <tr>
                      <td>Whatsapp</td>
                      <td class="text-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/x -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                       <td>
                        <a href="#" class="btn w-100">Terpakai</a>
                      </td>
                      <td>
                        <a href="<?=base_url();?>upgrade-akun/sederhana" class="btn <?= $btn_sederhana ?> <?=$btn_sederhana_disabled;?> w-100">Pilih Paket Ini</a>
                      </td>
                      <td>
                        <a href="<?=base_url();?>upgrade-akun/developer" class="btn <?= $btn_developer ?> <?=$btn_developer_disabled;?> w-100">Pilih Paket Ini</a>
                      </td>
                      <td>
                        <a href="<?=base_url();?>upgrade-akun/ultimate" class="btn <?= $btn_ultimate ?> <?=$btn_ultimate_disabled;?> w-100">Pilih Paket Ini</a>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <div class="d-block d-md-none">
              <!-- Versi card (mobile) -->
              <div class="card mb-3">
                <div class="card-header">
                   <h2 class="mb-0">Paket Pilihan sesuai kebutuhan!</h2>
                </div>
                <div class="card-body">
                  <p>
                    Pilihlah paket yang disediakan dengan kelengkapan fitur yang memudahkan performa dan management bisnis yang anda miliki sekarang.
                  </p>
                </div>
              </div>

              <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">Paket : Gratis</h3>
                  <span class="badge bg-warning text-dark fs-5">Rp.0</span>
                </div>
                <div class="card-body">
                  <p>Absensi Realtime: ✔</p>
                  <p>Mode Checkpoint: ✔</p>
                  <p>Quota Data Karyawan: 5</p>
                  <p>Integrasi Sistem: ✖</p>
                  <p>Bebas Watermark: ✖</p>
                  <p>GPS Report: ✖</p>
                  <p>Notifikasi Email: ✔</p>
                  <p>Notifikasi Whatsapp: ✖</p>
                  <a href="#" class="btn btn-secondary w-100">Terpakai</a>
                </div>
              </div>

               <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">Paket : Sederhana</h3>
                  <span class=" text-dark fs-5">Rp.50rb</span>
                </div>
                <div class="card-body">
                  <p>Absensi Realtime: ✔</p>
                  <p>Mode Checkpoint: ✔</p>
                  <p>Quota Data Karyawan: 25</p>
                  <p>Integrasi Sistem: ✖</p>
                  <p>Bebas Watermark: ✔</p>
                  <p>GPS Report: ✔</p>
                  <p>Notifikasi Email: ✔</p>
                  <p>Notifikasi Whatsapp: ✖</p>
                  <a href="<?=base_url();?>upgrade-akun/sederhana" class="btn btn-secondary w-100 <?=$btn_sederhana_disabled;?> <?= $btn_sederhana ?>">Daftarkan</a>
                </div>
              </div>

                <div class="card mb-3">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">Paket : Developer</h3>
                  <span class=" text-dark fs-5">Rp.150rb</span>
                </div>
                <div class="card-body">
                  <p>Absensi Realtime: ✔</p>
                  <p>Mode Checkpoint: ✔</p>
                  <p>Quota Data Karyawan: 100</p>
                  <p>Integrasi Sistem: Balanced</p>
                  <p>Bebas Watermark: ✔</p>
                  <p>GPS Report: ✔</p>
                  <p>Notifikasi Email: ✔</p>
                  <p>Notifikasi Whatsapp: ✔</p>
                  <a href="<?=base_url();?>upgrade-akun/developer" class="btn btn-secondary w-100 <?=$btn_developer_disabled;?> <?= $btn_developer ?>">Daftarkan</a>
                </div>
              </div>


                <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">Paket : Ultimate</h3>
                  <span class=" text-dark fs-5">Rp.450rb</span>
                </div>
                <div class="card-body">
                  <p>Absensi Realtime: ✔</p>
                  <p>Mode Checkpoint: ✔</p>
                  <p>Quota Data Karyawan: >1000</p>
                  <p>Integrasi Sistem: Unlimited</p>
                  <p>Bebas Watermark: ✔</p>
                  <p>GPS Report: ✔</p>
                  <p>Notifikasi Email: ✔</p>
                  <p>Notifikasi Whatsapp: ✔</p>
                  <a href="<?=base_url();?>upgrade-akun/ultimate" class="btn btn-secondary w-100 <?=$btn_ultimate_disabled;?> <?= $btn_ultimate ?>">Daftarkan</a>
                </div>
              </div>

              <!-- ulangi untuk paket lainnya -->
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