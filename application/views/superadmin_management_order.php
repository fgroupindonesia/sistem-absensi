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
    <title>Management Order - Sistem Absensi Digital.</title>
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
      .membership-icon { margin-right:5px; }
    </style>
  </head>
  <body data-token="<?= $akses->getPublicToken(); ?>" >
    <script src="<?=base_url();?>/assets/js/demo-theme.min.js<?=$rnum?>"></script>
    <div class="page">
      <?php include('header.php'); ?>
       <?php if($akses->isCompany()) : include('nav_bar.php'); endif; ?>
       <?php if($akses->isAdmin()) : include('superadmin_nav_bar.php'); endif; ?>
      <div class="page-wrapper">
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <div class="page-pretitle">Management Order</div>
                <h2 class="page-title">View All Orders</h2>
              </div>
            </div>
          </div>
        </div>

        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Data Seluruh Order Upgrade Membership Akun</h3>
                  </div>

                  <div class="table-responsive d-none d-md-block"><!-- Desktop only -->
  <table id="table-orders" class="table card-table table-vcenter text-nowrap datatable">
    <thead>
      <tr>
        <th>No.</th>
        <th>Username</th>
        <th>Membership Ordered</th>
        <th>Status</th>
        <th>Bukti Pembayaran</th>
        <th>Tanggal Order</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($data_orders) && is_array($data_orders)): ?>
        <?php $nomer=1; foreach ($data_orders as $order): ?>
          <tr>
            <td><?= $nomer++; ?></td>
            <td><?= $order->username; ?></td>
            <td>
              <?php
                switch($order->membership_name){
                  case 'sederhana': $icon='fa-user'; break;
                  case 'developer': $icon='fa-code'; break;
                  case 'ultimate': $icon='fa-crown'; break;
                  default: $icon='fa-gift';
                }
              ?>
              <i class="fa <?= $icon ?> membership-icon"></i>
              <?= $order->membership_name; ?>
            </td>
            <td>
              <?php
                switch($order->status){
                  case 'pending': $badge='bg-warning'; $icon='fa-hourglass-half'; break;
                  case 'paid': $badge='bg-success'; $icon='fa-check'; break;
                  case 'cancel': $badge='bg-danger'; $icon='fa-xmark'; break;
                  case 'process': $badge='bg-primary'; $icon='fa-spinner'; break;
                  default: $badge='bg-secondary'; $icon='fa-question';
                }
              ?>
              <span class="badge <?= $badge ?>">
                <i class="fa <?= $icon ?>"></i> <?= ucfirst($order->status); ?>
              </span>
            </td>
            <td>
              <?php if($order->payment_screenshot): ?>
                <a class="preview-bukti-pembayaran" 
                href="<?= base_url(). 'assets/uploads/payment_screenshot/' .$order->payment_screenshot ?>" >
                  <i class="fa fa-image"></i> Lihat
                </a>
              <?php else: ?>
                -
              <?php endif; ?>
            </td>
            <td><?= tanggal_indonesia($order->date_created); ?></td>
            <td>
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                  Update Status
                </button>
                <ul class="dropdown-menu">
                  <?php 
                    $statuses = ['pending','paid','cancel','process'];
                    foreach($statuses as $status_option):
                      switch($status_option){
                        case 'pending': $icon='fa-hourglass-half'; break;
                        case 'paid': $icon='fa-check'; break;
                        case 'cancel': $icon='fa-xmark'; break;
                        case 'process': $icon='fa-spinner'; break;
                        default: $icon='fa-question';
                      }
                  ?>
                    <li>
                      <a href="#" class="order-update-status dropdown-item" 
                         data-id="<?= $order->id ?>" 
                         data-status="<?= $status_option ?>" 
                         data-username="<?= $order->username ?>">
                        <i class="fa <?= $icon ?>"></i> <?= ucfirst($status_option) ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>


<!-- Mobile Cards -->
<div class="d-block d-md-none"><!-- Mobile only -->
  <?php if (!empty($data_orders) && is_array($data_orders)): ?>
    <?php $nomer=1; foreach ($data_orders as $order): ?>
      <div class="card mb-2 shadow-sm">
        <div class="card-body">
          <h4 class="card-title mb-1">
            <?= $nomer++; ?>. <?= $order->username; ?>
          </h4>
          <p class="mb-1">
            <strong>Membership:</strong>
            <?php
              switch($order->membership_name){
                case 'sederhana': $icon='fa-user'; break;
                case 'developer': $icon='fa-code'; break;
                case 'ultimate': $icon='fa-crown'; break;
                default: $icon='fa-gift';
              }
            ?>
            <i class="fa <?= $icon ?>"></i> <?= $order->membership_name; ?>
          </p>
          <p class="mb-1">
            <strong>Status:</strong> 
            <?php
              switch($order->status){
                case 'pending': $badge='bg-warning'; $icon='fa-hourglass-half'; break;
                case 'paid': $badge='bg-success'; $icon='fa-check'; break;
                case 'cancel': $badge='bg-danger'; $icon='fa-xmark'; break;
                case 'process': $badge='bg-primary'; $icon='fa-spinner'; break;
                default: $badge='bg-secondary'; $icon='fa-question';
              }
            ?>
            <span class="badge <?= $badge ?>"><i class="fa <?= $icon ?>"></i> <?= ucfirst($order->status); ?></span>
          </p>
          <p class="mb-1">
            <strong>Tanggal:</strong> <?= tanggal_indonesia($order->date_created); ?>
          </p>
          <p class="mb-1">
            <strong>Bukti:</strong>
            <?php if($order->payment_screenshot): ?>
              <a class="preview-bukti-pembayaran" 
              href="<?= base_url(). 'assets/uploads/payment_screenshot/' . $order->payment_screenshot ?>" >
                <i class="fa fa-image"></i> Lihat
              </a>
            <?php else: ?>
              -
            <?php endif; ?>
          </p>
          <div class="mt-2">
            <div class="btn-group w-100">
              <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                Update Status
              </button>
              <ul class="dropdown-menu w-100">
                <?php 
                  $statuses = ['pending','paid','cancel','process'];
                  foreach($statuses as $status_option):
                    switch($status_option){
                      case 'pending': $icon='fa-hourglass-half'; break;
                      case 'paid': $icon='fa-check'; break;
                      case 'cancel': $icon='fa-xmark'; break;
                      case 'process': $icon='fa-spinner'; break;
                      default: $icon='fa-question';
                    }
                ?>
                  <li>
                    <a href="#" class="order-update-status dropdown-item" 
                       data-id="<?= $order->id ?>" 
                       data-status="<?= $status_option ?>" 
                       data-username="<?= $order->username ?>">
                      <i class="fa <?= $icon ?>"></i> <?= ucfirst($status_option) ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
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

 <?php include('modal_preview_payment.php'); ?>

    <!-- Libs JS -->
    <script src="<?=base_url();?>assets/js/tabler.min.js<?=$rnum?>" defer></script>
    <script src="<?=base_url();?>assets/js/demo.min.js<?=$rnum?>" defer></script>
    <script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js<?=$rnum?>"></script>
    <script src="<?=base_url();?>assets/js/sweetalert2@11.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>assets/js/dataTables.min.js<?=$rnum?>"></script>
    <script src="<?=base_url();?>assets/js/order-works.js<?=$rnum?>"></script>
  
  </body>
</html>
