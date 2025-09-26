let _selected_id = [];
const URL_UPDATE_CHECKPOINT = URL_MAIN_PORTAL + "checkpoint/update";
const URL_DELETE_CHECKPOINT = URL_MAIN_PORTAL + "checkpoint/delete";
const URL_EDIT_CHECKPOINT = URL_MAIN_PORTAL + "checkpoint/edit";

const URL_DEVICE_DISPLAY = URL_MAIN_PORTAL + "device/checkpoint/display/";

$(document).ready(function() {



  $('.checkbox-checkpoint').on('change', function() {
    let id = $(this).val();
    if ($(this).is(':checked')) {
      addIntoArray(id);

    } else {
      removeFromArray(id);
    }
  });

// lebih dinamis saat di klik meskipun element 
  // baru di render oleh js
$(document).on('click', '.link-qrcode-dinamis', function() {
    let urlna = $(this).data('link');   // aman
    //alert("urlna =", urlna);

    let urltarget = URL_DEVICE_DISPLAY + urlna;
    window.location.href = urltarget;
});

  delete_checkpoint_selected();
  show_checkpoint_preview();
  update_status_checkpoint();
  edit_checkpoint_selected();
  clear_checkpoint_done();
});

function clear_checkpoint_done(){

  // klo udah beres modalnya maka clear form nya
  $('#modal-checkpoint').on('hidden.bs.modal', function () {
    $('#checkpoint-form')[0].reset();
    $('#preview-qr-section').hide();
    $('#staff-checkpoint-id').val('');
    $('#checkpoint-form').attr('action', URL_ADD_CHECKPOINT);
    $('#link-generate-qrcode .btn-text').text('Generate QR Checkpoint');
});

}

function edit_checkpoint_selected(){


    $(document).on('click', '.link-edit-checkpoint', function(){

    let idNa = $(this).data('id');
    let tokenNa = $(this).data('token');

    editCheckpoint(idNa, tokenNa);

  }); 


}

function editCheckpoint(idMasuk, tokenMasuk){

  let dataForm = {id: idMasuk, public_token:tokenMasuk};

  // after timeout render into the edit form
  let urlNa = URL_EDIT_CHECKPOINT;
  
    // ajax post started
     $.ajax({
          url: urlNa, 
          type: "POST",
          data: dataForm,
          success: function(response) {
            
            //refreshMe();
            console.log(response);
           
              displayCheckpointForm(idMasuk, tokenMasuk, response);
            

          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log('ERROR', textStatus, errorThrown);
              console.log(jqXHR.responseText);
              
          }
     }); // ajax post ended


}

function displayCheckpointForm(idMasuk, tokenMasuk, dataJSON) {
  // pastiin JSON valid
  dataJSON = JSON.parse(dataJSON);

  let formCheckpoint = $('#modal-checkpoint').find('#checkpoint-form');
  formCheckpoint.attr('action', URL_UPDATE_CHECKPOINT); // default update
  $('#staff-checkpoint-id').val(idMasuk);
  $('#staff-checkpoint-token').val(tokenMasuk);

  // title modal
  $('#staff-checkpoint-title').text("Edit Checkpoint");

  // isi select status
  $('#status-checkpoint').val(dataJSON.status);

  // isi select patokan
  $('#patokan-checkpoint').val(dataJSON.patokan);

  // isi nama event / lokasi
  $('#checkpoint-name-event').val(dataJSON.name || "");
  $('#locationInput').val(dataJSON.location || "");

  // koordinat
  $('#lat-checkpoint').val(dataJSON.lat || "");
  $('#long-checkpoint').val(dataJSON.long || "");

  // starting time starting date
  $('#starting_time').val(dataJSON.starting_time || "");
  $('#starting_date').val(dataJSON.starting_date || "");

  if(dataJSON.expired_mode == 'unlimited'){

    $('#expired_unlimited').prop('checked', true);
    $('#expired1h').prop('checked', false);
    $('#expired2h').prop('checked', false);
  } else if(dataJSON.expired_mode == '1 hour after'){

    $('#expired_unlimited').prop('checked', false);
    $('#expired1h').prop('checked', true);
    $('#expired2h').prop('checked', false);
  } else if(dataJSON.expired_mode == '2 hour after'){

    $('#expired_unlimited').prop('checked', false);
    $('#expired1h').prop('checked', false);
    $('#expired2h').prop('checked', true);
  }

  // jenis (radio)
  $('input[name="jenis"][value="' + dataJSON.jenis + '"]').prop('checked', true);

  // unit division
  if (dataJSON.unit_division === "private") {
    $('#checkpoint_unit_division_private').prop('checked', true);
    $('#checkpoint_unit_division_public').prop('checked', false);
    $('#division-select-container').removeClass('d-none');
  } else {
    $('#checkpoint_unit_division_public').prop('checked', true);
    $('#checkpoint_unit_division_private').prop('checked', false);
    $('#division-select-container').addClass('d-none');
  }

  // divisions (hapus dulu isi lama, kecuali row pertama)
  let container = $('#division-select-container');
  container.find('.division-row:not(:first)').remove(); // hapus clone-an lama

  if (Array.isArray(dataJSON.divisions)) {
    dataJSON.divisions.forEach(function (divisi, idx) {
      let row;
      if (idx === 0) {
        row = container.find('.division-row:first');
      } else {
        row = container.find('.division-row:first').clone();
        container.find('#add-division-btn').before(row);
      }
      row.find('select').val(divisi.id);
    });
  }

  // preview QR jika ada
  if (dataJSON.qr_code) {
    $('#preview-qr-section img').attr('src', URL_MAIN_PORTAL + 'assets/img/qrcodes/' + dataJSON.qr_code).show();
    $('#preview-qr-section img').attr('alt', dataJSON.data_safe_embed);
    $('#checkpoint-download').attr('href', '#').show();

    $('#preview-qr-section').show();
  } else {
    $('#preview-qr-section').hide();
  }

  // tombol save
  $('#link-generate-qrcode .btn-text').text("Update QR Checkpoint");
}


function call_update_checkpoint(id, status, token){

   $.ajax({
        url: URL_UPDATE_CHECKPOINT, // ganti dengan URL tujuan
        type: 'POST',
        dataType: 'json',
        data: {
            public_token: token,
            id: id,
            status: status
        },
        success: function(jawab) {

         // let jawab = JSON.parse(response);

          if(jawab.status ==='success'){
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: jawab.message,
                timer: 1800,
                showConfirmButton: false
            }).then(() => {
                location.reload(); // refresh halaman
            });

          }
            
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan: ' + error
            });
        },
        timeout: 5000 // timeout 5 detik
    });


}

function update_status_checkpoint(){

  $(document).on('click', '.link-turnoff-checkpoint', function(e){

    e.preventDefault();

    var public_token = $('body').attr('data-token');
    var id = $(this).attr('data-id');
    var status = "inactive"; // contoh status

    call_update_checkpoint(id, status, public_token);

  });

   $(document).on('click', '.link-activate-checkpoint' , function(e){

    e.preventDefault();

    var public_token = $('body').attr('data-token');
    var id = $(this).attr('data-id');
    var status = "active"; // contoh status

    call_update_checkpoint(id, status, public_token);

  });

}
function show_checkpoint_preview(){

  $(document).on('click', '.qr-preview', function(){

    let urlGbr = $(this).attr('src');
    let judul = $(this).attr('data-title');

    $('#modal-image-fullscreen').find('img').attr('src', urlGbr);
    $('#fullscreenImageModalLabel').text('Checkpoint Event : ' + judul);
  
    $('#modal-image-fullscreen img').on('click', function(e){

       
    });


  });

}

function addIntoArray(id) {
  if (!_selected_id.includes(id)) {
    _selected_id.push(id);
  }
}

function removeFromArray(id) {
  const index = _selected_id.indexOf(id);
  if (index > -1) {
    _selected_id.splice(index, 1);
  }

  if(_selected_id.length==0){
    $('.btn-delete-checkpoint').hide();
    //alert('a');
  }
}

function hapusDataTunggal(datana){

  let nama = "<b>'" +datana.name+"'</b>";

   Swal.fire({
        title: "Apakah kamu yakin?",
        html: "Data checkpoint <br>" + nama + " <br>ini akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // kirim AJAX
            $.ajax({
                url: URL_DELETE_CHECKPOINT,
                type: "POST",
                data: datana,
                dataType: "json",
                success: function(jawab) {
                  //let jawab = JSON.parse(res);

                    if (jawab.status == 'success') {
                          
                           Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: jawab.message,
                            timer: 1800,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // refresh halaman
                        });


                       
                    } else {
                        Swal.fire("Gagal!", jawab.message, "error");
                    }
                },
                error: function() {
                    Swal.fire("Error!", "Terjadi kesalahan server.", "error");
                }
            });
        } else {
            // kalau pilih batal
            //Swal.fire("Dibatalkan", "Data aman, tidak jadi dihapus.", "info");
        }
    });

}

function delete_checkpoint_selected() {
  let token = $('body').attr('data-token');
  let url = URL_DELETE_CHECKPOINT;

  $('.link-delete-checkpoint').on('click', function(e){

    e.preventDefault();
    let idna = $(this).attr('data-id');
    let namena = $(this).attr('data-name');
    let datana = {id: idna, public_token: token, name: namena};


    hapusDataTunggal(datana);


  });

  $('.btn-delete-checkpoint').on('click', function () {
    if (_selected_id.length === 0) {
      Swal.fire({
        icon: 'warning',
        title: 'Oops!',
        text: 'Tidak ada data terpilih!',
        timer: 2000,
        showConfirmButton: false
      });
      return;
    }

    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: 'Semua checkpoint terpilih akan dihapus!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Jalankan penghapusan
        let requests = _selected_id.map(id => {
          return $.ajax({
            url: url,
            method: 'POST',
            data: {
              id: id,
              public_token: token
            }
          });
        });

        Promise.all(requests)
          .then(results => {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: 'Semua checkpoint berhasil dihapus!',
              timer: 2000,
              showConfirmButton: false
            });
            setTimeout(() => location.reload(), 2000);
          })
          .catch(err => {
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: 'Terjadi kesalahan saat menghapus sebagian checkpoint.',
              timer: 2500,
              showConfirmButton: false
            });
            console.error(err);
          });
      }
    });
  });
}
