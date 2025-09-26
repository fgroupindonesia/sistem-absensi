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