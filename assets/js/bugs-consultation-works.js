
  $(document).ready(function () {
    submit_bugsreport();
    submit_konsultasi();
    pickRiwayat();
  });

  function pickRiwayat(){

    $('#display-riwayat-user').on('click', function(){

      Swal.fire({
  title: 'Pilih Riwayat',
  text: 'Silakan pilih salah satu opsi:',
  icon: 'question',
  showCancelButton: true,
  showCloseButton: true, // tombol X di pojok kanan atas
  confirmButtonText: 'Bugs Report',
  cancelButtonText: 'Request Konsultasi'
}).then((result) => {
  if (result.isConfirmed) {
    // Jika klik Opsi A
    window.location.href = 'history/bugs-report';
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    // Jika klik Opsi B
    window.location.href = 'history/consultation';
  }
});



    });


  }

  function submit_bugsreport(){

    $('#submit-bug-report').on('click', function (e) {
      e.preventDefault();

      var form = $('#bugs_report_form')[0];
      var formData = new FormData(form);

      $.ajax({
        url: 'bugs/report', // Ganti dengan route controller kamu
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
          $('#submit-bug-report').prop('disabled', true).text('Mengirim...');
        },
        success: function (response) {
          $('#submit-bug-report').prop('disabled', false).text('Laporkan Bugs ini!');

         if (response.status === 'success') {
          Swal.fire({
            title: 'Berhasil',
            text: response.message,
            icon: 'success',
            timer: 2000, // alert tertutup otomatis setelah 2 detik
            showConfirmButton: false
          });

          $('#modal-bugs').modal('hide');
          $('#bugs_report_form')[0].reset();

        } else {
          Swal.fire({
            title: 'Gagal',
            text: response.message,
            icon: 'error',
            timer: 2000,
            showConfirmButton: false
          });
        }

        },
        error: function () {
          $('#submit-bug-report').prop('disabled', false).text('Laporkan Bugs ini!');
          Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
        }
      });
    });

  }

  function submit_konsultasi(){


    $('#submit-pengajuan-konsultasi').on('click', function(e) {
      e.preventDefault();

      const formData = $('#form-pengajuan-konsultasi').serialize();

      $.ajax({
        type: 'POST',
        url: 'consultation/request', // ganti sesuai route di servermu
        data: formData,
        success: function(response) {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Pengajuan konsultasi telah dikirim.',
            timer: 2000,
            showConfirmButton: false
          });
          $('#modal-konsultasi').modal('hide');
        },
        error: function(xhr) {
          Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            timer: 2000,
            showConfirmButton: false,
            text: 'Terjadi kesalahan saat mengirim data.',
          });
        }
      });
    });


  }