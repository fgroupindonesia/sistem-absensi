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
    <title>Absensi Kehadiran - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
  <link href="<?=base_url();?>assets/css/dataTables.dataTables.min.css<?=$rnum?>" rel="stylesheet"/>
    <style>
      @import url('<?=base_url();?>assets/css/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body data-token="<?= $akses->getPublicToken(); ?>" >
    <script src="<?=base_url();?>assets/js/demo-theme.min.js<?=$rnum?>"></script>
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
                  Absensi Kehadiran
                </h2>
              </div>


               <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  
                 <button href="#" class="btn-koreksi-attendance btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" 
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" 
                         stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                      <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                      <path d="M16 5l3 3" />
                    </svg>
                    Koreksi Data
                  </button>


                   <?php if(!empty($data_attendance) && is_array($data_attendance)): ?>
                   <button data-token="<?= $akses->getPublicToken(); ?>"  class="btn-delete-attendance btn btn-danger d-none d-sm-inline-block" title="Delete">
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
                    <a class="dropdown-item btn-koreksi-attendance" >Koreksi Data</a>
        
                  <?php if(!empty($data_attendance) && is_array($data_attendance)): ?>

                    <a data-token="<?= $akses->getPublicToken(); ?>" class="dropdown-item btn-delete-attendance" >Delete</a>

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
                    <h3 class="card-title">Data Absensi</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                      <div class="text-muted">
                        Filter berdasarkan :
                        <div class="mx-2 d-inline-block">
                          
                            <select class="form-select" id="filter-staff-attendance">
                              <option value=""> Seluruh Staff </option>
                          <?php if(is_array($data_staff)): ?>
                            <?php foreach($data_staff as $staff) : ?>
                              <option value="<?=$staff->id;?>" > <?= $staff->name; ?> </option>
                            <?php endforeach; ?>
                          <?php endif; ?>

                        </select>

                        </div>
                        
                      </div>
                     


                    </div>
                  </div>
                 
                    <div class="table-responsive d-none d-md-block">
                   <table id="table-attendance" class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                      <tr>
                        <th>-</th>
                        <th>No.</th>
                        <th>Nama Staff</th>
                        <th>Checkpoint</th>
                        <th>Tanda Tangan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($data_attendance) && is_array($data_attendance)): ?>
                        <?php $nomer=1; foreach ($data_attendance as $att): ?>
                          <tr class="attendance-row">
                            <td><input type="checkbox" value="<?= $att->id; ?>" class="form-check attendance-selected"></td>
                            <td><?= $nomer++; ?></td>
                            <td><?= $att->staff_name; ?></td>
                            <td><?= $att->checkpoint_name; ?></td>
                            <td>
                              <?php if(!empty($att->signature_pic)): ?>
                                <img src="<?= base_url('uploads/signatures/'.$att->signature_pic); ?>" alt="Tanda Tangan" width="80">
                              <?php else: ?>
                                <span class="text-muted">-</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if($att->status == 'hadir') : ?>
                                <span class="badge bg-success"><?= $att->status; ?></span>
                              <?php elseif($att->status == 'izin acara' || $att->status == 'izin sakit') : ?>
                                <span class="badge bg-danger"><?= $att->status; ?></span>
                              <?php else: ?>
                                <span class="badge bg-secondary"><?= $att->status; ?></span>
                              <?php endif; ?>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($att->date_created)); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>

                  </div>

                     <div class="d-block d-md-none">
                <div class="row" id="card-attendance-container">
                  <?php if (!empty($data_attendance) && is_array($data_attendance)): ?>
                    <?php foreach ($data_attendance as $att): ?>
                      <div class="col-12 mb-3 attendance-card" data-id="<?= $att->id; ?>">
                        <div class="card">
                          <div class="card-body">
                            <input type="checkbox" value="<?= $att->id; ?>" class="form-check attendance-selected">
                            <h3 class="card-title mb-2"><?= $att->staff_name; ?></h3>
                            <p class="mb-1"><strong>Checkpoint:</strong> <?= $att->checkpoint_name; ?></p>
                            <p class="mb-1">
                              <strong>Status:</strong> 
                              <span class="badge <?= $att->status=='hadir'?'bg-success':($att->status=='izin acara'?'bg-danger':'bg-secondary'); ?>">
                                <?= $att->status; ?>
                              </span>
                            </p>
                            <p class="mb-1"><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($att->date_created)); ?></p>
                            <?php if(!empty($att->signature_pic)): ?>
                              <div class="mt-2">
                                <img src="<?= base_url('uploads/signatures/'.$att->signature_pic); ?>" alt="Tanda Tangan" class="img-fluid rounded border">
                              </div>
                            <?php endif; ?>
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
  
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?=base_url();?>assets/js/jquery-3.7.1.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>assets/js/sweetalert2@11.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>assets/js/tabler.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>assets/js/demo.min.js<?=$rnum?>" ></script>

    <script src="<?=base_url();?>assets/js/dataTables.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>assets/js/atttendance-works.js<?=$rnum?>" ></script>
  </body>
</html>