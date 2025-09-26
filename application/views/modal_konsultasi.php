<!--- modal konsultasi --->

<div class="modal fade" id="modal-konsultasi" tabindex="-1" aria-hidden="true">
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
