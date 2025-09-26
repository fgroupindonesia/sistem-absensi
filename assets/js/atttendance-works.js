$(document).ready(function(){

	delete_actions_attendance();

    filter_staff_attendance();

    koreksi_actions_attendance();

    renderByDataTables();

});

let attendanceTable; // global datatable

function renderByDataTables() {
    // inisialisasi DataTable cuma sekali
    attendanceTable = $('#table-attendance').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        destroy: true, // biar bisa re-init kalo reload data
        columnDefs: [
            { orderable: false, targets: 0 } // kolom checkbox no sort
        ]
    });
}


  function koreksi_actions_attendance() {
    $(document).on('click', '.btn-koreksi-attendance', function(e){
        e.preventDefault();

        let token = $('body').attr('data-token');
        let ids = [];

        // ambil semua checkbox yang dicentang
        $('.attendance-selected:checked').each(function(){
            ids.push($(this).val());
        });

        if(ids.length === 0){
            Swal.fire({
                icon: 'warning',
                title: 'Oops!',
                text: 'Silakan pilih minimal 1 data untuk dikoreksi.'
            });
            return;
        }

        Swal.fire({
            title: 'Pilih status koreksi',
            input: 'select',
            inputOptions: {
                'hadir': 'Hadir',
                'pulang': 'Pulang',
                'lembur': 'Lembur',
                'izin sakit': 'Izin Sakit',
                'izin acara': 'Izin Acara',
                'tugas': 'Tugas'
            },
            inputPlaceholder: 'Pilih status',
            showCancelButton: true,
            inputValidator: (value) => {
                if(!value) return 'Harap pilih status!'
            }
        }).then((result) => {
            if(result.isConfirmed){
                let status = result.value;

                let URL_UPDATE_ATTENDANCE = URL_MAIN_PORTAL + 'attendance/update';

                $.ajax({
                    url: URL_UPDATE_ATTENDANCE,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: ids,       // kirim array ID
                        status: status,
                        public_token: token
                    },
                    success: function(response){
                        if(response.status === 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message
                            });

                            // update badge di tabel & mobile card
                            ids.forEach(function(id){
                                // tabel desktop
                                let badgeTd = $('input.attendance-selected[value="'+id+'"]').closest('tr').find('td:nth-child(6) span.badge');
                                badgeTd.removeClass().addClass('badge ' + 
                                    (status=='hadir'?'bg-success': 
                                    status=='pulang'?'bg-secondary': 
                                    status=='lembur'?'bg-primary': 
                                    status=='izin sakit'?'bg-warning': 
                                    status=='izin acara'?'bg-info':'bg-dark')
                                ).text(
                                    status=='hadir'?'hadir':
                                    status=='pulang'?'pulang':
                                    status=='lembur'?'lembur':
                                    status=='izin sakit'?'izin sakit':
                                    status=='izin acara'?'izin acara':'tugas'
                                );

                                // mobile card
                                let cardBadge = $('#card-attendance-container .attendance-card[data-id="'+id+'"] span.badge');
                                cardBadge.removeClass().addClass(
                                    (status=='hadir'?'bg-success': 
                                    status=='pulang'?'bg-secondary': 
                                    status=='lembur'?'bg-primary': 
                                    status=='izin sakit'?'bg-warning': 
                                    status=='izin acara'?'bg-info':'bg-dark')
                                ).text(
                                    status=='hadir'?'hadir':
                                    status=='pulang'?'pulang':
                                    status=='lembur'?'lembur':
                                    status=='izin sakit'?'izin sakit':
                                    status=='izin acara'?'izin acara':'tugas'
                                );
                            });

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(err){
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan!',
                            text: 'Terjadi kesalahan. Silakan coba lagi.'
                        });
                    }
                });

            }
        });

    });
}


function formatDate(dateStr) {
    let d = new Date(dateStr);
    if (isNaN(d)) return '-';
    let day   = ('0' + d.getDate()).slice(-2);
    let month = ('0' + (d.getMonth() + 1)).slice(-2);
    let year  = d.getFullYear();
    let hours = ('0' + d.getHours()).slice(-2);
    let mins  = ('0' + d.getMinutes()).slice(-2);
    return `${day}/${month}/${year} ${hours}:${mins}`;
}

function filter_staff_attendance() {
    $(document).on('change', '#filter-staff-attendance', function () {
        let staffId = $(this).val();
        let token = $('body').attr('data-token');

        $.ajax({
            url: URL_MAIN_PORTAL + 'attendance/all',
            type: 'POST',
            dataType: 'json',
            data: {
                staff_id: staffId,
                public_token: token
            },
            success: function (res) {
                if (res.status === 'success') {
                    let data = res.data;
                    
                    // ====== RENDER TABLE DESKTOP ======
                    attendanceTable.clear(); // kosongin dulu
                    $.each(data, function (i, att) {
                        let badgeClass =
                            att.status === 'hadir' ? 'bg-success' :
                            att.status === 'izin acara' ? 'bg-info' :
                            att.status === 'izin sakit' ? 'bg-warning' : 'bg-secondary';

                        let signature = att.signature_pic
                            ? `<img src="${URL_MAIN_PORTAL}uploads/signatures/${att.signature_pic}" width="80">`
                            : `<span class="text-muted">-</span>`;

                        attendanceTable.row.add([
                            `<input type="checkbox" value="${att.id}" class="form-check attendance-selected">`,
                            (i + 1),
                            att.staff_name,
                            att.checkpoint_name,
                            signature,
                            `<span class="badge ${badgeClass}">${att.status}</span>`,
                            formatDate(att.date_created)
                        ]);
                    });
                    attendanceTable.draw();

                    // ====== RENDER CARD MOBILE ======
                    let cardHtml = '';
                    $.each(data, function (i, att) {
                        let badgeClass =
                            att.status === 'hadir' ? 'bg-success' :
                            att.status === 'izin acara' ? 'bg-info' :
                            att.status === 'izin sakit' ? 'bg-warning' : 'bg-secondary';

                        let signature = att.signature_pic
                            ? `<div class="mt-2"><img src="${URL_MAIN_PORTAL}uploads/signatures/${att.signature_pic}" 
                                   class="img-fluid rounded border"></div>`
                            : '';

                        cardHtml += `
                          <div class="col-12 mb-3 attendance-card" data-id="${att.id}">
                            <div class="card">
                              <div class="card-body">
                                <input type="checkbox" value="${att.id}" class="form-check attendance-selected">
                                <h3 class="card-title mb-2">${att.staff_name}</h3>
                                <p class="mb-1"><strong>Checkpoint:</strong> ${att.checkpoint_name}</p>
                                <p class="mb-1">
                                  <strong>Status:</strong> 
                                  <span class="badge ${badgeClass}">${att.status}</span>
                                </p>
                                <p class="mb-1"><strong>Tanggal:</strong> ${formatDate(att.date_created)}</p>
                                ${signature}
                              </div>
                            </div>
                          </div>`;
                    });
                    $('#card-attendance-container').html(cardHtml);
                } else {
                   
                    attendanceTable.clear().draw();
                    $('#card-attendance-container').empty();

                }
            },
            error: function (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan!',
                    text: 'Tidak bisa mengambil data.'
                });
            }
        });
    });
}


function delete_actions_attendance(){

    $(document).on('click', '.btn-delete-attendance', function(e){
        e.preventDefault();

        let token = $('body').attr('data-token');
        let ids = [];

        // ambil semua checkbox yang dicentang
        $('.attendance-selected:checked').each(function(){
            ids.push($(this).val());
        });

        if(ids.length === 0){
            Swal.fire({
                icon: 'warning',
                title: 'Oops!',
                text: 'Silakan pilih minimal 1 data untuk dihapus.'
            });
            return;
        }

        // Konfirmasi menggunakan SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed){

            	let URL_DELETE_ATTENDANCE = URL_MAIN_PORTAL + 'attendance/delete';

                $.ajax({
                    url: URL_DELETE_ATTENDANCE,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        ids: ids,
                        public_token: token
                    },
                    success: function(response){
                        if(response.status === 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: response.message
                            });

                            // hapus baris tabel yang dicentang
                            $('.attendance-selected:checked').closest('tr').remove();

                            // hapus card mobile yang sesuai
                            ids.forEach(function(id){
                                $('#card-attendance-container .attendance-card[data-id="'+id+'"]').remove();
                            });

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal menghapus data.'
                            });
                        }
                    },
                    error: function(err){
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan!',
                            text: 'Terjadi kesalahan. Silakan coba lagi.'
                        });
                    }
                });

            }
        });

    });

}

