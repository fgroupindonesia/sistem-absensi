<!-- Modal -->
<div class="modal fade" id="modal-user" tabindex="-1" aria-labelledby="usersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <form action="" method="post" id="user-form" enctype="multipart/form-data">
        <input type="hidden" id="id-user" name="id" value="">
        <input type="hidden" id="public-token-user" name="public_token" value="">

        <div class="modal-header">
          <h5 class="modal-title" id="settingsModalLabel">User Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <h3 class="mb-3">Profile Details</h3>
          <div class="row align-items-center mb-3">
            <div class="col-auto">
              <img class="avatar avatar-xl" src="<?=base_url();?>assets/img/avatars/sample.jpg">
              <input type="file" id="avatar" name="avatar" class="d-none"/>
            </div>
            <div class="col">
              <a id="btn-change-avatar" href="#" class="btn btn-secondary me-2">Change avatar</a>
              <a id="btn-delete-avatar" href="#" class="btn btn-ghost-danger d-none">Delete avatar</a>
            </div>
          </div>

          <h3 class="card-title mt-4">Login Access</h3>
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username" readonly value="">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-end">
              <label class="form-label">Status :</label>
              <span class="fw-bold" id="status-user">-</span>
            </div>
          </div>

          <h3 class="card-title mt-4">Login Info</h3>
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" name="email" value="">
            </div>
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="pass" value="">
            </div>
          </div>

          <h3 class="card-title mt-4">Bio</h3>
          <textarea class="form-control mb-3" rows="3" name="bio"></textarea>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label">WhatsApp</label>
              <input type="text" class="form-control" name="whatsapp" placeholder="+6281234567890" value="">
            </div>
            <div class="col-md-6">
              <label class="form-label">Jenis Account</label>
              <div class="d-flex flex-wrap gap-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="membership" id="accGratis" value="gratis">
                  <label class="form-check-label" for="accGratis">Gratis</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="membership" id="accSederhana" value="sederhana">
                  <label class="form-check-label" for="accSederhana">Sederhana</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="membership" id="accDev" value="developer">
                  <label class="form-check-label" for="accDev">Developer</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="membership" id="accUltimate" value="ultimate">
                  <label class="form-check-label" for="accUltimate">Ultimate</label>
                </div>
              </div>
            </div>
          </div>

          <h3 class="card-title mt-4">Business Profile</h3>
          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label">Country</label>
              <select name="country" class="form-select" id="country">
                <option value="">Pilih Negara</option>
                <option value="ID">Indonesia</option>
                <option value="MY">Malaysia</option>
                <option value="US">United States</option>
                <option value="GB">United Kingdom</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Region</label>
              <select id="region" class="form-select" name="region"></select>
            </div>
            <div class="col-md-4">
              <label class="form-label">City</label>
              <select id="city" class="form-select" name="city"></select>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea class="form-control" name="address" rows="2"></textarea>
          </div>

          <h3 class="card-title mt-4">Public Profile</h3>
          <label class="form-check form-switch form-switch-lg">
            <input class="form-check-input" type="checkbox" name="public_profile">
            <span class="form-check-label form-check-label-on">You're currently visible</span>
            <span class="form-check-label form-check-label-off">You're currently invisible</span>
          </label>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
