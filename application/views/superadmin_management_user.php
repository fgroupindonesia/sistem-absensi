<?php
$rnum = "?" . rand(1000, 9999); 
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Management User - Sistem Absensi Digital</title>

    <!-- CSS files -->
    <link href="<?=base_url();?>/assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/dataTables.dataTables.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="<?=base_url();?>/assets/css/custom-style.css<?=$rnum?>" rel="stylesheet"/>
  </head>
  <body>
    <div class="page">
      <?php include('header.php'); ?>
      <?php if($akses->isCompany()) : include('nav_bar.php'); endif; ?>
      <?php if($akses->isAdmin()) : include('superadmin_nav_bar.php'); endif; ?>

      <div class="page-wrapper">
       <div class="page-header d-print-none">
          
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Management User
                 </div>
                <h2 class="page-title">
                  View All User
                </h2>
              </div>

              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  
                  <button id="btn-add-user" href="#" class="btn btn-primary d-none d-sm-inline-block" 
                  data-bs-toggle="modal" 
                  data-bs-target="#modal-user">

                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add New User
                  </button>

                   <?php if(!empty($data_users) && is_array($data_users)): ?>
                   <button data-token="<?= $akses->getPublicToken(); ?>"  class="btn-delete-user btn btn-danger d-none d-sm-inline-block" title="Delete">
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
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-user">Add New User</a>
        
                  <?php if(!empty($data_users) && is_array($data_users)): ?>

                    <a data-token="<?= $akses->getPublicToken(); ?>" class="dropdown-item btn-delete-user" >Delete</a>

                  <?php endif; ?>  

                  </div>
                </div>
                 
                </div>
              </div>


            </div>
          </div>
        
        </div>

        <div class="page-body">
          <div class="container-xl">

            <!-- DESKTOP VIEW TABLE -->
            <div class="table-responsive d-none d-md-block">
              <table id="table-users" class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th>-</th>
                    <th>No</th>
                    <th>Avatar</th>
                    <th>Username</th>                    
                    <th>Email</th>
                    <th>Bio</th>
                    <th>Membership</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($data_users) && is_array($data_users)): ?>
                    <?php $nomer=1; foreach ($data_users as $user): ?>
                    <?php if($user->user_type == 'admin') continue; ?>
                      <tr>
                        <td>
                        <input type="checkbox" 
                               value="<?= $user->id; ?>" 
                               class="form-check-input user-selected" />
                      </td>

                        <td><?= $nomer; ?></td>
                        <td><img src="<?= base_url();?>assets/img/avatars/<?= $user->avatar ?>" class="avatar avatar-sm rounded" /></td>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->email; ?></td>
                        <td>
                          <a href="#" class="lihat-bio" 
                             data-bio="<?= htmlspecialchars($user->bio ?? ''); ?>">
                             Lihat
                          </a>
                        </td>
                        <td><?= $user->membership; ?></td>
                        <td>
                          <?php
                            $badge = $user->status == 'active' ? 'bg-success' : 'bg-danger';
                          ?>
                          <span class="badge <?= $badge ?>"><?= htmlspecialchars($user->status ?? ''); ?></span>
                        </td>
                        <td><?= tanggal_indonesia($user->date_created); ?></td>
                       <td>
                        <div class="dropdown">
                          <a href="#" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                           Opsi
                          </a>

                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item edit-user" 
                              data-bs-toggle="modal"
                              data-bs-target="#modal-user" href="#" data-id="<?= $user->id; ?>">Edit</a></li>
                            <li><a class="dropdown-item delete-user" href="#" data-id="<?= $user->id; ?>">Delete</a></li>
                            <li><a class="dropdown-item upgrade-user" href="#" data-id="<?= $user->id; ?>">Upgrade Level</a></li>
                          </ul>
                        </div>
                      </td>


                      </tr>
                      <?php $nomer++; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <!-- MOBILE VIEW CARDS -->
            <div class="d-block d-md-none">
              <?php if (!empty($data_users) && is_array($data_users)): ?>
                <?php foreach ($data_users as $user): ?>
                  <div class="card mb-2 shadow-sm">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <img src="<?=base_url();?>assets/img/avatars/<?= $user->avatar ?>" class="avatar avatar-sm rounded me-2"/>
                        <h4 class="card-title mb-0"><?= $user->username; ?></h4>
                      </div>
                      <p><strong>Email:</strong> <?= $user->email; ?></p>
                      <p><strong>WhatsApp:</strong> <?= $user->whatsapp; ?></p>
                      <p><strong>Office:</strong> <?= $user->office_name; ?></p>
                      <p><strong>Country:</strong> <?= $user->country; ?></p>
                      <p><strong>Membership:</strong> <?= $user->membership; ?></p>
                      <p><strong>Status:</strong> 
                        <span class="badge <?= $user->status=='active'?'bg-success':'bg-danger' ?>">
                          <?= ($user->status) ?? ''; ?>
                        </span>
                      </p>
                      <p><strong>Date Created:</strong> <?= tanggal_indonesia($user->date_created); ?></p>
                      <p><a href="#" class="lihat-pass" data-pass="<?= $user->pass ?>">Lihat Password</a></p>
                      <p><a href="#" class="lihat-bio" data-bio="<?= ($user->bio) ?? ''; ?>">Lihat Bio</a></p>
                      <p>
                      <div class="dropdown">
                        <a href="#" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Opsi
                        </a>

                        <ul class="dropdown-menu">
                          <li>
                            <a class="dropdown-item edit-user" data-bs-toggle="modal" data-bs-target="#modal-user" href="#" data-id="<?= $user->id; ?>">Edit</a>
                          </li>
                          <li>
                            <a class="dropdown-item delete-user" href="#" data-id="<?= $user->id; ?>">Delete</a>
                          </li>
                          <li>
                            <a class="dropdown-item upgrade-user" href="#" data-id="<?= $user->id; ?>">Upgrade Level</a>
                          </li>
                        </ul>
                      </div>

                      </p>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>

          </div>
        </div>

        <?php include('footer.php'); ?>
      </div>
    </div>

  <?php include('modal_preview_user_detail.php'); ?>
  <?php include('modal_user.php'); ?>

    <!-- JS -->
    <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js<?=$rnum?>"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.bundle.min.js<?=$rnum?>"></script>
    <script src="<?=base_url();?>assets/js/dataTables.min.js<?=$rnum?>"></script>
    <script src="<?=base_url();?>assets/js/tabler.min.js<?=$rnum?>"></script>
    <script src="<?=base_url();?>/assets/js/sweetalert2@11.js<?=$rnum?>"></script>
    <script src="<?=base_url();?>assets/js/user-works.js<?=$rnum?>"></script>

    <script>
    $(document).ready(function(){
      $('#table-users').DataTable();

      $(document).on('click', '.lihat-pass', function(e){
        e.preventDefault();
        showData('Password', $(this).data("pass"));
      });

      $(document).on('click', '.lihat-bio', function(e){
        e.preventDefault();
        showData('Bio', $(this).data("bio"));
        
      });
    });

    // contoh show password
function showData(judul, data) {
  Swal.fire({
    title: judul,
    text: data,
    icon: 'info',
    timer: 3000,
    showConfirmButton: false
  });
}



    </script>
  </body>
</html>
