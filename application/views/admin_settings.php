<?php $rnum = "?" . rand(1000, 9999); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>My Account - Settings - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
    <style>
      @import url('/css/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body >
    <script src="/js/demo-theme.min.js<?=$rnum?>"></script>
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
                  Settings
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
       <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                <?php include('nav_settings.php'); ?>
                </div>
                <div class="col d-flex flex-column">
                  <div class="card-body">
                    <h2 class="mb-4">My Account</h2>
                    <h3 class="card-title">Profile Details</h3>
                    <div class="row align-items-center">
                      <div class="col-auto"><img class="avatar avatar-xl" src="/images/avatars/<?= $this->akses->getAvatar() ;?>" >
                      </div>
                      <div class="col-auto"><a href="#" class="btn">
                          Change avatar
                        </a></div>
                      <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                          Delete avatar
                        </a></div>
                    </div>
                    <h3 class="card-title mt-4">Login Access</h3>
                    <div class="row g-3">
                    
                      <div class="col-md">
                        <div class="form-label">Username</div>
                        <input type="text" class="form-control" value="560afc32">
                      </div>
                      <div class="col-md">
                        <div class="form-label">Password</div>
                        <input type="password" class="form-control" value="1234">
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Email</h3>
                    <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.</p>
                    <div>
                      <div class="row g-2">
                        <div class="col-auto">
                          <input type="text" class="form-control w-auto" value="paweluna@howstuffworks.com">
                        </div>
                        <div class="col-auto"><a href="#" class="btn">
                            Change
                          </a></div>
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Password</h3>
                    <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
                    <div>
                      <a href="#" class="btn">
                        Set new password
                      </a>
                    </div>
                    <h3 class="card-title mt-4">Bio</h3>
                    <p class="card-subtitle">This Description below will be seen by public.</p>
                    <div>
                      <div class="row">
                        <div class="col-6">
                          <textarea class="form-control col-6" col="130" row="50"> </textarea>
                        </div>
                       
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Business Profile</h3>
                    <div class="row g-3">
                    
                      <div class="col-md">
                        <div class="form-label">Country</div>
                        <input type="text" class="form-control" value="">
                      </div>
                      <div class="col-md">
                        <div class="form-label">City</div>
                        <input type="text" class="form-control" value="">
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-6">
                        <div class="form-label">Address</div>
                        <textarea class="form-control col-6" > </textarea>
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Public profile</h3>
                    <p class="card-subtitle">Making your profile public means that anyone on the Dashkit network will be able to find
                      you.</p>
                    <div>
                      <label class="form-check form-switch form-switch-lg">
                        <input class="form-check-input" type="checkbox">
                        <span class="form-check-label form-check-label-on">You're currently visible</span>
                        <span class="form-check-label form-check-label-off">You're
                          currently invisible</span>
                      </label>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                      <a href="#" class="btn">
                        Cancel
                      </a>
                      <a href="#" class="btn btn-primary">
                        Submit
                      </a>
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
    <script src="/js/tabler.min.js<?=$rnum?>" defer></script>
    <script src="/js/demo.min.js<?=$rnum?>" defer></script>
  </body>
</html>