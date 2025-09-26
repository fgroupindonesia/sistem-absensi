
var indexPage = 0;
const TUNGGU = 0;
const SHUTDOWN = 4;
const QRTERBACA = 5;
const MASUKKAN_KODE = 6;
const ISIDULU_KODE = 7;
const OK = 8;
const KODE_SALAH = 9;
const SILAHKAN = 10;
const KODE_SALAH_TOTAL = 11;
const KODE_BENAR = 12;

const SIAP = 1;
const BERHASIL = 2;
const GAGAL = 3;

var NEXT_PAGE = "N";
var PREV_PAGE = "P";

const limitPage = 8;
let jumlah_percobaan = 0;

var URL_ADD_ABSENSI 	= "/device/add-absensi";
var URL_CHECK_VERIFIKASI 	= "/device/check-code";
var URL_WA_ADMIN 			= "https://api.whatsapp.com/send?phone=6285795569337&text=";

var data_username 		= "username";
var data_phone 				= "phone_numbers";
var data_email 				= "user_email";
var data_kode_aktifasi 				= "kode_aktifasi";

$( document ).ready(function() {

	let status_aktif = isDataLocalAvailable();
  // let status_aktif = false;

   // show animated loading for 3-4 seconds
	// only for the usage of portal UI
	// other than that dont use the movement


	var curURL = window.location.href;
	if(curURL.includes('/device') && status_aktif){
			goToApprovedDevice();
	}else {
		setTimeout(moveOn, 2000);	
	}
		
	// autofocus geser ke sebelah stelah diisi
  $(".kode-aktifasi input").on("input", function () {
	  if ($(this).val().length === this.maxLength) {
	    $(this).next("input").focus();
	  }
	});

  // autofocus ga perlu hapus
	$(".kode-aktifasi input").on("focus", function () {
  	$(this).select();
	}); 

	$('.btn-continue').click(function(){
		playAudio(TUNGGU);

		if(indexPage == 5){

			resetBack();

		} else {

			// show loading
			showPage(NEXT_PAGE);

			setTimeout(function(){
				// show next page
					 showPage(NEXT_PAGE);

					 if(indexPage == 3)
					 playAudio(SILAHKAN);

					 if(indexPage == 5)
					 	playAudio(MASUKKAN_KODE);

					 	
			}, 2000);

		}

	});

	

	$('.home').click(function(){
			resetBack();
	});
   

	$('#periksa-code-form').on('submit', function(e){


		e.preventDefault();

		checkEmptyCode();


	});
   
});

function checkEmptyCode(){

	 let allFilled = true;
	     let kode = [];

      $(".kode-aktifasi input").each(function () {
        let val = $(this).val().trim();
        if (val === "") {
          allFilled = false;
        }

         kode.push(val);

      });

      if (!allFilled) {

        playAudio(ISIDULU_KODE);
        $(".kode-aktifasi input:first").focus();

      } else {
        // semua sudah terisi
        //playAudio(OK);

        let finalCode = kode.join("");
        periksaCode(finalCode, URL_MAIN_PORTAL+ URL_CHECK_VERIFIKASI);
        
      }

}

function periksaCode(dataX, urlna){

	let datana = { code : dataX };

	jumlah_percobaan++;

	 $.ajax({
        url: urlna,
        type: "POST",
        data: datana,
        success: function (response) {
          //alert("Respon dari server: " + response);
          
          let jawaban = JSON.parse(response);

          if(jawaban.status == 'valid'){
          	
          	localStorage.setItem(data_kode_aktifasi, dataX);
          	playAudio(KODE_BENAR);

          	$('.kode-aktifasi input').prop('disabled', true);
          	$('#periksa-code-form button').fadeOut();

          	showSuccess('Device verifikasi berhasil!');

          	setTimeout(function(){
				
          		goToApprovedDevice();	
          	}, 2500,);
          	

          }else {

          	if(jumlah_percobaan<3){
          		playAudio(KODE_SALAH);
          		$('#perintah').text('Input Ulang Kode aktifasi:');
          		$(".kode-aktifasi input").val("");
          		$(".kode-aktifasi input:first").focus();

				showWarning('Kode salah!');

          	}else{
          		playAudio(KODE_SALAH_TOTAL);
          		// langsung exit
          		showSpecificPage(7);

          		setTimeout(function(){
          			clearAllData();
          			$('body').html('');
          		}, 4000);

          	}
          }

        },
        error: function (xhr, status, error) {
			alert("AJAX Error: " + status + error);
			alert("Response Text: "+ xhr.responseText);
			showWarning("Terjadi kesalahan saat mengirim data.");
        }
      });

}

function goToApprovedDevice(){

	let code = localStorage.getItem(data_kode_aktifasi);
	window.location.href = URL_MAIN_PORTAL + "/device?code=" + code;

}

function playAudio(jenis){

let audio = null;

if(jenis == TUNGGU){
	audio = new Audio("assets/audio/tunggu.mp3");
}else if(jenis == BERHASIL){
	audio = new Audio("assets/audio/absensi-berhasil.mp3");
} else if(jenis == GAGAL){
	audio = new Audio("assets/audio/absensi-gagal.mp3");
}else if(jenis == SIAP){
	audio = new Audio("assets/audio/ok-siap.mp3");
}else if(jenis == QRTERBACA){
	audio = new Audio("assets/audio/qrcode-terbaca.mp3");
}else if(jenis == MASUKKAN_KODE){
	audio = new Audio("assets/audio/masukkan-code.mp3");
}else if(jenis == ISIDULU_KODE){
	audio = new Audio("assets/audio/isi-dulu.mp3");
}else if(jenis == OK){
	audio = new Audio("assets/audio/ok.mp3");
}else if(jenis == KODE_SALAH){
	audio = new Audio("assets/audio/code-salah.mp3");
}else if(jenis == SILAHKAN){
	audio = new Audio("assets/audio/silahkan.mp3");
}else if(jenis == KODE_SALAH_TOTAL){
	audio = new Audio("assets/audio/code-salah-total.mp3");
}else if(jenis == KODE_BENAR){
	audio = new Audio("assets/audio/code-benar.mp3");
}

if(audio!=null)
audio.play();

}

function moveOn(){

$('#page0').hide();

showPage(NEXT_PAGE);

}

function resetBack(){

	stoppingCamera();

	setTimeout(function(){
		location.reload();	
	}, 2000);
	
}


function clearAllData(){

	localStorage.clear();

}


function formatOnlyDate(compDate){
var date = new Date(compDate);

        // Options for formatting the date
        var options = {
        	  year: 'numeric',
            month: 'long',
            day: 'numeric',
            timeZone: 'Asia/Jakarta', // Set the timezone to Indonesian time
            locale: 'id-ID' // Set the locale to Indonesian
        };

        // Format the date using the Intl.DateTimeFormat object
        var formatter = new Intl.DateTimeFormat('id-ID', options);
        var dayName = formatter.format(date);
        return dayName;

	
}

function formatOnlyHour(compDate){
var date = new Date(compDate);

        // Options for formatting the date
        var options = {
        	hour: 'numeric',
        	minute: 'numeric',
        	hour12: false,
            timeZone: 'Asia/Jakarta', // Set the timezone to Indonesian time
            locale: 'id-ID' // Set the locale to Indonesian
        };

        // Format the date using the Intl.DateTimeFormat object
        var formatter = new Intl.DateTimeFormat('id-ID', options);
        var dayName = formatter.format(date);
        return dayName;

	
}

function formatOnlyDay(compDate){
	var date = new Date(compDate);

        // Options for formatting the date
        var options = {
            weekday: 'long', // Display the full day name
            timeZone: 'Asia/Jakarta', // Set the timezone to Indonesian time
            locale: 'id-ID' // Set the locale to Indonesian
        };

        // Format the date using the Intl.DateTimeFormat object
        var formatter = new Intl.DateTimeFormat('id-ID', options);
        var dayName = formatter.format(date);
        return dayName;
}

function animTimeout(){
	
animTimerTimeout =	setInterval(timeoutWork, 1000);

}

function animLoading(){
	
animTimerTimeout =	setInterval(loadingWork, 1000);

}


function isEmpty(data){

	if(data.trim().length === 0){
		return true;
	}

	return false;

}


function isDataLocalAvailable(){

	if( localStorage.getItem(data_kode_aktifasi) != null ){
		return true;
	}

	return false;
}

function nextPage(){
	indexPage++;
}

function prevPage(){
	indexPage--;
}

function showSpecificPage(noPage){
	
	var namePage = "#page" + noPage;
	let i = 0;
	let currPage = "#page";
	for(; i<limitPage; i++){
		currPage = "#page" + i;
		$(currPage).hide();
		if(currPage == namePage){
			$(currPage).show();
		}
	}
}

function showPage(typePage){

	if(typePage==NEXT_PAGE){
		nextPage();
	}else{
		prevPage();
	}

	let startNum = 1;
	
	let nameVar = '';

	for(; startNum<=limitPage; startNum++){
		nameVar = "#page" + startNum;
		if(startNum==indexPage){
			// alert('nunjukkin ' + nameVar);
			$(nameVar).show();
		}else{
			$(nameVar).hide();
		} 
	}




}


function showWarning(mess){

	Swal.fire({
		icon: 'error',
		title: 'Error!',
		text: mess,
		timer: 1500,
		showConfirmButton: false
	});

}

function showSuccess(mess){

	Swal.fire({
		icon: 'success',
		title: 'Success!',
		text: mess,
		timer: 1500,
		showConfirmButton: false
	});

}