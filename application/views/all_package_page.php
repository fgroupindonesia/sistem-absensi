<?php $rnum = "?" . rand(1000, 9999); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Upgrade Paket - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
    <style>
      @import url('/css/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body >
    <script src="/js/demo-theme.min.js<?=$rnum?>"></script>
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
                  Upgrade Akun
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="table-responsive">
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
                        <div class="text-uppercase text-muted font-weight-medium">Sederhana</div>
                        <div class="display-6 fw-bold my-3">Rp.50rb</div>
                        <a href="#" class="btn <?= $btn_sederhana ?> w-100">Daftarkan</a>
                      </td>
                      <td class="text-center">
                        <div class="text-uppercase text-muted font-weight-medium">Developer</div>
                        <div class="display-6 fw-bold my-3">Rp.150rb</div>
                        <a href="#" class="btn <?= $btn_developer ?> w-100">Daftarkan</a>
                      </td>
                      <td class="text-center">
                        <div class="text-uppercase text-muted font-weight-medium">Ultimate</div>
                        <div class="display-6 fw-bold my-3">Rp.450rb</div>
                        <a href="#" class="btn <?= $btn_ultimate ?> w-100">Daftarkan</a>
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="bg-light">
                      <th colspan="4" class="subheader">Fitur Yang Disediakan</th>
                    </tr>
                    <tr>
                      <td>Absensi Realtime</td>
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
                    <tr>
                      <td>Quota Data Karyawan</td>
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
                         Limited
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
                      <td class="text-center"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                      </td>
                    </tr>
                    <tr>
                      <td>Whatsapp</td>
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
                        <a href="/upgrade-akun/sederhana" class="btn <?= $btn_sederhana ?> w-100">Pilih Paket Ini</a>
                      </td>
                      <td>
                        <a href="/upgrade-akun/developer" class="btn <?= $btn_developer ?> w-100">Pilih Paket Ini</a>
                      </td>
                      <td>
                        <a href="/upgrade-akun/ultimate" class="btn <?= $btn_ultimate ?> w-100">Pilih Paket Ini</a>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
       <?php include('footer.php'); ?>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/js/tabler.min.js<?=$rnum?>" defer></script>
    <script src="/js/demo.min.js<?=$rnum?>" defer></script>
  </body>
</html>