const URL_FETCH_ALL_STAFF = URL_MAIN_PORTAL + "staff/all";

$(document).ready(function () {
    
    refreshTableStaff();


     // filter manual untuk card versi mobile
    $('#search-card').on('keyup', function () {
        var value = $(this).val().toLowerCase();
        $('#card-staff-container .staff-card').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    email_notes_click_events();
    
});

function email_notes_click_events(){

    $(document).on('click','.staff-email, .staff-notes', function(){

        let data_email = $(this).attr('data-email');
        let data_notes = $(this).attr('data-notes');

        let perihal = 'notes';
        let data = data_notes;

        if ($(this).hasClass('staff-email')) {
            perihal = 'email';
            data = data_email;
        }

        Swal.fire({
          icon: 'info',
          title: 'Data ' + perihal,
          text: data,
          showConfirmButton: true,   // tombol OK tampil
          allowOutsideClick: false,  // biar ga bisa ditutup klik di luar
          allowEscapeKey: false      // biar ga bisa ditutup dengan ESC
        });

    });

}

var tableStaff; // global

function refreshTableStaff() {
    if ($.fn.DataTable.isDataTable('#table-staff')) {
        if(tableStaff!=null){
            tableStaff.ajax.reload(null, false);
            return;    
        }
        
    }

    let token = $('body').attr('data-token');
    let datana = {public_token : token};

    tableStaff = $('#table-staff').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: URL_FETCH_ALL_STAFF,
            type: 'POST',
            data: datana,
            dataSrc: function(json) {
                    if (json.status && json.status === "failed") {
                        // tampilkan alert atau pesan ke user
                        //alert(json.message);

                        // return data kosong agar DataTables tidak error
                        return [];
                    }
                    return json.data; // pastikan server kalo sukses return {data:[...]}
                }
        },
        columns: [
            { 
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return '<input type="checkbox" class="form-check-input me-2 staff-id" value="' + row.id + '" data-name="' + row.name + '">';
                },
                className: 'text-center'
            },
            { 
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'name' },
            { data: 'unit_division' },
            { data: 'whatsapp' },
            { 
                data: 'email',
                render: function(data) {
                    if(data !== null){
                        return '<i class="staff-email fa-solid fa-envelope" data-email="' + data + '"></i>';
                    }else{
                        return '-';
                    }
                    
                },
                className: 'text-center'
            },
            { 
                data: 'status',
                render: function(data) {
                    if(data === 'active') {
                        return '<span class="badge bg-success">' + data + '</span>';
                    } else {
                        return '<span class="badge bg-secondary">' + data + '</span>';
                    }
                },
                className: 'text-center'
            },
            { 

                data: 'device_tag',
                render: function(data) {
                    if(data === null || data === '') {
                        return '-';
                    } else {
                        return '<i class="fa-solid fa-mobile-screen" style="color:green;"></i> installed';
                    }
                }
             },
            { 

                data: 'notes',
                render: function(data) {
                    if(data === null || data === '') {
                        return '-';
                    } else {
                        return '<i class="staff-notes fa-regular fa-note-sticky" data-notes="'+ data +'"></i>';
                    }
                }
             },
            { 
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-end',
                render: function(data, type, row) {
                    // buat dropdown action seperti HTML template
                    let action = `
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" data-bs-toggle="dropdown">Actions</button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a data-bs-toggle="modal" data-bs-target="#modal-staff" data-id="${row.id}" data-token="${row.public_token}" class="dropdown-item link-edit-staff" href="#">Edit</a>
                                ${row.status !== 'active' ? `<a data-id="${row.id}" data-token="${row.public_token}" data-type="activate" class="dropdown-item link-activate-staff" href="#">Activate</a>` : ''}
                                ${row.status === 'active' ? `<a data-id="${row.id}" data-token="${row.public_token}" class="dropdown-item link-activate-staff" href="#">Turn Off</a>` : ''}
                                ${row.device_tag ? `<a data-id="${row.id}" data-token="${row.public_token}" class="dropdown-item link-reset-device-staff" href="#">Reset</a>` : ''}
                                <a data-id="${row.id}" data-token="${row.public_token}" class="dropdown-item link-delete-staff" href="#">Delete</a>
                            </div>
                        </div>`;
                    return action;
                }
            }
        ],
        order: [[1, 'asc']]
    });
}
