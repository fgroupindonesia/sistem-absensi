
let _region;
let _city;

  $(document).ready(function () {

    $('#country').trigger('change');

    _region = $('#hidden-selectedRegion').val();
    _city   = $('#hidden-selectedCity').val();

  	$('#country').on('change', function(){

  		let negeri = $(this).val();

  		if(negeri == 'ID'){
  			callRegionsData();
  		}

  	});

  		$('#region').on('change', function(){

  	
  			callCitiesData();
  	

  	});


      formSubmission();
      avatarSubmission();   
      updatePass();




  });



function updatePass(callback){

    $('#btn-change-pass').on('click', function(e){

      e.preventDefault();

      showSwalInput(function (text) {
      console.log('User input:', text);
      // Jalankan proses lainnya di sini
       });

    });
 
   
}

function showSwalInput(callback){



   Swal.fire({
      title: 'Masukkan password baru',
      input: 'password',
      inputPlaceholder: 'Ketik di sini...',
      showCancelButton: true,
      confirmButtonText: 'OK',
      allowOutsideClick: true,
      allowEscapeKey: true,
      inputAttributes: {
        autocapitalize: 'off'
      },
      didOpen: () => {
        const input = Swal.getInput();
        input.addEventListener('keyup', function (event) {
          if (event.key === 'Enter') {
            Swal.clickConfirm(); // Trigger OK programmatically
          }
        });
      },
      preConfirm: (value) => {
        if (!value) {
          Swal.showValidationMessage('Tidak boleh kosong!');
        } else {
          return value;
        }
      }
    }).then((result) => {
      if (result.isConfirmed) {
        const userInput = result.value;
         _id_user = $('#admin-settings').find('#id-user').val();

        let datana = {id: _id_user, password: userInput};

        updateNewPass(datana);

        if (callback) callback(userInput);
      }
    });

}

function updateNewPass(formData){

   $.ajax({
            url: URL_MAIN_PORTAL + 'portal/settings/update',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: response.message || 'Data berhasil disimpan!',
                    timer: 2000,
                    showConfirmButton: false
                });

                  setTimeout(function(){
                    window.location.reload();
                  },2500);
            },
            error: function (xhr) {
                 Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data.',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });

}

let _id_user = null;
  function avatarSubmission(){

     // Simpan input file tersembunyi
  const fileInput = $('<input type="file" accept="image/*" style="display:none;">');
  $('body').append(fileInput);

  // Saat tombol 'Change Avatar' diklik
  $('#btn-change-avatar').on('click', function (e) {
    e.preventDefault();
    fileInput.click();

    _id_user = $('#admin-settings').find('#id-user').val();

  });

  // Saat file dipilih
  fileInput.on('change', function () {
    const file = this.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('id', _id_user);
    formData.append('avatar', file);
    formData.append('action', 'upload');

    $.ajax({
      url: URL_MAIN_PORTAL + 'portal/settings/change-avatar',
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (res) {
        location.reload(); // Refresh jika sukses
        //alert(res);
        //console.log(JSON.stringify(res));
      },
      error: function () {
        alert('Gagal upload avatar!');
      }
    });
  });

  // Saat tombol 'Delete Avatar' diklik
  $('#btn-delete-avatar').on('click', function (e) {
    e.preventDefault();

    _id_user = $('#admin-settings').find('#id-user').val();

    let dataForm =  { action: 'delete', id :  _id_user};

    $.ajax({
      url: URL_MAIN_PORTAL + 'portal/settings/change-avatar',
      method: 'POST',
      data: dataForm,
      success: function (res) {
        location.reload(); // Refresh jika sukses
      },
      error: function () {
        alert('Gagal delete avatar!');
      }
    });
  });

  }

  function formSubmission(){


    $('#btn-submit').on('click', function (e) {
        e.preventDefault();

        // Ambil data manual
        let formData = {
            id: $('#id-user').eq(0).val(),
            username: $('input[type="text"]').eq(0).val(),
            password: $('input[type="password"]').val(),
            email: $('input[type="text"]').eq(1).val(),
            bio: $('textarea').eq(0).val(),
            country: $('#country').val(),
            region: $('#region').val(),
            city: $('#city').val(),
            address: $('textarea').eq(1).val(),
            public_profile: $('.form-check-input').is(':checked') ? 1 : 0
        };

        $.ajax({
            url: URL_MAIN_PORTAL + 'portal/settings/update',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: response.message || 'Data berhasil disimpan!',
                    timer: 2000,
                    showConfirmButton: false
                });

                  setTimeout(function(){
                    window.location.reload();
                  },2500);
            },
            error: function (xhr) {
                 Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data.',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });


    });

  }

  function callRegionsData(){

    let URL_GEO_FETCH = 'https://apps.fgroupindonesia.com/geotraverse/region?country=ID';
    //let URL_GEO_FETCH = 'http://geotraverse.com/region?country=ID';
    

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

          if(_region != ''){
              $('#region').val(_region);
              $('#region').trigger('change');
          }

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

          if(_city != ''){
              $('#city').val(_city);
          }

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