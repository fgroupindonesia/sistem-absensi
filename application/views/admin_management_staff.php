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
    <title>Management Staff - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>/assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>

    <link href="<?=base_url();?>/assets/css/dataTables.dataTables.min.css<?=$rnum?>" rel="stylesheet"/>

    
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <link href="<?=base_url();?>/assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
     <link href="<?=base_url();?>/assets/css/custom-style.css<?=$rnum?>" rel="stylesheet"/>


    <style>
      @import url('<?=base_url();?>/assets/css/inter.css');
      :root {
        --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body data-token="<?= $public_token; ?>" >
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
                  Management Staff
                 </div>
                <h2 class="page-title">
                  View All
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

                   <?php if(!empty($data_staff) && is_array($data_staff)): ?>
                   <button data-token="<?= $akses->getPublicToken(); ?>"  class="btn-delete-staff btn btn-danger d-none d-sm-inline-block" title="Delete">
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
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-staff">Add New Staff</a>
        
                  <?php if(!empty($data_staff) && is_array($data_staff)): ?>

                    <a data-token="<?= $akses->getPublicToken(); ?>" class="dropdown-item btn-delete-staff" >Delete</a>

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
                    <h3 class="card-title">Data Seluruh Staff </h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                    
                    </div>

                  </div>
                 <div class="table-responsive d-none d-md-block">
  <table id="table-staff" class="table card-table table-vcenter text-nowrap datatable">
    <thead>
      <tr>
        <th>
          <input type="checkbox" value="all" class="form-check-input me-2 staff-all">
        </th>
        <th>No.</th>
        <th>Nama Staff</th>
        <th>Unit Divisi</th>
        <th>Kontak WA</th>
        <th>Email</th>
        <th>Status</th>
        <th>Device</th>
        <th>Catatan</th>
        <th>-</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($data_staff) && is_array($data_staff)): ?>
        <?php $nomer=1; foreach ($data_staff as $staff): ?>
          <tr class="staff-row">
            <td><input type="checkbox" data-name="<?=$staff->name; ?>" value="<?=$staff->id; ?>" class="form-check-input me-2 staff-id"></td>
            <td><?= $nomer++; ?></td>
            <td><?= $staff->name; ?></td>
            <td><?= $staff->unit_division; ?></td>
            <td><?= $staff->whatsapp; ?></td>
            <td>
              <i class="fa-solid fa-envelope" data-email="<?= $staff->email; ?>"></i>
            </td>
            <td>
              <?php if($staff->status == 'active') : ?>
                <span class="badge bg-success"><?= $staff->status; ?></span>
              <?php else : ?>
                <span class="badge bg-secondary"><?= $staff->status; ?></span>
              <?php endif; ?>
            </td>
             <?php if($staff->device_tag != null) : ?>
                <td>Installed</td>
              <?php else : ?>
                <td>-</td>
            <?php endif; ?>
            <td><?= $staff->notes; ?></td>
            <td class="text-end">
              <div class="dropdown">
                <button class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</button>
                <div class="dropdown-menu dropdown-menu-end">
                  <a data-bs-toggle="modal" data-bs-target="#modal-staff" data-id="<?= $staff->id; ?>" data-token="<?= $staff->public_token; ?>" class="dropdown-item link-edit-staff" href="#">Edit</a>
                  
                  <?php if($staff->status != 'active') : ?>
                    <a data-id="<?= $staff->id; ?>" data-token="<?= $staff->public_token; ?>" class="dropdown-item link-activate-staff" href="#" data-type="activate" >Activate</a>
                  <?php endif; ?>

                  <?php if($staff->status == 'active') : ?>
                    <a data-id="<?= $staff->id; ?>" data-token="<?= $staff->public_token; ?>" class="dropdown-item link-activate-staff" href="#">Turn Off</a>
                  <?php endif; ?>

                  <a data-id="<?= $staff->id; ?>" data-token="<?= $staff->public_token; ?>" class="dropdown-item link-delete-staff" href="#">Delete</a>

                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      
    </tbody>
  </table>

</div>




<!-- versi mobile: card -->
<div class="d-block d-md-none">

<input type="text" id="search-card" class="form-control mb-3" placeholder="Cari staff...">

  <div class="row" id="card-staff-container">
    <?php if (!empty($data_staff) && is_array($data_staff)): ?>
      <?php foreach ($data_staff as $staff): ?>
        <div class="col-12 mb-3 staff-card">
          <div class="card">

            <div class="card-body">
              <div class="d-flex align-items-center mb-2">
                <input type="checkbox" data-name="<?=$staff->name; ?>" value="<?=$staff->id; ?>" class="form-check-input me-2 staff-id">
                <h3 class="card-title staff-name mb-0">
                  Nama : <?= $staff->name; ?>
                </h3>
              </div>

              <p class="text-muted mb-1 staff-division"><strong>Divisi:</strong> <?= $staff->unit_division; ?></p>
              <p class="mb-1"><i class="fa-brands fa-whatsapp"></i> <?= $staff->whatsapp; ?></p>
              <p class="mb-1"><i class="fa-solid fa-envelope"></i> <?= $staff->email; ?></p>
              <p class="mb-1">
                <span class="badge <?= $staff->status=='active'?'bg-success':'bg-secondary'; ?>">
                  <?= $staff->status; ?>
                </span>
              </p>
              <p class="text-muted mb-1 staff-device-tag"><strong>Device:</strong> <?= $staff->device_tag ?? '-'; ?></p>

              <p class="mb-2"><strong>Catatan:</strong> <?= $staff->notes; ?></p>
              <div class="btn-group w-100">
               <a href="#" 
                 data-bs-toggle="modal" data-bs-target="#modal-staff" 
                   class="btn btn-sm btn-outline-primary link-edit-staff" 
                   data-id="<?= $staff->id; ?>" 
                   data-token="<?= $staff->public_token; ?>">
                   Edit
                </a>

                <a href="#" 
                   class="btn btn-sm btn-outline-danger link-delete-staff" 
                   data-id="<?= $staff->id; ?>" 
                   data-token="<?= $staff->public_token; ?>">
                   Delete
                </a>

                <?php if($staff->device_tag != null) : ?>
                  <a href="#" 
                     class="btn btn-sm btn-outline-success link-reset-device-staff" 
                     data-id="<?= $staff->id; ?>" 
                     data-token="<?= $staff->public_token; ?>" 
                     data-type="reset">
                     Reset
                  </a>
               
                <?php endif; ?>

                <?php if($staff->status != 'active') : ?>
                  <a href="#" 
                     class="btn btn-sm btn-outline-success link-activate-staff" 
                     data-id="<?= $staff->id; ?>" 
                     data-token="<?= $staff->public_token; ?>" 
                     data-type="activate">
                     Activate
                  </a>
                <?php else: ?>
                  <a href="#" 
                     class="btn btn-sm btn-outline-warning link-activate-staff" 
                     data-id="<?= $staff->id; ?>" 
                     data-token="<?= $staff->public_token; ?>" >
                     Turn Off
                  </a>
                <?php endif; ?>

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
    <script src="<?=base_url();?>assets/js/tabler.min.js<?=$rnum?>" defer></script>
    <script src="<?=base_url();?>assets/js/demo.min.js<?=$rnum?>" defer></script>
     <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js<?=$rnum?>" ></script>
     
     <script src="<?=base_url();?>assets/js/dataTables.min.js<?=$rnum?>" ></script>     
     <script src="<?=base_url();?>assets/js/sweetalert2@11.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/form-actions.js<?=$rnum?>" ></script>
     <script src="<?=base_url();?>assets/js/division-works.js<?=$rnum?>" ></script>     
     <script src="<?=base_url();?>assets/js/staff-works.js<?=$rnum?>" ></script>     


  </body>
</html>