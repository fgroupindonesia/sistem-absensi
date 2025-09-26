<!--- modal staff --->

<div class="modal fade" id="modal-staff" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <form id="staff-form" method="post" action="staff/add" >
        <input type="hidden" id="staff-token" name="public_token" value="<?= $public_token; ?>" />
        <input type="hidden" id="staff-id" name="id" />
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="staff-title" class="modal-title">New Staff</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input id="staff-name" type="text" class="form-control" name="name" placeholder="Staff Name">
            </div>
            <div class="mb-3">
              <label class="form-label">No. Identitas/KTP</label>
              <input id="staff-number_ic" type="text" class="form-control" name="number_ic" placeholder="no.ktp / tanda pengenal">
            </div>
            <label class="form-label">Status Aktif</label>
            <div class="form-selectgroup-boxes row mb-3">
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input id="staff-status_aktif" type="radio" name="status" value="active" class="form-selectgroup-input" checked>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Bekerja</span>
                      <span class="d-block text-muted">Masih aktif bekerja sampai sekarang</span>
                    </span>
                  </span>
                </label>
              </div>
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input id="staff-status_non_aktif" type="radio" name="status" value="inactive" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Non Aktif</span>
                      <span class="d-block text-muted">Telah usai masa kontrak bulanan dan atau proyek singkat.</span>
                    </span>
                  </span>
                </label>
              </div>
            </div>
            <div class="row">
          <div class="col-lg-8">
    <div class="mb-3">
        <label class="form-label">Unit Divisi <span><i id="management-division" class="fas fa-cog"></i> </span></label> 
        <div id="division-container">
            <!-- Slot Divisi Template -->
            <div class="division-row input-group input-group-flat mb-2">
                
                <!-- Container select + delete slot -->
                <div class="select-slot-group input-group">
                    <select name="unit_division[]" class="form-select">
                        <option value="">Pilih Divisi</option>
                    </select>
                    <button type="button" class="btn btn-outline-danger btn-delete-slot" title="Hapus Slot">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                
                <!-- Input add new division -->
                <input type="text" class="form-control division-input-new d-none" placeholder="Nama Divisi Baru">
                
                <button type="button" class="btn btn-outline-success btn-save-division d-none" title="Simpan">
                    <i class="fas fa-save"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary btn-cancel-division d-none" title="Batal">
                    <i class="fas fa-xmark"></i>
                </button>
               
            </div>
        </div>

        <!-- Tombol Add Slot -->
        <button type="button" id="btn-add-division-row" class="btn btn-sm btn-success mt-2">+ Tambah Divisi</button>
    </div>
</div>



              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Jenis Kelamin</label>
                  <select id="staff-kelamin" name="kelamin" class="form-select">
                    <option value="1" selected>Pria</option>
                    <option value="2">Wanita</option>
                  </select>
                </div>
              </div>
            </div>

      
       
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input id="staff-email" name="email" type="email" class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">No.Whatsapp</label>
                  <input id="staff-whatsapp" name="whatsapp" type="text" class="form-control">
                </div>
              </div>
              <div class="col-lg-12">
                <div>
                  <label class="form-label">Catatan</label>
                  <textarea id="staff-notes" name="notes" class="form-control" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a id="link-save-staff" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Save Staff Data
            </a>
          </div>
        </div>
        </form>
      </div>
    </div>