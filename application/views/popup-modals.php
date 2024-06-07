 <div class="modal modal-blur fade" id="modal-loading" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="modal-body">
                 <center>
                <img src="/assets/img/loading.gif" />
                </center>
              </div>
            </div>
          </div>
        </div>
 </div>

<div class="modal modal-blur fade" id="modal-activation" tabindex="-1" role="dialog" aria-hidden="true">
  <form id="activation-form" method="post" action="/staff/add" >
    <input type="hidden" id="staff-activation-token" name="public_token" value="<?= $public_token; ?>" />
     <input type="hidden" id="staff-activation-id" name="id" />
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="staff-activation-title" class="modal-title">Staff Activation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input id="staff-activation-name" type="text" class="form-control" readonly name="name" placeholder="Staff Name">
            </div>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input id="staff-activation-email" readonly name="email" type="email" class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">No.Whatsapp</label>
                  <input id="staff-activation-whatsapp" readonly name="whatsapp" type="text" class="form-control">
                </div>
              </div>
             
            </div>
          </div>

           <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Activation By :</label>
            <div class="inner-button">        
            <a id="btn-activation-email" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
             <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
              Activate by Email
            </a>
          </div>
            <div class="inner-button">
           <a id="btn-activation-whatsapp" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/ -->
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
              Activate by Whatsapp
            </a>
          </div>
                </div>
              </div>
           
             
            </div>
          </div>

          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a id="link-activation-staff" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Save Staff Data
            </a>
          </div>
        </div>
      </div>
    </form>
    </div>

 <div class="modal modal-blur fade" id="modal-staff" tabindex="-1" role="dialog" aria-hidden="true">
  <form id="staff-form" method="post" action="/staff/add" >
    <input type="hidden" id="staff-token" name="public_token" value="<?= $public_token; ?>" />
     <input type="hidden" id="staff-id" name="id" />
      <div class="modal-dialog modal-lg" role="document">
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
                  <input id="staff-status_aktif" type="radio" name="status" value="aktif" class="form-selectgroup-input" checked>
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
                  <input id="staff-status_non_aktif" type="radio" name="status" value="non-aktif" class="form-selectgroup-input">
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
                  <label class="form-label">Unit Divisi</label>
                  <div class="input-group input-group-flat">
                    
                    <input id="staff-unit_division" name="unit_division" type="text" class="form-control ps-0" autocomplete="off">
                  </div>
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
          </div>
          <div class="modal-body">
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
      </div>
    </form>
    </div>

     <div class="modal modal-blur fade" id="modal-bugs" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Laporkan Bugs</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Judul:</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
            <label class="form-label">Prioritas:</label>
            <div class="form-selectgroup-boxes row mb-3">
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Penting</span>
                      <span class="d-block text-muted">Termasuk fitur pokok dalam sistem.</span>
                    </span>
                  </span>
                </label>
              </div>
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Biasa Saja</span>
                      <span class="d-block text-muted">Hal lain yang dianggap sebagai penambahan atau ide baru terhadap sistem.</span>
                    </span>
                  </span>
                </label>
              </div>
            </div>
            <div class="row">
              
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Screenshot</label>
                  <input type="file" class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">URL (optional):</label>
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="col-lg-12">
                <div>
                  <label class="form-label">Deskripsi:</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Laporkan Bugs ini!
            </a>
          </div>
        </div>
      </div>
    </div>

     <div class="modal modal-blur fade" id="modal-konsultasi" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pengajuan Konsultasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Judul</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
           
            <div class="col-lg-12">
                <div>
                  <label class="form-label">Deskripsi</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </div>
          </div>
        
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Kirimkan Pengajuan!
            </a>
          </div>
        </div>
      </div>
    </div>

     <div class="modal modal-blur fade" id="modal-konsultasi" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pengajuan Konsultasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Judul</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
           
            <div class="col-lg-12">
                <div>
                  <label class="form-label">Deskripsi</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </div>
          </div>
        
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Kirimkan Pengajuan!
            </a>
          </div>
        </div>
      </div>
    </div>