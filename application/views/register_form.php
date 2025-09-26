

<!DOCTYPE html>
<head>
	<title>Register - Sistem Absensi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?=base_url();?>/assets/js/jquery-3.3.1.min.js"></script>
    <link href="<?=base_url();?>/assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="<?=base_url();?>/assets/js/bootstrap.min.js"></script>


	
    
    <!--Fontawesome CDN-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/css/admin_login.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card registration-card">
			<div class="card-header">
				<h3>New Register</h3>
				<div class="d-flex justify-content-end social_icon">
					<a href="https://wa.link/m0uxzd"><span><i class="fab fa-whatsapp-square"></i></span> </a>
					
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="<?=base_url()?>account/register">

 

 

  <div class="input-group form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
    </div>
    <input type="email" class="form-control" name="email" placeholder="email">
  </div>

   <div class="input-group form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-key"></i></span>
    </div>
    <input type="password" class="form-control" name="pass" placeholder="password">
  </div>

  <div class="input-group form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-phone"></i></span>
    </div>
    <input type="text" class="form-control" name="whatsapp" placeholder="whatsapp number">
  </div>

  <div class="input-group form-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-tags"></i></span>
    </div>
    <select class="form-control" name="type">
      <option value="gratis" <?= isset($type_gratis) ? 'checked' : ''; ?>>Gratis</option>
      <option value="sederhana" <?= isset($type_sederhana) ? 'checked' : ''; ?>>Sederhana</option>
      <option value="developer" <?= isset($type_developer) ? 'checked' : ''; ?>>Developer</option>
      <option value="unlimited" <?= isset($type_unlimited) ? 'checked' : ''; ?>>Unlimited</option>
    </select>
  </div>

  <div class="form-group text-center">
    <button type="submit" class="btn btn-warning btn-block">Register</button>
  </div>

</form>

			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Sudah pernah <a href="<?=base_url();?>portal/admin"> Login?</a>
				</div>
				
			</div>
		</div>
	</div>
</div>
</body>
</html>