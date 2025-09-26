<?php
 $rnum = "?" . rand(1000, 9999); 
 // ini untuk memudahkan all Script JS bawahan
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8"/>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta http-equiv="Content-Security-Policy" content="
  default-src * 'self';
  script-src 'self' 'unsafe-inline';
  style-src * 'self' 'unsafe-inline';
  img-src * 'self' data: 'self';
  connect-src *;">

    <title>Dashboard - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>/assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/dataTables.dataTables.min.css<?=$rnum?>" rel="stylesheet"/>

    
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<link href="<?=base_url();?>/assets/css/leaflet.css<?=$rnum?>" rel="stylesheet"/>

    <link href="<?=base_url();?>/assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
     <link href="<?=base_url();?>/assets/css/custom-style.css<?=$rnum?>" rel="stylesheet"/>


    <style>
      @import url('<?=base_url();?>/assets/css/inter.css');
      :root {
        --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body data-token="<?= $public_token; ?>"  >
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
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Dashboard
                 </div>
                <h2 class="page-title">
                  Overall Summary
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  
                  <button id="btn-add-staff" href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-staff">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add New Staff
                  </button>

                  <button href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-checkpoint" >
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add New Checkpoint
                  </button>

                  <div class="dropdown d-sm-none">
                  <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    Actions
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-staff">Add New Staff</a>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-checkpoint">Add New Checkpoint</a>
                  </div>
                </div>

                 
                </div>
              </div>

            </div>
          </div>
        
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              <!-- Attendance Card -->
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Persentase Kehadiran</div>
                      <div class="ms-auto lh-1">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown">Last 7 days</a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item active" href="#">Last 7 days</a>
                            <a class="dropdown-item" href="#">Last 30 days</a>
                            <a class="dropdown-item" href="#">Last 3 months</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="h1 mb-3"><span id="dashboard-persentase-kehadiran">0%</span></div>
                    <div class="progress progress-sm">
                      <div id="dashboard-persentase-kehadiran-progress" class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Active Staff Card -->
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Staff Hadir</div>
                      <div class="ms-auto lh-1">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown">Last 7 days</a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item active" href="#">Last 7 days</a>
                            <a class="dropdown-item" href="#">Last 30 days</a>
                            <a class="dropdown-item" href="#">Last 3 months</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-0 me-2"><span id="dashboard-total-staff-aktif">0 Staff</span></div>
                    </div>
                  </div>
                  <div id="chart-revenue-bg" class="chart-sm"></div>
                </div>
              </div>

              <!-- Unrecorded Staff Card -->
              <div class="col-sm-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="subheader">Staff Tidak Terdata</div>
                      <div class="ms-auto lh-1">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown">Last 7 days</a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item active" href="#">Last 7 days</a>
                            <a class="dropdown-item" href="#">Last 30 days</a>
                            <a class="dropdown-item" href="#">Last 3 months</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                      <div class="h1 mb-3 me-2"><span id="dashboard-total-staff-tidak-terdata">0%</span></div>
                    </div>
                    <div id="chart-new-clients" class="chart-sm"></div>
                  </div>
                </div>
              </div>

              <!-- Small Cards -->
              <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-primary text-white avatar">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-6" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12v3.5" /><path d="M12 7v5" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">Total Staff Paling Awal</div>
                            <div class="text-muted"><span id="total_early_staff"> ? </span> staff</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-green text-white avatar">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-time-duration-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12v.01" /><path d="M7.5 19.8v.01" /><path d="M4.2 16.5v.01" /><path d="M4.2 7.5v.01" /><path d="M12 21a8.994 8.994 0 0 0 6.362 -2.634m1.685 -2.336a9 9 0 0 0 -8.047 -13.03" /><path d="M3 3l18 18" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">Total Staff Terlambat</div>
                            <div class="text-muted"><span id="total_late_staff"> ? </span> staff</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-twitter text-white avatar">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-7" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12l-2 3" /><path d="M12 7v5" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">Total Staff On-time</div>
                            <div class="text-muted"><span id="total_ontime_staff"> ? </span> staff</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-facebook text-white avatar">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-type-pdf" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" /><path d="M17 18h2" /><path d="M20 15h-3v6" /><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" /></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">Download Laporan</div>
                            <div class="text-muted">Click (PDF)</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Progress Bar Card -->
              <div class="col-lg-6">
                <div class="row row-cards">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <p id="quota-text" class="mb-3"></p>
                        <div id="progress-bar-container" class="progress progress-separated mb-3"></div>
                        <div id="progress-labels" class="row"></div>
                        <input type="hidden" id="public_token" value="placeholder-token" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Upgrade Account Card -->
              <div class="col-12">
                <div class="card card-md">
                  <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-primary">
                        <?php if($akses->getMembershipName() == 'gratis'):?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <rect x="4" y="5" width="16" height="16" rx="2" />
                    <line x1="16" y1="3" x2="16" y2="7" />
                    <line x1="8" y1="3" x2="8" y2="7" />
                    <line x1="4" y1="11" x2="20" y2="11" />
                    <path d="M9 16l2 2l4 -4" />
                  </svg>
                <?php else : ?>
                  <img src="<?= base_url();?>assets/img/badge<?= $akses->getMembershipLogo(); ?>" >
                <?php endif;?>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row align-items-center">
                      
                      <div class="col-10">

                        <p> Membership Akun Anda : <b id="membership-account"><?= $akses->getMembershipName(); ?></b>. </p>

                        <?php if($akses->getMembershipName() == 'gratis'
                      || $akses->getMembershipName() != 'ultimate'): ?>
                        <h3 class="h1">Upgrade Akun</h3>
                        <div class="markdown text-muted">
                          Upgrade akun anda agar mendapatkan fitur lebih lengkap!
                        </div>
                        <div class="mt-3">
                          <a id="link-upgrade-account" href="#" class="btn btn-primary" id="link-upgrade-account">Upgrade Akun</a>
                        </div>
                      <?php endif; ?>    
                      </div>

                    

                    </div>
                  </div>
                </div>
              </div>

              <!-- Attendance Summary Table -->
              <div class="col-12">
  <div class="card">
  <div class="card-header">
    <h3 class="card-title">Intensitas Kehadiran Karyawan</h3>
    <h6 class="text-muted">Bulan ini</h6>
  </div>

    
    <!-- Table view (desktop) -->
    <div id="view-table" class="card-table table-responsive">
      <table id="table-summary" class="table table-bordered">
        <thead>
          <tr>
            <th>Nama Karyawan</th>
            <th>Total Kehadiran</th>
            <th>Total Bolos</th>
            <th>Persentase Kehadiran (%)</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    
    <!-- Card view (mobile) -->
    <div id="view-card" class="p-2" style="display:none;">
      <div id="card-container"></div>
    </div>

  </div>
</div>


            </div>
          </div>
        </div>
       <?php include('footer.php'); ?>
      </div>
    </div>
   
    <?php include('modal_bugs.php'); ?>
    <?php include('modal_staff.php'); ?>
    <?php include('modal_checkpoint.php'); ?>
    <?php include('modal_konsultasi.php'); ?>
    <?php include('modal_divisi.php'); ?>


    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?=base_url();?>assets/js/jspdf.umd.min.js<?=$rnum?>" ></script>
      <script src="<?=base_url();?>assets/js/tabler.min.js<?=$rnum?>" defer></script>
      <script src="<?=base_url();?>assets/js/demo.min.js<?=$rnum?>" defer></script>
      <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js<?=$rnum?>" ></script>
     
     <script src="<?=base_url();?>assets/js/dataTables.min.js<?=$rnum?>" ></script>     
     <script src="<?=base_url();?>assets/js/sweetalert2@11.js<?=$rnum?>" ></script>

     <script src="<?=base_url();?>assets/js/leaflet.norm.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/map-osm.js<?=$rnum?>" ></script>
     
     <script src="<?=base_url();?>assets/js/form-actions.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/division-works.js<?=$rnum?>" ></script>     
     <script src="<?=base_url();?>assets/js/dashboard-summary.js<?=$rnum?>" ></script>     
     
     


  </body>
</html>