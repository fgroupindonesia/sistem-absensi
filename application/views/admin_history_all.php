<?php 
$rnum = "?" . rand(1000, 9999); 
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Riwayat Penting - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>assets/css/custom-package-style.css<?=$rnum?>" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
      @import url('<?=base_url();?>assets/css/inter.css');
      :root {
        --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      .timeline-item {
        padding: 1rem;
        border-left: 3px solid #ddd;
        margin-left: 1rem;
        position: relative;
      }
      .timeline-item:before {
        content: "";
        width: 12px;
        height: 12px;
        background: #fff;
        border: 3px solid #0d6efd;
        border-radius: 50%;
        position: absolute;
        left: -9px;
        top: 1.2rem;
      }
      .timeline-icon {
        margin-right: .5rem;
      }
      .status-pending { color: #ffc107; }
      .status-process { color: #0d6efd; }
      .status-paid { color: #28a745; }
      .status-cancel { color: #dc3545; }
    </style>
  </head>
  <body data-token="<?= $akses->getPublicToken(); ?>">
    
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
                <h2 class="page-title">Riwayat Penting</h2>
              </div>
            </div>
          </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">

            <?php if (!empty($history) && is_array($history)): ?>
              <?php foreach ($history as $row): ?>
                <?php 
                  $icon = "fa-clock status-pending";
                  if ($row->status == "paid") $icon = "fa-circle-check status-paid";
                  elseif ($row->status == "cancel") $icon = "fa-circle-xmark status-cancel";
                  elseif ($row->status == "process") $icon = "fa-spinner status-process";
                ?>
            <div class="timeline-item">
                <p>
                  <i class="fa-solid <?= $icon ?> timeline-icon"></i>
                  
                  <?php if($row->status == 'pending') :?>
                    Pemesanan upgrade akun membership <b><?= $row->membership_name; ?></b>
                    telah diorder. 

                <?php elseif ($row->status == 'process'): ?>
                      File Bukti Pembayaran telah diupload. 
                    verfikasi sedang berlangsung 15 menit menunggu. 

                <?php endif ;?>
                  
                  <?php if (count($history) == 1 && $row->status == 'pending'): ?>
                    <br>
                    <label>Diperlukan tindakan anda:</label>
                    <input type="file" id="file-bukti" accept=".jpg,.jpeg,.png,.pdf" style="display:none;">
                    <button data-order-id="<?=$row->order_id;?>" id="btn-upload-bukti-pembayaran" class="btn btn-primary">
                      Upload bukti pembayaran
                    </button>
                  <?php endif; ?>

                  <br>
                  <small class="text-muted">
                    <?= tanggal_indonesia($row->date_created); ?>
                  </small>
                </p>
              </div>

              <?php endforeach; ?>
            <?php else: ?>
              <div class="alert alert-info">Belum ada riwayat order membership.</div>
            <?php endif; ?>

          </div>
        </div>

        <?php include('footer.php'); ?>
      </div>
    </div>

    <!-- Tabler Core -->
    <script src="<?=base_url();?>/assets/js/tabler.min.js<?=$rnum?>" defer></script>
    <script src="<?=base_url();?>/assets/js/demo.min.js<?=$rnum?>" defer></script>
    <script src="<?=base_url();?>/assets/js/jquery-3.7.1.min.js<?=$rnum?>"></script>
    <script src="<?=base_url();?>/assets/js/sweetalert2@11.js<?=$rnum?>"></script>
    <script src="<?=base_url();?>/assets/js/checkout.js<?=$rnum?>"></script>
  </body>
</html>
