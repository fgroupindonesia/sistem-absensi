 <div class="card-body" id="nav-settings">
                    <h4 class="subheader">Main settings</h4>
                    <div class="list-group list-group-transparent">
                      <a id="navs-myaccount" href="<?=base_url();?>portal/settings" class="list-group-item list-group-item-action d-flex align-items-center active">My Account</a>
                      <?php if($akses->isCompany()) : ?>
                        <a id="navs-membership" href="<?=base_url();?>portal/settings/membership" class="list-group-item list-group-item-action d-flex align-items-center">Membership</a>
                      <?php endif; ?>
                      </div>

                      <?php if($akses->isCompany()) : ?>
                    <h4 class="subheader mt-4">Advanced</h4>
                    <div class="list-group list-group-transparent">
                      <a id="navs-wa" href="#" class="list-group-item list-group-item-action">Whatsapp Notification</a>
                      <a id="navs-checkpoint" href="#" class="list-group-item list-group-item-action">Checkpoint</a>
                      <a id="navs-gps" href="#" class="list-group-item list-group-item-action">GPS Report</a>
                      <a id="navs-integration" href="#" class="list-group-item list-group-item-action">Integration</a>
                    </div>
                      <?php endif; ?>

                  </div>