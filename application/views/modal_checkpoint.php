<style>
  #map {
    width: 100%;
    height: 300px; /* atur sesuai kebutuhan */
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-top: 10px;
  }
</style>


<!--- modal checkpoint --->
<div class="modal modal-blur fade" id="modal-checkpoint" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form id="checkpoint-form" method="post" action="checkpoint/add">
      <input type="hidden" id="staff-checkpoint-token" name="public_token" value="<?= $public_token; ?>" />
      <input type="hidden" id="lat-checkpoint" name="lat" value="" />
      <input type="hidden" id="long-checkpoint" name="long" value="" />
      <input type="hidden" id="staff-checkpoint-id" name="id" />

      <div class="modal-content">
        <div class="modal-header">
          <h5 id="staff-checkpoint-title" class="modal-title">Checkpoint</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md">
              <div class="form-label">Status</div>
              <select name="status" id="status-checkpoint" class="form-select">
                <option value="active">Active</option>
                <option value="inactive">Nonactive</option>
              </select>
            </div>
            <div class="col-md">
              <div class="form-label">Patokan</div>
              <select id="patokan-checkpoint" name="patokan" class="form-select">
                <option value="event">Event</option>
                <option value="kordinat">Kordinat</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div id="container-nama-event" class="col-md">
              <div class="form-label">Nama Event</div>
              <input type="text" value="" id="checkpoint-name-event" name="nama-event">
            </div>
          </div>

          <div class="row">
            <div id="container-nama-lokasi" class="col-md">
              <div class="form-label">Lokasi / Kordinat</div>
              <input type="text" name="lokasi" id="locationInput" placeholder="Contoh: Jakarta atau -6.2, 106.8">
            </div>
          </div>

          <div class="row mb-3">
            <div id="map"></div>
          </div>

          <div class="row mb-3">
            <div class="col mb-3">
              <label class="form-label">Jenis</label>
              <input type="radio" name="jenis" value="dinamis"> Dinamis
              <input type="radio" name="jenis" checked value="statis"> Statis
            </div>
            <div class="col mb-3">
              <label class="form-label">Unit Divisi</label>
              <input type="radio" id="checkpoint_unit_division_public" name="unit_division" checked value="public"> Public
              <input type="radio" id="checkpoint_unit_division_private" name="unit_division" value="private"> Private

              <div id="division-select-container" class="mt-2 d-none">
                <div class="division-row mb-2 d-flex align-items-center">
                  <select class="form-select division-select me-2" name="division[]" style="flex: 1;">
                    <option value="">Loading...</option>
                  </select>
                  <button type="button" class="btn btn-sm btn-outline-danger btn-remove-division">Remove</button>
                </div>
                <button type="button" id="add-division-btn" class="btn btn-sm btn-outline-primary">Add Another Division</button>
              </div>
            </div>
          </div>

           <div class="row mb-3">
            <div class="col mb-3">
              <label class="form-label">Starting Time</label>
               <input type="time" class="form-control" id="starting_time" name="starting_time">
            </div>

            <div class="col mb-3">
              <label class="form-label">Starting Date</label>
               <input type="date" class="form-control" id="starting_date" name="starting_date">
            </div>

         
           
          </div>

          <div class="row mb-3">

               <div class="col mb-3">
              <label class="form-label">Expired Mode</label><br>
              <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="expired_mode" id="expired1h" value="1 hour after" checked>
                <label for="expired1h" class="form-check-label">1 Hour After</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="expired_mode" id="expired2h" value="2 hour after">
                <label for="expired2h" class="form-check-label">2 Hours After</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="expired_mode" id="expired_unlimited" value="unlimited">
                <label for="expired_unlimited" class="form-check-label">Unlimited</label>
              </div>
            </div>

          </div>

          <div class="row mb-3">
            <div class="mb-3" id="preview-qr-section">
              <label class="form-label">Generated QR :</label>
              <img class="img-fluid" alt="" src="" id="generated-qr">
              <br>
              <i class="fa-solid fa-file-pdf"></i>
              <a id="checkpoint-download" href="#">Download as PDF</a>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <a href="#" id="link-checkpoint-cancel" data-need-refresh="" class="btn btn-link link-secondary">Cancel</a>
          <a id="link-generate-qrcode" href="#" class="btn btn-primary ms-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
              <path d="M7 17l0 .01" />
              <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
              <path d="M7 7l0 .01" />
              <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
              <path d="M17 7l0 .01" />
              <path d="M14 14l3 0" />
              <path d="M20 14l0 .01" />
              <path d="M14 14l0 3" />
              <path d="M14 20l3 0" />
              <path d="M17 17l3 0" />
              <path d="M20 17l0 3" />
            </svg>
            <span class="btn-text">Generate QR Checkpoint</span>
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
