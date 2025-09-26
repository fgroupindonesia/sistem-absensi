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
    <title>Upgrade Membership Akun - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    
    <link href="<?=base_url();?>assets/css/custom-package-style.css<?=$rnum?>" rel="stylesheet"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
      @import url('<?=base_url();?>assets/css/inter.css');
      :root {
        --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      .payment-footer {
        margin-top: 1rem;
        display: flex;
        justify-content: flex-end;
        gap: .5rem;
      }
          @media (max-width: 991px) {
      .mobile-card {
        display: block !important;
      }
    }

    </style>
  </head>
  <body data-token="<?= $akses->getPublicToken(); ?>">
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
                <h2 class="page-title">Upgrade Membership Akun</h2>
              </div>
            </div>
          </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">

            <input type='hidden' id='account-ordered' value='<?= $jenis; ?>' >

             <div id="payment-timer" class="alert alert-warning mt-3" style="display:none;">
            <span>Silahkan upload bukti pembayaran sebelum <b>3 jam</b>, 
            jika tidak maka pemesanan ini otomatis <b>dibatalkan</b>.</span><br>
            <strong>Sisa waktu: <span id="timer-countdown">03:00:00</span></strong>
            <br> <br>
            <input type="file" id="file-bukti" accept=".jpg,.jpeg,.png,.pdf" style="display:none;">
            <button data-order-id="" id="btn-upload-bukti-pembayaran" class="btn-primary btn"> Upload Bukti pembayaran </button>
          </div>


            <!-- Desktop Invoice (Table) -->
            <div class="d-none d-lg-block">
              <table class="table table-bordered">
                <thead class="table-light">
                  <tr>
                    <th>Item</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Membership <?= $jenis; ?></td>
                    <td class="text-center">1</td>
                    <td class="text-end"><?= format_rupiah($price); ?></td>
                    <td class="text-end"><?= format_rupiah($price); ?></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3" class="text-end">Total Payment</th>
                    <th class="text-end"><?= format_rupiah($price); ?></th>
                  </tr>
                </tfoot>
              </table>

              <!-- Payment Options Desktop -->
            <div class="mt-4">
              <h6>Payment Options</h6>

              <div class="p-3 border rounded mb-2 d-flex align-items-start">
                  <img src="<?=base_url('assets/img/bjb.png')?>" alt="Bank" class="me-2" style="width:32px;height:32px;">
                  <div>
                      <strong>Bank Transfer</strong><br>
                      Bank: BJB 005-869-395-210-0 <br>
                      Holder Name: Astri Lutfiani Ulfah
                  </div>
              </div>

              <div class="p-3 border rounded mb-2 d-flex align-items-start">
                  <img src="<?=base_url('assets/img/gopay.png')?>" alt="GoPay" class="me-2" style="width:32px;height:32px;">
                  <div>
                      <strong>GoPay</strong><br>
                      Top up to: <span class="fw-bold">0857-9556-9337</span>
                  </div>
              </div>

              <div class="p-3 border rounded d-flex align-items-start">
                  <img src="<?=base_url('assets/img/shopee.png')?>" alt="ShopeePay" class="me-2" style="width:32px;height:32px;">
                  <div>
                      <strong>ShopeePay</strong><br>
                      Top up to: <span class="fw-bold">0857-9556-9337</span>
                  </div>
              </div>
          </div>



              <div class="payment-footer">
                <button type="button" class="btn btn-secondary btn-cancel-checkout">Cancel</button>
                <button type="button" class="btn btn-success btn-confirmed-checkout">Checkout</button>
              </div>
            </div>

            <!-- Mobile Responsive Invoice Card -->
           <div class="mobile-card container my-4 d-lg-none">
            <div class="card shadow-sm rounded-3">
              <div class="card-header bg-primary text-white">
                Invoice Checkout
              </div>
              <div class="card-body">

                <!-- Item -->
                <div class="d-flex justify-content-between mb-2">
                  <span>Membership <?= $jenis; ?></span>
                  <span class="fw-bold"><?= format_rupiah($price); ?></span>
                </div>
                <div class="small text-muted mb-3">Qty: 1</div>

                <!-- Total -->
                <div class="d-flex justify-content-between border-top pt-2 mb-3">
                  <span class="fw-bold">Total Payment</span>
                  <span class="fw-bold text-success"><?= format_rupiah($price); ?></span>
                </div>

                <!-- Payment Options Mobile -->
                <h6 class="mb-2">Payment Options</h6>

                <div class="card mb-2 p-2 border d-flex align-items-start">
                  <img src="<?=base_url('assets/img/bjb.png')?>" alt="Bank" class="me-2" style="width:32px;height:32px;">
                  <div>
                    <strong>Bank Transfer</strong><br>
                    BJB 005-869-395-210-0 <br>
                    Holder: Astri Lutfiani Ulfah
                  </div>
                </div>

                <div class="card mb-2 p-2 border d-flex align-items-start">
                  <img src="<?=base_url('assets/img/gopay.png')?>" alt="GoPay" class="me-2" style="width:32px;height:32px;">
                  <div>
                    <strong>GoPay</strong><br>
                    Top up to: <span class="fw-bold">0857-9556-9337</span>
                  </div>
                </div>

                <div class="card mb-3 p-2 border d-flex align-items-start">
                  <img src="<?=base_url('assets/img/shopee.png')?>" alt="ShopeePay" class="me-2" style="width:32px;height:32px;">
                  <div>
                    <strong>ShopeePay</strong><br>
                    Top up to: <span class="fw-bold">0857-9556-9337</span>
                  </div>
                </div>

                <!-- Checkout Button Mobile -->
                <button class="btn btn-secondary w-100 btn-cancel-checkout">Cancel</button>
                <button class="btn btn-success w-100 btn-confirmed-checkout">Checkout</button>

              </div>
            </div>
          </div>

         


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
    <script src="<?=base_url();?>/assets/js/checkout.js<?=$rnum?>" defer></script>
  </body>
</html>
