

<!DOCTYPE html>
<head>
	<title>Login - Sistem Kehadiran</title>

	<script src="/assets/js/jquery-3.3.1.min.js"></script>
   <link href="/assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="/assets/js/bootstrap.min.js"></script>

	
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="/assets/css/admin_login.css">
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
				<form method="post" action="admin/login">
					<?= isset($status) ? "<span class='error'> Error Login! </span>" : false; ?>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="username" placeholder="username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="pass" placeholder="password">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Mau Daftar khusus Perusahaan &gt;&gt; <a href="/portal/register">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center links">
					Atau Mau &gt;&gt; <a href="https://wa.link/m0uxzd">Integrasi System Lain</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>