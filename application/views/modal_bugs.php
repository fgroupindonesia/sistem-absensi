<!--- modal bugs --->

     <div class="modal modal-blur fade" id="modal-bugs"  tabindex="-1" aria-hidden="true">
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
