const URL_DASHBOARD_DIVISION_ALL = URL_MAIN_PORTAL + 'staff/division/all';
const URL_STAFF_DIVISION_ADD = URL_MAIN_PORTAL + 'staff/division/add';
const URL_STAFF_DIVISION_DELETE = URL_MAIN_PORTAL + 'staff/division/delete';
const URL_STAFF_DIVISION_UPDATE = URL_MAIN_PORTAL + 'staff/division/update';

$(document).ready(function() {

    clearing_after_division_done();

    division_on_checkpoint_form();

      $('#management-division').on('click', function() {
        // Hide modal utama dulu
        $('#modal-staff').modal('hide');

        // Kasih jeda 300ms baru buka modal manage
        setTimeout(function() {
            $('#divisionModal').modal('show');
        }, 300); // 300ms sesuai animasi hide Bootstrap
    });

    function loadDivisions(selectEl) {
        let pToken = $('body').attr('data-token');
        $.ajax({
            url: URL_DASHBOARD_DIVISION_ALL,
            method: 'POST',
            data: { public_token: pToken },
            success: function(respond) {
                selectEl.empty().append('<option value="">Pilih Divisi</option>');
                if(respond.status == 'success'){
                    respond.data.forEach(function(div) {
                        selectEl.append(`<option value="${div.id}">${div.division_name}</option>`);
                    });
                }
            }
        });
    }

    // Initial load
    $('#division-container select').each(function() {
        loadDivisions($(this));
    });

    // Tambah slot baru
    $('#btn-add-division-row').click(function() {
        let newRow = $('#division-container .division-row:first').clone();
        newRow.find('select').val('');
        newRow.find('.division-input-new').addClass('d-none').val('');
        newRow.find('.btn-save-division, .btn-cancel-division').addClass('d-none');
        newRow.find('.btn-create-division').removeClass('d-none');
        $('#division-container').append(newRow);
        loadDivisions(newRow.find('select'));
    });

  

    // Delete slot (UI only)
    $('#division-container').on('click', '.btn-delete-slot', function() {
        let row = $(this).closest('.division-row');
        row.remove();


    });



    // ini management division usage //

function loadDivisionList(){

  $('#resetDivision').hide();
  let pToken = $('body').attr('data-token');

   $('#divisionTable tbody').html('');
   $('#divisionCards').html('');

  $.post(URL_DASHBOARD_DIVISION_ALL, { public_token: pToken }, function(respond){
    // data diasumsikan JSON [{id:1, name:'Div1'}, ...]

    if(respond.status !== 'success'){
      return;
    }

    let data = respond.data;

    // Table desktop
    let tbody = '';
    let num = 1;

    data.forEach(div => {
      tbody += `<tr>
                  <td>${num}</td>
                  <td>${div.division_name}</td>
                  <td>
                    <button class="btn btn-sm btn-warning editDivision" data-id="${div.id}" data-name="${div.division_name}">Edit</button>
                    <button class="btn btn-sm btn-danger deleteDivision" data-id="${div.id}">Delete</button>
                  </td>
                </tr>`;

              num++;
    });
    $('#divisionTable tbody').html(tbody);

    // Card mobile
    let cards = '';
    num = 1;
    data.forEach(div => {
      cards += `<div class="card mb-2">
                  <div class="card-body">
                    <h5 class="card-title">${div.division_name}</h5>
                    <p class="card-text">No: ${num}</p>
                    <button class="btn btn-sm btn-warning editDivision" data-id="${div.id}" data-name="${div.division_name}">Edit</button>
                    <button class="btn btn-sm btn-danger deleteDivision" data-id="${div.id}">Delete</button>
                  </div>
                </div>`;
    num++;
                    
    });
    $('#divisionCards').html(cards);
  }, 'json'); // pastikan response dari server JSON
}


  loadDivisionList();

      // Save / Update
  $('#divisionForm').submit(function(e){
    e.preventDefault();
    let id = $('#divisionId').val();
    let url = id ? URL_STAFF_DIVISION_UPDATE : URL_STAFF_DIVISION_ADD;
    let formData = $(this).serialize();
    $.post(url, formData, function(res){
      // Reset form
      $('#divisionForm')[0].reset();
      $('#divisionId').val('');
      // Reload table
      loadDivisionList();
    });
  });

  // Edit
  $(document).on('click', '.editDivision', function(){
    let id = $(this).data('id');
    let name = $(this).data('name');
    $('#divisionId').val(id);
    $('#divisionName').val(name);

    $('#resetDivision').show();
  });

  // Delete
  $(document).on('click', '.deleteDivision', function(){
    //if(!confirm('Are you sure?')) return;
    
    let id = $(this).data('id');
    let pToken = $('body').attr('data-token');

    $.post(URL_STAFF_DIVISION_DELETE, {id:id, public_token : pToken}, function(res){
      loadDivisionList();
    });
  }); 


   $(document).on('click', '#resetDivision', function(e){

    // clear the form and the id
   $('#divisionForm')[0].reset();
   $('#divisionId').removeAttr('value');
   $('#resetDivision').hide();

   });
   

});

function clearing_after_division_done(){

 $('#divisionModal').on('hidden.bs.modal', function () {
            location.reload();
 });

}

/* untuk modal division pada checkpoint */
function division_on_checkpoint_form(){

 $('input[name="unit_division"]').on('change', function(){
        if($('#checkpoint_unit_division_private').is(':checked')){
            $('#division-select-container').removeClass('d-none');
            loadDivisions_on_checkpoint_form(); // load first select
        } else {
            $('#division-select-container').addClass('d-none');
            $('#division-select-container .division-select').remove();
        }
    });

// remove division
 $(document).on('click', '.btn-remove-division', function(){
    $(this).closest('.division-row').remove();
});

    // add another division select
$('#add-division-btn').on('click', function(){
    let newSelect = $(`
         <div class="division-row mb-2 d-flex align-items-center">
                  <select class="form-select division-select me-2" name="division[]" style="flex: 1;">
                      <option value="">Loading...</option>
                  </select>
                  <button type="button" class="btn btn-sm btn-outline-danger btn-remove-division">Remove</button>
              </div>
    `);
    $('#add-division-btn').before(newSelect);
    loadDivisions_on_checkpoint_form(newSelect.find('select'));
});


      $('#checkpoint-form').on('submit', function(e){
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'), // checkpoint/add
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res){
                if(res.status == 'success'){
                    alert('Checkpoint berhasil disimpan!');
                    $('#modal-checkpoint').modal('hide');
                } else {
                    alert('Gagal menyimpan checkpoint.');
                }
            },
            error: function(){
                alert('Terjadi error server.');
            }
        });
    });

}

  function loadDivisions_on_checkpoint_form(targetSelect){
        targetSelect = targetSelect || $('#division-select-container .division-select').first();
        let public_token = $('#staff-checkpoint-token').val();

        $.ajax({
            url: URL_DASHBOARD_DIVISION_ALL,
            type: 'POST',
            data: { public_token: public_token },
            dataType: 'json',
            success: function(res){

              if(res.status !== 'success'){
                return;
              }
              
              let data = res.data;

                targetSelect.empty();
                targetSelect.append('<option value="">Pilih Divisi</option>');
                $.each(data, function(i, item){
                    targetSelect.append('<option value="'+item.id+'">'+item.division_name+'</option>');
                });
            },
            error: function(){
                targetSelect.empty().append('<option value="">Error loading divisions</option>');
            }
        });
    }