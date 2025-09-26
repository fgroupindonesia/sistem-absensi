<?php
 $rnum = "?" . rand(1000, 9999); 
 // ini untuk memudahkan all Script JS bawahan
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Riwayat Penting - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>/assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>

    

    <link href="<?=base_url();?>/assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
     <link href="<?=base_url();?>/assets/css/custom-style.css<?=$rnum?>" rel="stylesheet"/>


    <style>
      @import url('<?=base_url();?>/assets/css/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body data-token="<?= $akses->getPublicToken(); ?>" >
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
                  Riwayat Penting
                 </div>
                <h2 class="page-title">
                  View All
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  
                  
                 
                </div>
              </div>
            </div>
          </div>
        
        </div>
        <!-- Page body -->
        <div class="page-body">

          <div class="container-xl">
            <div class="row row-deck row-cards">
              
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Data Riwayat</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                    
                     
                    </div>
                  </div>
                  <div class="table-responsive">
                  <?php if (!empty($bugs_reports)): ?>
                   <table id="table-bugs" class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr>
              <th>No.</th>
              <th>Judul</th>
              <th>Prioritas</th>
            
              <th>Screenshot</th>
              <th>URL</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($bugs_reports)): ?>
              <?php $no = 1; foreach ($bugs_reports as $bug): ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= htmlspecialchars($bug->title); ?></td>
                  <td>
                    <?php if ($bug->priority_bugs == '1'): ?>
                      <span class="badge bg-danger">Penting</span>
                    <?php else: ?>
                      <span class="badge bg-secondary">Biasa</span>
                    <?php endif; ?>
                  </td>
              
                  <td>
                    <?php if (!empty($bug->screenshot)): ?>
                      <a href="<?= base_url('uploads/screenshots/' . $bug->screenshot); ?>" target="_blank">Lihat</a>
                    <?php else: ?>
                      <span class="text-muted">-</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (!empty($bug->url)): ?>
                      <a href="<?= htmlspecialchars($bug->url); ?>" target="_blank"><?= htmlspecialchars($bug->url); ?></a>
                    <?php else: ?>
                      <span class="text-muted">-</span>
                    <?php endif; ?>
                  </td>
             <td>
  <?php if ($bug->status == 'pending'): ?>
    <span class="badge bg-warning">Pending</span>
  <?php elseif ($bug->status == 'under review'): ?>
    <span class="badge bg-info text-dark">Under Review</span>
  <?php elseif ($bug->status == 'cancelled'): ?>
    <span class="badge bg-danger">Cancelled</span>
  <?php elseif ($bug->status == 'accepted'): ?>
    <span class="badge bg-success">Accepted</span>
  <?php else: ?>
    <span class="badge bg-secondary"><?= ucfirst($bug->status); ?></span>
  <?php endif; ?>
</td>

                  <td><?= date('d M Y H:i', strtotime($bug->date_created)); ?></td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">Aksi</button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item" data-id="<?= $bug->id; ?>" data-token="<?= $bug->public_token; ?>">Detail</a>
                        <!-- Tambahan lain bisa ditaruh di sini -->
                      </div>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9" class="text-center text-muted">Belum ada laporan bugs.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
          <?php endif; ?>

  <?php if (!empty($consultations)): ?>
<table id="table-consultation" class="table card-table table-vcenter text-nowrap datatable">
  <thead>
    <tr>
      <th>No.</th>
      <th>Judul</th>
      <th>Status</th>
      <th>Deskripsi</th>
      <th>Tanggal</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($consultations)): ?>
      <?php $no = 1; foreach ($consultations as $item): ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= htmlspecialchars($item->title); ?></td>
     <td>
           <?php if ($item->status == 'pending'): ?>
    <span class="badge bg-warning">Pending</span>
  <?php elseif ($item->status == 'under review'): ?>
    <span class="badge bg-info text-dark">Under Review</span>
  <?php elseif ($item->status == 'cancelled'): ?>
    <span class="badge bg-danger">Cancelled</span>
  <?php elseif ($item->status == 'accepted'): ?>
    <span class="badge bg-success">Accepted</span>
  <?php else: ?>
    <span class="badge bg-secondary"><?= ucfirst($item->status); ?></span>
  <?php endif; ?>
</td>


          <td><?= nl2br(htmlspecialchars($item->description)); ?></td>
          <td><?= date('d M Y H:i', strtotime($item->date_created)); ?></td>
          <td class="text-end">
            <span class="dropdown">
              <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">Aksi</button>
              <div class="dropdown-menu dropdown-menu-end">
                <a href="#" class="dropdown-item" data-id="<?= $item->id; ?>" data-token="<?= $item->public_token; ?>">Detail</a>
              </div>
            </span>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="5" class="text-center text-muted">Belum ada pengajuan konsultasi.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>
   <?php endif; ?>

                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        
        </div>
       <?php include('footer.php'); ?>
      </div>
    </div>
    <?php include('popup-modals.php'); ?>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?=base_url();?>assets/js/tabler.min.js<?=$rnum?>" defer></script>
    <script src="<?=base_url();?>assets/js/demo.min.js<?=$rnum?>" defer></script>
     <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js<?=$rnum?>" ></script>
     
     <script src="<?=base_url();?>assets/js/sweetalert2@11.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/form-actions.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/division-works.js<?=$rnum?>" ></script>     


  </body>
</html>