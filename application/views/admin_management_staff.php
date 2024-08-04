<?php $rnum = "?" . rand(1000, 9999); ?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Management Staff - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="/assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
     <link href="/assets/css/custom-style.css<?=$rnum?>" rel="stylesheet"/>

    <style>
      @import url('/assets/css/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body >
    <script src="/assets/js/demo-theme.min.js<?=$rnum?>"></script>
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

                  <button id="btn-activate-staff" href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-activation">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Activate Staff
                  </button>
                 
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
                    <h3 class="card-title">Data Staff Karyawan</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                      <div class="text-muted">
                        Show
                        <div class="mx-2 d-inline-block">
                          <input id="entry_limit" type="number" class="form-control form-control-sm" value="<?= $entry_limit; ?>" size="3" aria-label="Invoices count">
                        </div>
                        entries.
                      </div>
                      <div class="ms-auto text-muted">
                        Search:
                        <div class="ms-2 d-inline-block">
                          <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                          <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="6 15 12 9 18 15"></polyline></svg>
                          </th>
                          <th>Nama Staff</th>
                          <th>Unit Divisi</th>
                          <th>Kontak WA</th>
                          <th>Email</th>
                          <th>Status Aktif</th>
                          <th>Catatan</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- example data
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-muted">001401</span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1">Udin Markudin</a></td>
                          <td>
                            <span class="flag flag-country-us"></span>
                            IT Support
                          </td>
                          <td>
                            0812-1222-1223
                          </td>
                          <td>
                            udin@home.com
                          </td>
                          <td>
                            <span class="badge bg-success me-1"></span> Bekerja
                          </td>
                          <td>-</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr> -->
                      <?php if(is_array($data_staff)): ?>
                        <?php foreach ($data_staff as $staff): ?>
                        <tr  >
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-muted"><?= $staff->id; ?></span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1"><?= $staff->name; ?></a></td>
                          <td>
                            <span class="flag flag-country-us"></span>
                            <?= $staff->unit_division; ?>
                          </td>
                          <td>
                            <?= $staff->whatsapp; ?>
                          </td>
                          <td>
                            <?= $staff->email; ?>
                          </td>
                          <td>
                            <span class="badge bg-success me-1"></span> <?= $staff->status; ?>
                          </td>
                          <td><?= $staff->notes; ?></td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a data-token="<?= $staff->public_token ;?>" data-id="<?= $staff->id; ?>" class="dropdown-item link-edit-staff" href="#" data-bs-toggle="modal" data-bs-target="#modal-loading">
                                  Edit
                                </a>
                                <a data-id="<?= $staff->id; ?>" class="dropdown-item link-delete-staff" href="#" data-bs-toggle="modal" data-bs-target="#modal-loading">
                                  Delete
                                </a>
                                  <a data-token="<?= $staff->public_token ;?>" data-id="<?= $staff->id; ?>" class="dropdown-item link-activate-staff" href="#" data-bs-toggle="modal" data-bs-target="#modal-loading">
                                  Activate
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing <span>1</span> to <span>
                      <?= $total_staff/$entry_limit; ?>
                    </span> of <span id="entry-limit"><?= $total_staff; ?></span> entries</p>
                    <ul class="pagination m-0 ms-auto">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                          <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="15 6 9 12 15 18"></polyline></svg>
                          prev
                        </a>
                      </li>

                  <?php if(isset($total_staff) && $total_staff!=0): ?>
                    <?php for($index_page=0; $index_page<($total_staff/$entry_limit); $index_page++) {
                      $element = '<li class="page-item"><a class="page-link" href="#">' . ($index_page+1) . '</a></li>';
                      echo $element;
                    } ?>
                
                  <?php endif; ?>
                <li class="page-item">
                    <a class="page-link" href="#">
                          next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg>
                        </a>
                      </li>
                    </ul>
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
    <script src="/assets/js/tabler.min.js<?=$rnum?>" defer></script>
    <script src="/assets/js/demo.min.js<?=$rnum?>" defer></script>
     <script src="/assets/js/jquery-3.3.1.min.js<?=$rnum?>" defer></script>
     <!-- <script src="/assets/js/bootstrap.bundle.min.js<?=$rnum?>" defer></script> -->
     <script src="/assets/js/form-actions.js<?=$rnum?>" defer></script>

  </body>
</html>