
const SUPERADMIN_LOGIN_URL = URL_MAIN_PORTAL + "portal/superadmin/login";

function resetData() {
    let isRemembered = $('#remember-me').is(':checked');

    if (!isRemembered) {
        // Kosongkan semua input bertipe text dan password
        $('#login-form').find('input[type="text"], input[type="password"]').val('');

        // Hapus data dari localStorage
        localStorage.removeItem('saved_username');
        localStorage.removeItem('saved_password');
    }
}


function checkAutoSubmit() {
    let masuk = localStorage.getItem('isLoggedIn');

    if (masuk == 'yes') {
        $('#username').val(localStorage.getItem('username'));
        $('#pass').val(localStorage.getItem('password'));

        // Delay sebentar biar user lihat dulu
        setTimeout(function () {
            // FadeOut body form
            $('.card-body').fadeOut(800, function () {
                // Setelah form ilang, munculin loader
                $('#autoLoginLoader').fadeIn(600);

                // Lalu submit form setelah loader tampil
                setTimeout(function () {
                    $('#login-form').trigger('submit');
                }, 2000);
            });
        }, 1000);
    }
}


function prosesLogin(){

     var formData = $('#login-form').serialize();

        // Gunakan prop() bukan ischecked()
        let ingat = $('#remember-me').prop('checked');

        let username = $('#username').val();
        let password = $('#pass').val();

        if (ingat) {
            // Simpan ke localStorage
            localStorage.setItem('username', username);
            localStorage.setItem('password', password);
            localStorage.setItem('remember', 'true');
        } else {
            // Hapus jika tidak dicentang
            localStorage.removeItem('username');
            localStorage.removeItem('password');
            localStorage.setItem('remember', 'false');
        }

        // Lanjutkan login (misalnya AJAX call atau redirect)
        let url = $('#login-form').attr('action');

        if(username == 'superadmin'){
          url = SUPERADMIN_LOGIN_URL;
        }
        

        $.post(url, formData, function(response) {
            let jawab = JSON.parse(response);
            //alert(jawab);
            if (jawab.status == 'success') {
                window.location.href = URL_MAIN_PORTAL + 'portal/dashboard';
                localStorage.setItem('isLoggedIn', 'yes');
            } else {
                 window.location.href = URL_MAIN_PORTAL + 'portal/admin?status=error';
                 localStorage.removeItem('isLoggedIn');
            }
        });

}

$(document).ready(function() {

     $('#remember-me').on('change', function(){

        resetData();

     });

     // chek orang ini prnah login?
     checkAutoSubmit();

    // Cek apakah ada data di localStorage saat halaman dimuat
    if (localStorage.getItem('remember') === 'true') {
        $('#username').val(localStorage.getItem('username'));
        $('#pass').val(localStorage.getItem('password'));
        $('#remember-me').prop('checked', true);
    }

    $('#login-form').on('submit', function(e) {
        e.preventDefault();
        prosesLogin();
        
    });

});

