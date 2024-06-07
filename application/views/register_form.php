

<!DOCTYPE html>
<head>
	<title>Register - Sistem Absensi</title>
   <!--Made with love by Mutiullah Samim -->
   <link href="/assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery-3.3.1.min.js"></script>

	
    
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
				<h3>New Register</h3>
				<div class="d-flex justify-content-end social_icon">
					<a href="https://wa.link/m0uxzd"><span><i class="fab fa-whatsapp-square"></i></span> </a>
					
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="/account/register">
					
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
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" class="form-control" name="email" placeholder="email">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-phone"></i></span>
						</div>
						<input type="text" class="form-control" name="whatsapp" placeholder="whatsapp number">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-option"></i></span>
						</div>
						<select name="type">
							<?php

							$type_gratis = "";
							$type_sederhana = "";
							$type_unlimited = "";
							$type_developer = "";

								if(isset($type)){
									if($type=='gratis'){
											$type_gratis = "checked";
									}
									if($type=='developer'){
										$type_developer = "checked";
									}
									if($type=='unlimited'){
										$type_unlimited = "checked";
									}
									if($type=='sederhana'){
										$type_sederhana = "checked";
									}

								}
							?>
							<option value="gratis" <?= $type_gratis ;?> >Gratis</option>
							<option value="sederhana" <?= $type_sederhana ;?> >Sederhana</option>
							<option value="developer" <?= $type_developer ;?> >Developer</option>
							<option value="unlimited" <?= $type_unlimited ;?> >Unlimited</option>
						</select>

					</div>
					
					<div class="form-group">
						<input type="submit" value="Register" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Sudah pernah <a href="/portal/admin"> Login?</a>
				</div>
				
			</div>
		</div>
	</div>
</div>
</body>
</html>