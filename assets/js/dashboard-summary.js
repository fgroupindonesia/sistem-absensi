

const URL_DASHBOARD_SUMMARY = URL_MAIN_PORTAL + 'summary/dashboard/attendance';
const URL_DASHBOARD_LOWEST_TOP = URL_MAIN_PORTAL+ 'summary/dashboard/lowest-top';
const URL_DASHBOARD_AVERAGE = URL_MAIN_PORTAL +'summary/dashboard/average';
const URL_DASHBOARD_STAFF_QUOTA = URL_MAIN_PORTAL + 'summary/dashboard/staff-quota';

$(document).ready(function() {
    
    let usertype = $('body').attr('data-type');

    if(usertype == null){
            // this is as company user
        requestDataTables();
        requestDataSummaryStaffCounts();
        requestDataSummaryStaffAverage();
        requestDataQuotaLimit();

        linkUpgrade();
    }
    
   	
});

function linkUpgrade() {
    $('#link-upgrade-account').on('click', function(e) {
        e.preventDefault();

        let mAccount = $('#membership-account').text().toLowerCase().trim();
        let title = 'Pilih Opsi Upgrade';
        let buttons = {};
        
        // Tentukan tombol yang akan ditampilkan berdasarkan membership saat ini
        switch (mAccount) {
            case 'gratis':
                buttons = {
                    showCancelButton: true,
                    showDenyButton: true,
                    showConfirmButton: true,
                    confirmButtonText: 'Sederhana',
                    denyButtonText: 'Developer',
                    cancelButtonText: 'Ultimate'
                };
                break;
            case 'sederhana':
                buttons = {
                    showCancelButton: true,
                    showDenyButton: true,
                    showConfirmButton: false, // Tidak perlu lagi tombol "Sederhana"
                    denyButtonText: 'Developer',
                    cancelButtonText: 'Ultimate'
                };
                break;
            case 'developer':
                buttons = {
                    showCancelButton: true,
                    showDenyButton: false, // Tombol "Developer" tidak perlu lagi
                    showConfirmButton: false, // Tombol "Sederhana" tidak perlu lagi
                    cancelButtonText: 'Ultimate'
                };
                break;
            case 'ultimate':
                Swal.fire({
                    icon: 'info',
                    title: 'Anda Sudah Berada di Level Tertinggi',
                    text: 'Tidak ada opsi upgrade lagi.',
                    confirmButtonText: 'Tutup'
                });
                return; // Hentikan eksekusi jika sudah ultimate
        }

        // Tampilkan SweetAlert dengan konfigurasi yang sudah disesuaikan
        Swal.fire({
            title: title,
            ...buttons, // Menggabungkan properti tombol yang sudah dibuat
            showCloseButton: true,
            allowOutsideClick: true,
            allowEscapeKey: true,
            reverseButtons: true
        }).then((result) => {
            let targetURL = '';

            // Tentukan URL tujuan berdasarkan tombol yang diklik
            if (result.isConfirmed) {
                targetURL = 'sederhana';
            } else if (result.isDenied) {
                targetURL = 'developer';
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                targetURL = 'ultimate';
            }
            
            // Redirect jika URL tidak kosong
            if (targetURL) {
                window.location.href = URL_MAIN_PORTAL + 'portal/upgrade-akun?akun=' + targetURL;
            }
        });
    });
}

function requestDataQuotaLimit(){

    let ptoken = $('body').attr('data-token');

    $.ajax({
    url: URL_DASHBOARD_STAFF_QUOTA,
    method: 'POST',
    data: {
        public_token: ptoken
    },
    dataType: 'json',
    success: function(response) {
        if (response.status) {
            const data = response.data;

            // Tampilkan quota
            $('#quota-text').html(`Quota Data Staff Terpakai <strong>${data.quota_used}</strong> dari ${data.quota_limit} total`);

            // Kosongkan progress bar dan label
            $('#progress-bar-container').html('');
            $('#progress-labels').html('');

            const colors = ['bg-primary', 'bg-info', 'bg-success', 'bg-warning', 'bg-danger'];

            data.divisions.forEach(function(div, index) {
                let color = colors[index % colors.length];

                $('#progress-bar-container').append(`
                    <div class="progress-bar ${color}" role="progressbar" style="width: ${div.percentage}%;" aria-label="${div.division_name}" title="${div.division_name} (${div.staff_count})"></div>
                `);

                $('#progress-labels').append(`
                    <div class="col-auto d-flex align-items-center px-2">
                        <span class="legend me-2 ${color}"></span>
                        <span>${div.division_name}</span>
                        <span class="ms-2 text-muted">${div.staff_count} Staff</span>
                    </div>
                `);
            });
        } else {
            alert('Gagal memuat data: ' + response.message);
        }
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
        alert('Terjadi kesalahan saat mengambil data.');
    }
});


}

function requestDataSummaryStaffAverage(){

	var publicToken =  $('body').attr('data-token');

    // Lakukan POST request ke endpoint
    $.ajax({
        url: URL_DASHBOARD_AVERAGE,
        type: "POST",
        data: {
            public_token: publicToken
        },
        dataType: "json",
        success: function(response) {
            // Cek apakah status sukses
            if (response.status === "success") {
                // Update nilai di span
                $("#dashboard-persentase-kehadiran").text(response.data.attendance_percentage + '%');

                $("#dashboard-persentase-kehadiran-progress").attr('aria-valuenow', response.data.attendance_percentage);
                $("#dashboard-persentase-kehadiran-progress").css('width', response.data.attendance_percentage+'%');

                $("#dashboard-total-staff-aktif").text(response.data.active_staff_count + ' staff');
                $("#dashboard-total-staff-tidak-terdata").text(response.data.non_recorded_percentage + '%');
            } 
        },
        error: function(xhr, status, error) {
            // Tangani error AJAX
            //alert("Terjadi kesalahan saat menghubungi server: " + error);
            $("#dashboard-persentase-kehadiran").text("-");
            $("#dashboard-total-staff-aktif").text("-");
            $("#dashboard-total-staff-tidak-terdata").text("-");
        }
    });

}

function requestDataSummaryStaffCounts(){

     let publicToken = $('body').attr('data-token');

    $.ajax({
        url: URL_DASHBOARD_LOWEST_TOP,
        type: 'POST',
        dataType: 'json',
        data: { public_token: publicToken },
        success: function(response) {
            if (response.status === 'success' && response.data) {
                // Tampilkan data dalam elemen HTML, misalnya:
                $('#total_early_staff').text(response.data.total_early);
                $('#total_ontime_staff').text(response.data.total_ontime);
                $('#total_late_staff').text(response.data.total_late);
            } else {
                // Tampilkan pesan jika tidak ada data
                $('#total_early_staff').text('0');
                $('#total_ontime_staff').text('0');
                $('#total_late_staff').text('0');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
            alert('Gagal memuat data. Silakan coba lagi.');
        }
    });


}

function isMobile() {
    return window.innerWidth <= 768; // bisa juga pakai userAgent kalau mau lebih strict
}

function requestDataTables() {
    let publicToken = $('body').attr('data-token');
    let urlIDJSON = URL_MAIN_PORTAL + "assets/js/id.json";

    // Jika desktop → pakai DataTables
    if (!isMobile()) {
        $('#view-table').show();
        $('#view-card').hide();

       

        if($('#table-summary').length) {

             if ( $.fn.DataTable.isDataTable('#table-summary') ) {
            $('#table-summary').DataTable().clear().destroy();
        }


        $('#table-summary').DataTable({
            processing: true,
            serverSide: false,
            destroy: true, // supaya bisa re-init kalau reload
            ajax: {
                url: URL_DASHBOARD_SUMMARY,
                type: 'POST',
                dataType: 'json',
                data: function(d) {
                    d.public_token = publicToken;
                    return d;
                },
                dataSrc: function(json) {
                    if (json.status === 'success' && json.data) {
                        return json.data;
                    }
                    return [];
                }
            },
            columns: [
                { data: 'name' },
                { data: 'total_hadir' },
                { data: 'total_tidak_hadir' },
                {
                    data: 'persentase_hadir',
                    render: function(data) {
                        return data ? parseFloat(data).toFixed(2) + '%' : '-';
                    }
                }
            ],
            language: {
                emptyTable: 'No data',
                url: urlIDJSON
            }
        });

        }

    } else {
        // Jika mobile → tampilkan card
        $('#view-table').hide();
        $('#view-card').show();

        $.ajax({
            url: URL_DASHBOARD_SUMMARY,
            type: 'POST',
            dataType: 'json',
            data: { public_token: publicToken },
            success: function(json) {
                let container = $('#card-container');
                container.empty();

                if (json.status === 'success' && json.data) {
                    json.data.forEach(item => {
                        let card = `
                          <div class="border rounded-lg shadow p-3 mb-2 bg-white">
                            <h5 class="mb-1">${item.name}</h5>
                            <p class="mb-0">✅ Attendance: <b>${item.total_hadir}</b></p>
                            <p class="mb-0">❌ Absence: <b>${item.total_tidak_hadir}</b></p>
                            <p class="mb-0">📊 Percentage: <b>${item.persentase_hadir ? parseFloat(item.persentase_hadir).toFixed(2) + '%' : '-'}</b></p>
                          </div>`;
                        container.append(card);
                    });
                } else {
                    container.html('<p class="text-muted">No data available</p>');
                }
            },
            error: function() {
                alert('Gagal memuat data. Silakan coba lagi.');
            }
        });
    }
}

$(window).resize(function(){
   // requestDataTables();
});