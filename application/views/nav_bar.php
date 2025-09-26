 <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="<?=base_url();?>portal/dashboard" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="12" cy="7" r="4" />
                      <path d="M5.5 21h13a0.5 .5 0 0 0 .5 -.5v-1a5.5 5.5 0 0 0 -5.5 -5.5h-3a5.5 5.5 0 0 0 -5.5 5.5v1a0.5 .5 0 0 0 .5 .5z" />
                    </svg>

                    </span>
                    <span class="nav-link-title">
                      Management Staff
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-staff">
                          Add New
                        </a>
                        <a class="dropdown-item" href="<?=base_url(); ?>portal/management-staff">
                          View All
                        </a>
                       
                      </div>
                    </div>
                  </div>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                    </span>
                    <span class="nav-link-title">
                       Checkpoint
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-checkpoint">
                          Add New
                        </a>
                        <a class="dropdown-item" href="<?=base_url(); ?>portal/management-checkpoint">
                          View All
                        </a>
                       
                      </div>
                    </div>
                  </div>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="<?=base_url(); ?>portal/management-attendance" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 11 12 14 20 6" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Absensi Kehadiran
                    </span>
                  </a>
                </li>

                 <li class="nav-item">
                  <a class="nav-link" href="<?=base_url(); ?>portal/management-staff" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" /><line x1="10" y1="10" x2="10.01" y2="10" /><line x1="14" y1="10" x2="14.01" y2="10" /><path d="M10 14a3.5 3.5 0 0 0 4 0" /></svg>
                    </span>
                    <span class="nav-link-title">
                      <?= $akses->getTotalStaff() ?? 0; ?> Total staff
                    </span>
                  </a>
                </li>
                
               <li class="nav-item dropdown">
    <?php
    $membership = $akses->getMembershipName();

    // Daftar semua membership menurut level
    $allMemberships = ['sederhana', 'developer', 'ultimate'];

    // Tentukan opsi upgrade berdasarkan membership sekarang
    $upgradeOptions = [];
    switch ($membership) {
        case 'gratis':
            $upgradeOptions = $allMemberships;
            break;
        case 'sederhana':
            $upgradeOptions = ['developer', 'ultimate'];
            break;
        case 'developer':
            $upgradeOptions = ['ultimate'];
            break;
        case 'ultimate':
            $upgradeOptions = [];
            break;
    }

    // Jika ada opsi upgrade → tampilkan dropdown
    if (!empty($upgradeOptions)):
        ?>
        <a class="nav-link dropdown-toggle" href="<?= base_url(); ?>portal/upgrade-akun"
           data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">

            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                </svg>
            </span>
            <span class="nav-link-title">
                Upgrade Membership Akun
            </span>
        </a>

        <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                    <?php foreach ($upgradeOptions as $opt):
                        $svg_icon = '';
                        switch ($opt) {
                            case 'sederhana':
                                $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>';
                                break;
                            case 'developer':
                                $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-code" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 8l-4 4l4 4"></path><path d="M17 8l4 4l-4 4"></path><path d="M14 4l-4 16"></path></svg>';
                                break;
                            case 'ultimate':
                                $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-crown" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 6l4 6l5 -4l-2 10h-10l-2 -10l5 4l4 -6"></path></svg>';
                                break;
                            default:
                                $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gift" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M12 8v13"></path><path d="M19 12h-14"></path><path d="M12 8v-5h-2a2 2 0 0 1 -2 -2"></path><path d="M12 8v-5h2a2 2 0 0 1 2 2"></path></svg>';
                                break;
                        }
                        ?>
                        <a class="dropdown-item" href="<?= base_url(); ?>portal/upgrade-akun?akun=<?= $opt ?>">
                            <span class="me-1">
                                <?= $svg_icon ?>
                            </span>
                            <?= ucfirst($opt) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    <?php else:
        // Ultimate → langsung tampil ikon + nama membership
        $svg_icon = '';
        switch ($membership) {
            case 'sederhana':
                $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>';
                break;
            case 'developer':
                $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-code" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 8l-4 4l4 4"></path><path d="M17 8l4 4l-4 4"></path><path d="M14 4l-4 16"></path></svg>';
                break;
            case 'ultimate':
                $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-crown" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 6l4 6l5 -4l-2 10h-10l-2 -10l5 4l4 -6"></path></svg>';
                break;
            default:
                $svg_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gift" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M12 8v13"></path><path d="M19 12h-14"></path><path d="M12 8v-5h-2a2 2 0 0 1 -2 -2"></path><path d="M12 8v-5h2a2 0 0 1 2 2"></path></svg>';
                break;
        }
        ?>
        <a class="nav-link" href="javascript:void(0)">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <?= $svg_icon ?>
            </span>
            <span class="nav-link-title"><?= ($membership); ?></span>
        </a>
    <?php endif; ?>
</li>
              
              </ul>
              <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
               
              </div>
            </div>
          </div>
        </div>
      </div>