const URL_UPDATE_ORDER_STATUS = URL_MAIN_PORTAL + 'portal/management-order/update-status';

$(document).ready(function(){

	$('#table-orders').DataTable();

    previewClick();

    $(document).on('click', '.order-update-status', function(e){
        e.preventDefault();

        let orderid  = $(this).attr('data-id');
        let status   = $(this).attr('data-status');

        if(!orderid || !status) {
            Swal.fire({
                icon: 'error',
                title: 'Data tidak valid',
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        $.ajax({
            url: URL_UPDATE_ORDER_STATUS,
            type: 'POST',
            dataType: 'json',
            data: {
                id: orderid,
                status: status
            },
            success: function(res) {
                if(res.status == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: res.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => location.reload());
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: res.message || 'Update status gagal',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: error,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });

    });

});


function previewClick() {
    
     $(document).on("click", ".preview-bukti-pembayaran", function(e){
        e.preventDefault();

        let fileUrl = $(this).attr("href");
        let ext = fileUrl.split('.').pop().toLowerCase();
        let content = "";

        if(["jpg","jpeg","png","gif","webp"].includes(ext)){
          // Preview gambar
          content = `<img src="${fileUrl}" class="img-fluid rounded shadow" style="max-height:80vh;object-fit:contain;" alt="Bukti Pembayaran">`;
        } else if(ext === "pdf"){
          // Preview PDF pakai iframe
          content = `<iframe src="${fileUrl}" style="width:100%;height:80vh;border:none;"></iframe>`;
        } else {
          // File lain (zip/docx dll) => kasih link download aja
          content = `<p>File tidak bisa dipreview. <a href="${fileUrl}" target="_blank">Download di sini</a></p>`;
        }

        $("#previewBody").html(content);
        $("#previewBuktiPembayaranModal").modal("show");
  });

}