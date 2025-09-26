$(document).ready(function(){


$('.btn-cancel-checkout').on('click', function(){

	window.history.back();

});

$('.btn-confirmed-checkout').on('click', function(){

	orderUpgradeAkun();

});

// beri aksi untuk upload
uploadBukti();

});

function uploadBukti(){

	$('#btn-upload-bukti-pembayaran').on('click', function () {
    // trigger file picker
    	$('#file-bukti').click();
	});


	$('#file-bukti').on('change', function () {
    let fileData = this.files[0];

    if (!fileData) {
        Swal.fire("Gagal", "Silakan pilih file bukti pembayaran.", "error");
        return;
    }

    // validasi tipe file
    let allowed = ["image/jpeg", "image/png", "application/pdf"];
    if (!allowed.includes(fileData.type)) {
        Swal.fire("Format tidak valid", "Hanya boleh JPG, PNG, atau PDF.", "warning");
        return;
    }

    let nomer_orderan = $('#btn-upload-bukti-pembayaran').attr('data-order-id');
    let token = $('body').attr('data-token');

    let formData = new FormData();
    formData.append("bukti_pembayaran", fileData);
    formData.append("order_id", nomer_orderan);
    formData.append("public_token", token);

    let urlna = URL_MAIN_PORTAL + "purchase-membership/upload-payment";

    $.ajax({
        url: urlna,
        type: "POST",
        data: formData,
        dataType : 'json',
        processData: false, // jangan diproses sebagai string
        contentType: false, // biar otomatis multipart/form-data
        beforeSend: function () {
            Swal.fire({
                title: "Mengupload...",
                text: "Harap tunggu sebentar",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function (res) {
            
              if (res.status === "success") {
			       Swal.fire(
					    "Berhasil terupload!",
					    res.message,
					    "success"
					).then((result) => {
					    if (result.isConfirmed) {
					        window.location.href = URL_MAIN_PORTAL + "portal/dashboard"; 
					    }
					});



			    } else {
			        Swal.fire("Gagal", res.message, "error");
			    }

        },
        error: function (xhr, status, error) {
			    console.error("AJAX Error:", status, error);   // error dari sisi JS/AJAX
			    console.error("Response Text:", xhr.responseText); // respon raw dari server
			    Swal.fire("Gagal", "Terjadi kesalahan saat mengupload. Coba lagi.", "error");
			}
    	});
	});


}

function konfirmasiUploadBukti(nomerOrderan){

		$('#btn-upload-bukti-pembayaran').attr('data-order-id', nomerOrderan);


	   Swal.fire({
            icon: 'success',
            title: 'Pemesanan Berhasil!',
            text: 'Harap lakukan konfirmasi dengan upload bukti pembayaran.',
            confirmButtonText: 'OK'
        }).then(() => {
            // tampilkan div timer setelah swal ditutup
            $("#payment-timer").show();
            $('.btn-cancel-checkout').hide();
            $('.btn-confirmed-checkout').hide();

            // set waktu 3 jam (dalam detik)
            let countdown = 3 * 60 * 60; 
            let timerElement = document.getElementById("timer-countdown");

            function updateTimer() {
                let hours = Math.floor(countdown / 3600);
                let minutes = Math.floor((countdown % 3600) / 60);
                let seconds = countdown % 60;

                timerElement.innerHTML =
                    `${hours.toString().padStart(2, '0')}:` +
                    `${minutes.toString().padStart(2, '0')}:` +
                    `${seconds.toString().padStart(2, '0')}`;

                if (countdown <= 0) {
                    clearInterval(countdownTimer);
                    $("#payment-timer").removeClass("alert-warning")
                        .addClass("alert-danger")
                        .html("<strong>Waktu habis!</strong> Pesanan otomatis dibatalkan.");
                } else {
                    countdown--;
                }
            }

            // jalankan pertama kali
            updateTimer();
            // lalu update setiap 1 detik
            let countdownTimer = setInterval(updateTimer, 100);
        });


}

function orderUpgradeAkun(){

	let URL_ORDER_UPGRADE_ACCOUNT = URL_MAIN_PORTAL + 'purchase-membership/order/checkout';

	let token = $('body').attr('data-token');
	let typena = $('#account-ordered').val();

	$.ajax({
    url: URL_ORDER_UPGRADE_ACCOUNT, 
    type: 'POST',
    data: { public_token : token, account: typena },
    dataType: 'json',
    success: function(response) {
        if (response.status === "success") {
            konfirmasiUploadBukti(response.order_id);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: response.message || 'Order gagal disimpan.',
                confirmButtonText: 'OK'
            });
        }
    },
    error: function(xhr, status, error) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan saat memproses pemesanan.',
            confirmButtonText: 'OK'
        });
    }
});




}