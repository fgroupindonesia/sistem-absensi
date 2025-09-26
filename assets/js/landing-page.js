var WALink = "https://api.whatsapp.com/send?phone=6285795569337&text=Hello%20*Admin%20Sistem%20Absensi*!%0ASaya%20ingin%20langganan%20informasi%20promo%20dan%20potongan%20harga%20di%20tiap%20moment%20yang%20disediakan.%20Tolong%20add%20nomor%20saya%20ini%20[NOMOR].%0ATerima%20kasih%20ya!%20%20%F0%9F%98%80";
var WALink2 = "https://api.whatsapp.com/send?phone=6285795569337&text=Hello%20*Admin%20Sistem%20Absensi*!%20%0ASaya%20ingin%20menanyakan%20sesuatu%20tentang%20*[PERIHAL]*%20%2C%20begini...%0A*[PESAN]*%20%0Adan%20tolong%20reply%20saya%20di%20whatsapp%20ini%20atau%20email%20*[EMAIL]*%20.%0A%0ATerima%20kasih%2C%20%0A*[NAMA]*%20.%F0%9F%98%89";

$(document).ready(function() {
    // jQuery code to manipulate DOM
    $('#promosi-wa-form').on('submit', function(e) {
        e.preventDefault();

        let nonya = $('#daftarkan-wa').val();

        let linkAnyar = WALink.replace('[NOMOR]', nonya);

      window.location = linkAnyar;
    });

    $('#pesan-wa-form').on('submit', function(e){
        e.preventDefault();

        let nami    = $('#name').val();
        let email   = $('#email').val();
        let subject = $('#subject').val();
        let pesan   = $('#message').val();

        let linkAnyarDeui = WALink2.replace('[NAMA]', nami);
        linkAnyarDeui = linkAnyarDeui.replace('[EMAIL]', email);
        linkAnyarDeui = linkAnyarDeui.replace('[PERIHAL]', subject);
        linkAnyarDeui = linkAnyarDeui.replace('[PESAN]', pesan);

        window.location = linkAnyarDeui;
        //console.log('kirim ke ' + linkAnyarDeui);
    });

});


const now = new Date();
const target_date = new Date(now);

target_date.setDate(now.getDate() + 1);

function timer_tanggal_limit(){

    let monthNames = [
  "Januari", "Februari", "Maret", "April", "Mei", "Juni",
  "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

    let dd = String(target_date.getDate()).padStart(2,'0');
    let mm = target_date.getMonth()
    let yyyy = target_date.getFullYear();

    let namaBulan = monthNames[mm];

    let tgl_terakhir = `${dd}-${namaBulan}-${yyyy}`;
    $('#tanggal-limit').text(tgl_terakhir);

}

function update_timer_limit(){
    let now = new Date();
    let diff = target_date - now;


    if(diff <= 0){
        $('#count-time').text('Habis!');
        clearInterval(timer);

        return;
    }

    let jam = Math.floor(diff/1000/60/60);
    let menit = Math.floor((diff/1000/60)%60);
    let detik = Math.floor((diff/1000)%60);

    $('#jam-sisa').text(jam);
    $('#menit-sisa').text(menit);
    $('#detik-sisa').text(detik);

}

update_timer_limit();
timer_tanggal_limit();
let timer = setInterval(update_timer_limit, 1000);