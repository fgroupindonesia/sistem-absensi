 <!-- modal preview image fullscreen -->

<div class="modal fade" id="modal-image-fullscreen" tabindex="-1" aria-labelledby="fullscreenImageModalLabel" aria-hidden="true">
  <div class="modal-fullscreen modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fullscreenImageModalLabel">Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="<?= base_url(); ?>assets/img/qrcodes/none.jpg" alt="Fullscreen Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>


<!--- modal loading -->

<div class="modal modal-blur fade" id="modal-loading" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <!-- Konten loading di sini -->
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <p>Loading, silakan tunggu...</p>
      </div>
    </div>
  </div>
</div>



<!-- modal-checkpoint started -->

<div class="modal modal-blur fade" id="modal-checkpoint" tabindex="-1" role="dialog" >
  <form id="checkpoint-form" method="post" action="checkpoint/add" >
    <input type="hidden" id="staff-checkpoint-token" name="public_token" value="<?= $public_token; ?>" />

<input type="hidden" id="lat-checkpoint" name="lat" value="" />
<input type="hidden" id="long-checkpoint" name="long" value="" />

     <input type="hidden" id="staff-checkpoint-id" name="id" />
      <div class="modal-dialog modal-lg" role="document">
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
                         <option value="active" >Active</option>
                         <option value="non-active" >Nonactive</option>
                       </select>
                      </div>
                      <div class="col-md">
                        <div class="form-label">Patokan</div>
                        <select id="patokan-checkpoint" name="patokan" class="form-select">
                           <option value="event" >Event</option>
                           <option value="kordinat" >Kordinat</option>
                       </select>
                      </div>

            </div>

     

            <div class="row mb-3">
           
           <div class="row">
                    
                      <div id="container-nama-event" class="col-md">
                        <div class="form-label">Nama Event</div>
                        <input type="text" value="" name="nama-event" >
                      </div>

            </div>

            <div class="row">
                    
                      <div id="container-nama-lokasi" class="col-md">
                        <div class="form-label">Nama Lokasi / Kordinat</div>
                          <input type="text" name="lokasi" id="locationInput" placeholder="Contoh: Jakarta atau -6.2, 106.8">
                      </div>
            </div>



          </div>

          <div class="row mb-3">
  
              <div id="map"> </div>

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


          <div class="row mb-3">
            <div class="mb-3" id="preview-qr-section">
              <label class="form-label">Generated QR :</label>
              <img class="img-fluid" alt="" src="" id="generated-qr"> 
              <br>
              <i class="fa-solid fa-file-pdf"></i><a id="checkpoint-download" href="#" >Download as PDF</a>
            </div>
          </div>

     </div>
          <div class="modal-footer">
            <a href="#" id="link-checkpoint-cancel" data-need-refresh="" class="btn btn-link link-secondary" >
              Cancel
            </a>
              <a id="link-generate-qrcode" href="#" class="btn btn-primary ms-auto" >
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
             <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M7 17l0 .01" /><path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M7 7l0 .01" /><path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M17 7l0 .01" /><path d="M14 14l3 0" /><path d="M20 14l0 .01" /><path d="M14 14l0 3" /><path d="M14 20l3 0" /><path d="M17 17l3 0" /><path d="M20 17l0 3" /></svg>
              Generate QR Checkpoint
            </a>
          </div>
        </div>
      </div>
    </form>

    </div>


<!-- modal-checkpoint done -->

<!-- modal-activation started -->

<div class="modal modal-blur fade" id="modal-activation" tabindex="-1" role="dialog" >
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
            <div class="row">
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input id="staff-activation-name" type="text" class="form-control" readonly name="name" placeholder="Staff Name">
            </div>
          </div>

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


    <!-- modal-activation done -->

 <div class="modal fade" id="modal-staff" tabindex="-1" aria-hidden="true">

  <form id="staff-form" method="post" action="staff/add" >
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
      </div>
    </form>
    </div>


<!-- modal-staff done -->

<!--- modal bugs -->

     <div class="modal modal-blur fade" id="modal-bugs" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="bugs_report_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Laporkan Bugs</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Judul:</label>
            <input type="text" class="form-control" name="title" placeholder="Your report name">
          </div>

          <label class="form-label">Prioritas:</label>
          <div class="form-selectgroup-boxes row mb-3">
            <div class="col-lg-6">
              <label class="form-selectgroup-item">
                <input type="radio" name="priority_bugs" value="1" class="form-selectgroup-input" checked>
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
                <input type="radio" name="priority_bugs" value="0" class="form-selectgroup-input">
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
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">Screenshot</label>
                <input type="file" class="form-control" name="screenshot">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">URL (optional):</label>
                <input type="text" class="form-control" name="url">
              </div>
            </div>
            <div class="col-lg-12">
              <div class="mb-3">
                <label class="form-label">Deskripsi:</label>
                <textarea class="form-control" rows="3" name="description"></textarea>
              </div>
            </div>
          </div>

          <!-- Public Token disisipkan di hidden input -->
          <input type="hidden" name="public_token" value="<?= $akses->getPublicToken(); ?>">
        </div>

        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
          <a href="#" class="btn btn-primary ms-auto" id="submit-bug-report">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="12" y1="5" x2="12" y2="19"></line>
              <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Laporkan Bugs ini!
          </a>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- modal konsultasi -->

    <div class="modal modal-blur fade" id="modal-konsultasi" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="form-pengajuan-konsultasi">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pengajuan Konsultasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" placeholder="Your report name">
          </div>
          <div class="col-lg-12">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" rows="3" name="deskripsi"></textarea>
          </div>
          <input type="hidden" name="public_token" value="<?= $akses->getPublicToken(); ?>">
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
          <button type="submit" id="submit-pengajuan-konsultasi" class="btn btn-primary ms-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Kirimkan Pengajuan!
          </button>
        </div>
      </div>
    </form>
  </div>
</div>


    <!-- Modal divisionModal -->
<div class="modal fade" id="divisionModal" tabindex="-1" aria-labelledby="divisionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="divisionModalLabel">Manage Division</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <!-- Form -->
        <form id="divisionForm">
          <input type="hidden" id="divisionId" name="id">
          <input type="hidden" id="divisionPublicToken" name="public_token" value="<?=$akses->getPublicToken(); ?>">
          <div class="mb-3">
            <label for="divisionName" class="form-label">Division Name</label>
            <input type="text" class="form-control" id="divisionName" name="name" placeholder="Enter Division Name" required>
          </div>
          <button type="submit" class="btn btn-primary" id="saveDivision">Save</button>
          <button type="reset" class="btn btn-secondary" id="resetDivision">Reset</button>
        </form>

        <hr>

        <!-- Responsive Table -->
        <div class="table-responsive d-none d-md-block">
          <table class="table table-bordered" id="divisionTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Data akan di load lewat JS -->
            </tbody>
          </table>
        </div>

        <!-- Card layout untuk mobile -->
        <div class="d-block d-md-none" id="divisionCards">
          <!-- Card akan di load lewat JS -->
        </div>

      </div>
    </div>
  </div>
</div>