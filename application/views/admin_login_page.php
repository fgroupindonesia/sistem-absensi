<?php
 $rnum = "?" . rand(1000, 9999); 
 // ini untuk memudahkan all Script JS bawahan
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";
?>
<!DOCTYPE html>
<head>
	<title>Login - Sistem Kehadiran</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js?<?=$rnum;?>"></script>
   <link href="<?=base_url();?>assets/css/bootstrap.min.css?<?=$rnum;?>" rel="stylesheet" id="bootstrap-css">
	<script src="<?=base_url();?>assets/js/bootstrap.min.js?<?=$rnum;?>"></script>
	<script src="<?=base_url();?>assets/js/sweetalert2@11.js?<?=$rnum;?>"></script>
	<script src="<?=base_url();?>assets/js/login_custom.js?<?=$rnum;?>"></script>

	<?php if (isset($status)): ?>
	<?php if($status === 'error' || $status === 'failed'): ?>
	<script src="<?=base_url();?>assets/js/login_clear.js?<?=$rnum;?>"></script>
	<?php endif; ?>
	<?php endif; ?>
	
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/admin_login.css">

	

</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<a href="https://wa.link/m0uxzd"><span><i class="fab fa-whatsapp-square"></i></span> </a>
				</div>
			</div>
			<div class="card-body">
				<form id="login-form" method="post" action="<?= base_url(); ?>portal/admin/login">
				
				<?php if (isset($status)): ?>
					<?php if ($status === 'success'): ?>
						<script> pendaftaranBerhasil(); </script>
					<?php elseif ($status === 'failed' || $status === 'error'): ?>
						<span class="error">Error Login!</span>
					<?php endif; ?>
				<?php endif; ?>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="username" id="username" placeholder="kamu@email.com">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="pass" id="pass" placeholder="password">
					</div>
					<div class="row align-items-center remember">
						<input id="remember-me" name="remember-me" type="checkbox">Remember Me
					</div>
					<div class="form-group">
						<input id="btn-submit" type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div id="autoLoginLoader" style="display:none; text-align:center; padding:20px;">
			   <i class="fas fa-spinner fa-spin fa-2x"></i>
			   <p>Login otomatis, mohon tunggu...</p>
			</div>

			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Daftar Baru :<a href="<?=base_url();?>portal/register">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center links">
					Atau :<a href="https://wa.link/m0uxzd">Integrasi System</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>