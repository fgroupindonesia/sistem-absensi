<?php $rnum = "?" . rand(1000, 9999); 
// ini untuk memudahkan all Script JS bawahan
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Management Checkpoint - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>/assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/leaflet.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
     <link href="<?=base_url();?>/assets/css/custom-style.css<?=$rnum?>" rel="stylesheet"/>

     <!-- Font Awesome 6.5.1 CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">


    <style>
      @import url('<?=base_url();?>/assets/css/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body data-token="<?= $akses->getPublicToken();?>" >
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
                  Management Checkpoint
                 </div>
                <h2 class="page-title">
                  View All
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  
                  <button id="btn-add-checkpoint" href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-checkpoint">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add New Checkpoint
                  </button>

                    <?php if(!empty($data_checkpoint) && is_array($data_checkpoint)): ?>
                    <button  class="btn-delete-checkpoint btn btn-danger d-none d-sm-inline-block" title="Delete">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="4" y1="7" x2="20" y2="7"/>
                        <line x1="10" y1="11" x2="10" y2="17"/>
                        <line x1="14" y1="11" x2="14" y2="17"/>
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                        <path d="M9 7v-3h6v3"/>
                      </svg>Delete
                    </button>
                      <?php endif; ?>
                 
                  <div class="dropdown d-sm-none">
                  <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    Actions
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-checkpoint">Add New Checkpoint</a>
                     <?php if(!empty($data_checkpoint) && is_array($data_checkpoint)): ?>

                    <a data-token="<?= $akses->getPublicToken(); ?>" class="dropdown-item btn-delete-checkpoint" >Delete</a>

                  <?php endif; ?>  
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
              
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Data Checkpoint</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                   
                  </div>

                 <div class="table-responsive d-none d-md-block">
                    <!-- Tabel hanya muncul di desktop -->
                    <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                      <tr>
                        <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all checkpoints"></th>
                        <th class="w-1">No.
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="6 15 12 9 18 15"></polyline>
                          </svg>
                        </th>
                        <th>QR Code</th>
                        <th>Patokan</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($data_checkpoint)): ?>
                        <?php $nomer = 1; ?>
                        <?php foreach ($data_checkpoint as $checkpoint): ?>
                          <tr>
                            <td><input data-id="<?= $checkpoint->id; ?>" class="checkbox-checkpoint form-check-input m-0 align-middle" type="checkbox" aria-label="Select checkpoint"></td>
                            <td><span class="text-muted"><?= $nomer; ?></span></td>
                            <td>
                              <?php if (!empty($checkpoint->qr_code)): ?>
                                <?php if ($checkpoint->jenis == 'statis'): ?>
                                <img data-bs-toggle="modal" data-bs-target="#modal-image-fullscreen" data-title="<?=$checkpoint->name;?>" class="qr-preview" src="<?=base_url();?>assets/img/qrcodes/<?= $checkpoint->qr_code; ?>" alt="QR Code" width="50" height="50">
                                <?php else: ?>
                                  <img data-link="<?=$checkpoint->url;?>" data-title="<?=$checkpoint->name;?>" class="link-qrcode-dinamis" src="<?=base_url();?>assets/img/qrcodes/<?= $checkpoint->qr_code; ?>" alt="QR Code" width="50" height="50">
                                <?php endif; ?>
                              <?php else: ?>
                                <span class="text-muted">No QR</span>
                              <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($checkpoint->patokan); ?></td>
                            <td><?= htmlspecialchars($checkpoint->name); ?></td>
                            <td><?= htmlspecialchars($checkpoint->jenis); ?></td>
                            <td>
                              <?php if($checkpoint->status == 'active') : ?>
                                <span class="badge bg-success me-1"></span>
                              <?php else : ?>
                                <span class="badge bg-secondary me-1"></span>
                              <?php endif;?>
                              <?= htmlspecialchars($checkpoint->status); ?>
                            </td>
                            <td class="text-end">
                              <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">Actions</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a data-token="<?= $checkpoint->public_token; ?>" data-id="<?= $checkpoint->id; ?>" class="dropdown-item link-edit-checkpoint" href="#" data-bs-toggle="modal" data-bs-target="#modal-checkpoint">Edit</a>
                                  <a data-name="<?= $checkpoint->name; ?>" data-id="<?= $checkpoint->id; ?>" class="dropdown-item link-delete-checkpoint" href="#" >Delete</a>
                                  <?php if($checkpoint->status != 'active'): ?>
                                  <a data-token="<?= $checkpoint->public_token; ?>" data-id="<?= $checkpoint->id; ?>" class="dropdown-item link-activate-checkpoint" href="#" data-bs-toggle="modal" data-bs-target="#modal-loading">Activate</a>
                                <?php endif; ?>

                                <?php if($checkpoint->status != 'inactive'): ?>
                                  <a data-token="<?= $checkpoint->public_token; ?>" data-id="<?= $checkpoint->id; ?>" class="dropdown-item link-turnoff-checkpoint" href="#" >Turn Off</a>
                                <?php endif; ?>

                                </div>
                              </span>
                            </td>
                          </tr>
                          <?php $nomer++; ?>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr><td colspan="8" class="text-center">Tidak ada data checkpoint</td></tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                  </div>

                  <div class="d-block d-md-none">
                    
  <?php if (!empty($data_checkpoint)): ?>
    <?php $nomer = 1; ?>
    <?php foreach ($data_checkpoint as $checkpoint): ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center">

            <!-- ✅ Checkbox tambahan -->
            <div class="form-check me-2">
              <input class="form-check-input checkbox-checkpoint" 
                     type="checkbox" 
                     name="checkpoint_ids[]" 
                     value="<?= $checkpoint->id; ?>" 
                     id="check<?= $checkpoint->id; ?>">
            </div>
            <!-- /checkbox -->

            <?php if (!empty($checkpoint->qr_code)): ?>
              <?php if ($checkpoint->jenis == 'statis'): ?>
                <img data-bs-toggle="modal" data-bs-target="#modal-image-fullscreen" data-title="<?=$checkpoint->name;?>" class="qr-preview" src="<?=base_url();?>assets/img/qrcodes/<?= $checkpoint->qr_code; ?>" alt="QR Code" width="50" height="50">
              <?php else: ?>
                <img data-link="<?=$checkpoint->url;?>" data-title="<?=$checkpoint->name;?>" class="link-qrcode-dinamis" src="<?=base_url();?>assets/img/qrcodes/<?= $checkpoint->qr_code; ?>" alt="QR Code" width="50" height="50">
              <?php endif; ?>
            <?php else: ?>
              <span class="text-muted">No QR</span>
            <?php endif; ?>

            <div class="card-detail-right">
              <h4 class="mb-1"><?= htmlspecialchars($checkpoint->name); ?></h4>
              <p class="mb-1 text-muted"><?= htmlspecialchars($checkpoint->patokan); ?></p>
              <span class="badge <?= $checkpoint->status == 'active' ? 'bg-success' : 'bg-secondary'; ?>">
                <?= htmlspecialchars($checkpoint->status); ?>
              </span>
            </div>
          </div>

          <div class="mt-3 d-flex flex-column">
            <small class="text-muted">Jenis: <?= htmlspecialchars($checkpoint->jenis); ?>.</small>
            <small class="text-muted">Dibuat pada : <?= tanggal_indonesia(htmlspecialchars($checkpoint->date_created)); ?></small>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Actions</button>
              <div class="dropdown-menu dropdown-menu-end">
                <a data-token="<?= $checkpoint->public_token; ?>" data-id="<?= $checkpoint->id; ?>" href="#" class="dropdown-item link-edit-checkpoint" data-bs-toggle="modal" data-bs-target="#modal-checkpoint">Edit</a>
                <a data-name="<?= $checkpoint->name; ?>" data-id="<?= $checkpoint->id; ?>" class="dropdown-item link-delete-checkpoint" href="#">Delete</a>
                <?php if($checkpoint->status != 'active'): ?>
                  <a data-token="<?= $checkpoint->public_token; ?>" data-id="<?= $checkpoint->id; ?>" href="#" class="dropdown-item link-activate-checkpoint">Activate</a>
                <?php endif; ?>
                <?php if($checkpoint->status != 'inactive'): ?>
                  <a data-token="<?= $checkpoint->public_token; ?>" data-id="<?= $checkpoint->id; ?>"  href="#" class="dropdown-item link-turnoff-checkpoint">Turn Off</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
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
    <?php include('modal_bugs.php'); ?>
    <?php include('modal_staff.php'); ?>
    <?php include('modal_checkpoint.php'); ?>
    <?php include('modal_konsultasi.php'); ?>
    <?php include('modal_image_fullscreen.php'); ?>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>assets/js/jspdf.umd.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>assets/js/tabler.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>assets/js/demo.min.js<?=$rnum?>" ></script>
     
     <script src="<?=base_url();?>assets/js/sweetalert2@11.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/leaflet.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/map-osm.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/form-actions.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/checkpoint-works.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/division-works.js<?=$rnum?>" ></script>


  </body>
</html>