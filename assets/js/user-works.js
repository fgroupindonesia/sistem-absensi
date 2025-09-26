
const URL_ADD_NEW_USER = URL_MAIN_PORTAL + "user/add";
const URL_UPDATE_USER = URL_MAIN_PORTAL + "user/update";
const URL_EDIT_USER = URL_MAIN_PORTAL + "user/edit";
const URL_DELETE_USER = URL_MAIN_PORTAL + "user/delete";
const URL_CHECK_EMAIL_USER = URL_MAIN_PORTAL + "user/check/email";
const URL_UPGRADE_MEMBERSHIP = URL_MAIN_PORTAL + 'user/upgrade-membership';

const defaultAvatar = URL_MAIN_PORTAL + "assets/img/avatars/sample.jpg";

$(document).ready(function() {

  actionDeleteUser();
  actionEditUser();

  emailIntoUsername();
  coordinateChanges();

  // intercept submit form
  submitUserForm();

  // saat form ditutup
  modalOnClose();

  // offering upgrades
  offeringUpgradeMembership();

});

function offeringUpgradeMembership(){


  $(document).on('click', '.upgrade-user', function(e){
    e.preventDefault();

    let userId = $(this).data('id');
    let currentMembership = $(this).closest('tr').find('td:nth-child(7)').text().trim(); // desktop
    if(!currentMembership){
      // fallback mobile
      currentMembership = $(this).closest('.card-body').find('p strong:contains("Membership:")').parent().text().replace('Membership:', '').trim();
    }

    let options = [];
    if(currentMembership === 'gratis'){
      options = ['Sederhana', 'Developer', 'Ultimate'];
    } else if(currentMembership === 'sederhana'){
      options = ['Developer', 'Ultimate'];
    } else if(currentMembership === 'developer'){
      options = ['Ultimate'];
    } else if(currentMembership === 'ultimate'){
     
      Swal.fire({
          title: 'Info',
          html: 'User sudah di level <b>Ultimate</b>, tidak ada upgrade lagi.',
          icon: 'info',
          timer: 1200,
          showConfirmButton: false
        });

      return;
    }

    Swal.fire({
      title: 'Upgrade Membership',
      text: 'Pilih level upgrade untuk user ini',
      input: 'select',
      inputOptions: options.reduce((obj, val) => { obj[val]=val; return obj; }, {}),
      inputPlaceholder: 'Pilih level...',
      showCancelButton: true,
      confirmButtonText: 'Upgrade',
      cancelButtonText: 'Batal'
    }).then((result)=>{
      if(result.isConfirmed){
        let level = result.value;

        // call route via POST
       $.post(URL_UPGRADE_MEMBERSHIP, {id: userId, level: level}, function(resp){
        Swal.fire({
          title: 'Sukses',
          html: 'User berhasil di upgrade ke <strong>' + level + '</strong>',
          icon: 'success',
          timer: 1200,
          showConfirmButton: false
        }).then(()=>{
          location.reload(); // reload biar table/card update
        });
      });



      }
    });
  });


}

function modalOnClose(){

  $('#modal-user').on('hidden.bs.modal', function () {
    let form = $(this).find('form');

    // reset semua input, textarea, select
    form[0].reset();

    // reset avatar
    let avatarImg = $(this).find('.avatar');
    avatarImg.attr('src', defaultAvatar);
    $(this).find('#btn-delete-avatar').addClass('d-none');

    // reset status
    $('#status-user').text('-');

    // reset submit button
    $('#btn-submit').prop('disabled', false).text('Submit');

    // jika ada select2 atau plugin lain, bisa trigger ulang jika perlu
    // $('select').trigger('change');
});


}

function actionEditUser(){

 
 $(document).on('click', '.edit-user', function(e){
    e.preventDefault();
    let userId = $(this).data('id');

    $.ajax({
        url: URL_EDIT_USER,
        type: 'POST',
        dataType: 'json',
        data: { id: userId, mode: 'management' },
        success: function(res) {
            if(res.status == 'success') {
                let user = res.data;

                // isi hidden id
                $('#id-user').val(user.id);
                $('#public-token-user').val(user.public_token);

                // avatar
                let avatarImg = $('#modal-user .avatar');
                if(user.avatar != 'sample.jpg'){
                    avatarImg.attr('src', URL_MAIN_PORTAL + 'assets/img/avatars/' + user.avatar);
                    $('#btn-delete-avatar').removeClass('d-none');
                } else {
                    avatarImg.attr('src', defaultAvatar);
                    $('#btn-delete-avatar').addClass('d-none');
                }

                // login info
                $('input[name="username"]').val(user.username);
                $('input[name="email"]').val(user.email);
                $('input[name="pass"]').val(user.pass || '');

               // status
                let statusSpan = $('#status-user');

                if(user.status == 'active'){
                    statusSpan.html('<i class="fas fa-check-circle text-success me-1"></i> Active');
                } else if(user.status == 'pending'){
                    statusSpan.html('<i class="fas fa-clock text-warning me-1"></i> Pending');
                } else {
                    statusSpan.html('<i class="fas fa-minus-circle text-secondary me-1"></i> -');
                }


                // bio
                $('textarea[name="bio"]').val(user.bio || '');

                // whatsapp
                $('input[name="whatsapp"]').val(user.whatsapp || '');

                // membership
                $('input[name="membership"]').prop('checked', false);
                if(user.membership){
                    $('input[name="membership"][value="'+user.membership+'"]').prop('checked', true);
                }

               $('select[name="country"]').val(user.country || '').trigger('change');

               $('select[name="region"]').off('loadedRegion').one('loadedRegion', function(){
                  $(this).val(user.region || '').trigger('change'); // akan memicu city load
              });

              $('select[name="city"]').off('loadedCity').one('loadedCity', function(){
                  $(this).val(user.city || '');
              });



                // address
                $('textarea[name="address"]').val(user.address || '');

                // public profile
                $('input[name="public_profile"]').prop('checked', user.public_profile == 1);

                // buka modal
                $('#modal-user').modal('show');

                $('#btn-submit').text('Update Data');

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.message || 'Gagal mengambil data user!'
                });
            }
        },
        error: function(err){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan server!'
            });
        }
    });
});



}

function submitUserForm() {
  $("#user-form").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this); // <== bisa handle file + text

    let userId = $('#id-user').val();
    let ajaxUrl = userId ? URL_UPDATE_USER : URL_ADD_NEW_USER;

    $.ajax({
      url: ajaxUrl,
      type: "POST",
      data: formData,
      dataType: "json",
      contentType: false, // <== WAJIB
      processData: false, // <== WAJIB
      beforeSend: function () {
        $("#btn-submit").prop("disabled", true).text("Processing...");
      },
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: response.message,
            timer: 2000,
            showConfirmButton: false
          });

          setTimeout(function () {
            $("#modal-user").modal("hide");
            
            location.reload();

          }, 2100);

        } else {
          Swal.fire({
            icon: "error",
            title: "Gagal",
            text: response.message,
            timer: 2500,
            showConfirmButton: false
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "warning",
          title: "Terjadi Kesalahan",
          text: error,
          timer: 2500,
          showConfirmButton: false
        });
      },
      complete: function () {
        $("#btn-submit").prop("disabled", false).text("Submit");
      }
    });
  });

  // trigger input file pas klik "Change avatar"
  $("#btn-change-avatar").on("click", function (e) {
    e.preventDefault();
    $("#avatar").trigger("click");
  });

  // preview avatar setelah pilih file
  $("#avatar").on("change", function () {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#avatar").attr("src", e.target.result);
        $("#btn-delete-avatar").removeClass("d-none");
      };
      reader.readAsDataURL(this.files[0]);
    }
  });

  // hapus avatar
  $("#btn-delete-avatar").on("click", function (e) {
    e.preventDefault();
    $("#avatar").val(""); // reset input
    $("#avatar").attr("src", defaultAvatar);
    $(this).addClass("d-none");
  });
}


function actionDeleteUser(){


  $(document).on('click', '.delete-user', function(e){
    e.preventDefault();
    let id = $(this).data('id'); 
    deleteUsers([id]); // kirim sebagai array
  });


  $(document).on('click', '.btn-delete-user', function(e){
    e.preventDefault();
    let selected = $(".user-selected:checked").map(function(){
      return $(this).val();
    }).get();
    deleteUsers(selected);
  });

}

function deleteUsers(ids) {
  if(ids.length === 0){
    Swal.fire({
      icon: 'warning',
      title: 'Oops...',
      text: 'Pilih dulu data user yang mau dihapus!',
      timer: 2000,
      showConfirmButton: false
    });
    return;
  }

  Swal.fire({
    title: "Yakin?",
    text: "Kamu akan menghapus " + ids.length + " data user!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Ya, hapus!",
    cancelButtonText: "Batal"
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: URL_MAIN_PORTAL + "user/delete",
        type: "POST",
        data: {
          ids: ids,
          mode: 'management'
        },
        success: function(res){
          Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "Data user berhasil dihapus!",
            timer: 2000,
            showConfirmButton: false
          }).then(() => {
            location.reload(); 
          });
        },
        error: function(){
          Swal.fire({
            icon: "error",
            title: "Gagal",
            text: "Terjadi kesalahan saat menghapus data!"
          });
        }
      });
    }
  });
}

function coordinateChanges(){

		$('#region').on('change', function(){

  	  			callCitiesData();
	  	});

  	
	 $('#country').on('change', function(){

  		let negeri = $(this).val();

  		if(negeri == 'ID'){
  			callRegionsData();
  		}

  	});

}


  function callRegionsData(){

    //let URL_GEO_FETCH = 'http://geotraverse.com/region?country=ID';
    let URL_GEO_FETCH = 'https://apps.fgroupindonesia.com/geotraverse/region?country=ID';

  	 $('#region').empty();

  	 $.ajax({
      url: URL_GEO_FETCH,
      method: 'GET', 
      dataType: 'json',
      success: function (response) {
        if (response.status === "success") {
          let options = '';
          response.data.forEach(function (region) {
            options += `<option value="${region.state_code}">${region.state_name}</option>`;
          });
          $('#region').append(options);
          $('#region').trigger('loadedRegion');
        } else {
          alert("Gagal mengambil data region.");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", error);
        alert("Terjadi kesalahan saat menghubungi server.");
      }
    });


  }

  function callCitiesData(){

   $('#city').empty();
     let regName = $('#region').val();


   let URL_GEO_FETCH = 'https://apps.fgroupindonesia.com/geotraverse/city?country=ID&region=' + regName;
   //let URL_GEO_FETCH = 'http://geotraverse.com/city?country=ID&region=' + regName;

  
  	 $.ajax({
      url: URL_GEO_FETCH,
      method: 'GET', // Sesuai permintaan Anda, pakai POST meskipun API ini mungkin default GET
      dataType: 'json',
      success: function (response) {
        if (response.status === "success") {
          let options = '';
          response.data.forEach(function (city) {
            options += `<option value="${city.value}">${city.text}</option>`;
          });
          $('#city').append(options);
          $('#city').trigger('loadedCity');
        } else {
          alert("Gagal mengambil data city.");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", error);
        alert("Terjadi kesalahan saat menghubungi server.");
      }
    });


  }

function emailIntoUsername() {
    let form = $('#user-form');
    let emailInput = form.find('input[name="email"]');
    let usernameInput = form.find('input[name="username"]');
    let statusSpan = $('#status-user'); // span untuk status icon

    // auto generate username
    emailInput.on('keyup', function () {
        let emailVal = $(this).val();
        let username = emailVal.split('@')[0];
        usernameInput.val(username);
    });

    // cek email di server pas selesai ngetik (blur / change)
    let typingTimer;
    emailInput.on('keyup', function () {
        clearTimeout(typingTimer);
        let emailVal = $(this).val();

        typingTimer = setTimeout(function () {
            if (emailVal.length > 3) {
                $.ajax({
                    url: URL_CHECK_EMAIL_USER,
                    method: "POST",
                    data: { email: emailVal },
                    dataType: "json",
                    success: function (res) {
                        if (res.status=='failed') {
                            statusSpan.html('<i class="fa fa-exclamation-circle text-danger"></i> ' + res.message);
                        } else {
                            statusSpan.html('<i class="fa fa-check-circle text-success"></i> ' + res.message);
                        }
                    },
                    error: function () {
                        statusSpan.html('<i class="fa fa-times-circle text-warning"></i> Error cek email');
                    }
                });
            } else {
                statusSpan.html('');
            }
        }, 600); // jeda biar ga nembak tiap ketik
    });
}

