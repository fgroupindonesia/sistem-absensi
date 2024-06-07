
var indexPage = 1;
var NEXT_PAGE = "N";
var PREV_PAGE = "P";
var URL_VERIFIKASI = "/portal/verifikasi";
var URL_VERIFIKASI_2ND = "/portal/verifikasiwa";
var URL_ATTENDANCE = "/portal/absen/all";
var URL_WA_ADMIN = "https://api.whatsapp.com/send?phone=6285795569337&text=";
//var URL_MAIN_PORTAL = "http://absensi.fgroupindonesia.com/portal";
var URL_MAIN_PORTAL = "http://192.168.0.11/portal";

var data_username = "username";
var data_phone = "phone_numbers";
var data_email = "user_email";
var PHONE_NUMBERS = null;
var EMAIL = null;
var USERNAME = null;
var ABSENSI_ALL = null;
var jumlahPercobaan = 0;

$( document ).ready(function() {
   
   // show animated loading for 3-4 seconds
	// only for the usage of portal UI
	// other than that dont use the movement
	var curURL = window.location.href;
	if(curURL.includes('/portal'))
   setTimeout(moveOn, 4000);

	$('.menu-user').click(function(){

		var siapa = $(this).data('user');
		//alert(siapa);
		showPage(NEXT_PAGE);

	});

	$('#wa-verifikasi').click(function(){

		// hide email
		$('.form-email').hide();
		showPage(NEXT_PAGE);

	});

	$('#email-verifikasi').click(function(){

		// hide wa
		$('.form-wa').hide();
		showPage(NEXT_PAGE);

	});

	$('.home').click(function(){

		// stop camera but not sending data
		stoppingCamera(false);

		indexPage = 6;
		showSpecificPage(indexPage);

	});

	$('#cancel').click(function(){

		$('#page6').hide();
		$('#exit').show();
		clearAllData();
		animTimeout();

	});

	$('#absen-hadir').click(function(){

			showPage(NEXT_PAGE);
			init();

	});

	$('#absen-sebelum').click(function(){

			indexPage = 8;
			showSpecificPage(indexPage);
			grabDataAttendance();

	});


	$('#btn-nama-lengkap-ok').click(function(){
		showPage(NEXT_PAGE);
	});

	$( "#form-awal-verifikasi" ).on( "submit", function( event ) {
	 
	  event.preventDefault();

	  var telp = $('#phone_numbers').val();
	  var email = $('#email').val();

	   	$(this).find('img').show();
	 	$('#btn-phone-ok').hide();
	 
	  verifikasi(telp, email);


	});

	$( "#form-digit-verifikasi" ).on( "submit", function( event ) {
	 
	  event.preventDefault();

	  if(jumlahPercobaan < 3){

	  var kode7Digit = $('#kode-wa-all').val();
	  
	  console.log('coba verifikasi kode ' + kode7Digit)
	  
	 setTimeout(function(){
	 	verifikasiLagi(kode7Digit);
	 }, 3000);


	  jumlahPercobaan++;

	  $('#btn-kode-wa-ok').hide();
	  $('#loading-kode-wa').show();

	}else{
		// tampilin jumlah percobaan terbatas!
		$('.error-kode-wa-terbatas').show();
		$('#btn-kode-wa-ok').hide();
		lockAllCodes();
	}

	});
	

	$("#phone_numbers, #email").on("keyup", function(e){
		var p = $(this).val();

		if(p.length>3 && e.which !== 13){
			$('#btn-phone-ok').show();
			$('#btn-phone-ok').css('display','inline-block');
		}else{
			$('#btn-phone-ok').hide();
		}

		 $('.error-phone-numbers').hide();

	});

	$(".kode-wa").on("keyup", function(e){
		var nextElement = $(this).next();
            // Set focus on the next element
     	
        let namiClass = $(this).attr('class');

        if(namiClass.includes('kode-wa')){
    	    nextElement.focus();
        }

		let pas = kodeWAPas();
		let percobaanMasih = checkPercobaanAda();
		let tidakAdaLoading = !checkLoadingKodeWAAda();

		if(pas && percobaanMasih && tidakAdaLoading){
			$('#btn-kode-wa-ok').show();
			$('#btn-kode-wa-ok').css('display','inline-block');
		}else {
			$('#btn-kode-wa-ok').hide();
		}

		$('.error-kode-wa').hide();

	});


	// when filter data absen changed
	$('#filter-absen').on("change", function(){
		let nilai = $('#filter-absen').val();
		showDataByFilter(nilai);
	});
   
});

function moveOn(){

$('#page0').hide();

	if(isDataLocalAvailable()){
	   		// open specific page becuase this user
	   		// has been logged in previous session
	   			indexPage = 5;
	   			showSpecificPage(indexPage);

	   			let nama = localStorage.getItem(data_username);
	   			$('#nama-lengkap').text(nama);
	   			showLocation();
	}else {
				indexPage = 1;
	   			showSpecificPage(indexPage);
	}

}

function lockAllCodes(){

	$('.kode-wa').attr('readonly','true');

}

function checkLoadingKodeWAAda(){

	if($('#loading-kode-wa').is(":visible")){
		return true;
	}

	return false;

}

function checkPercobaanAda(){

	if($('.error-kode-wa-terbatas').is(":visible")){
		return false;
	}

	return true;

}

function kodeWAPas(){

		var k1 = $('#kode-wa1').val();
		var k2 = $('#kode-wa2').val();
		var k3 = $('#kode-wa3').val();
		var k4 = $('#kode-wa4').val();
		var k5 = $('#kode-wa5').val();
		var k6 = $('#kode-wa6').val();
		var k7 = $('#kode-wa7').val();
		
		let semuaKA = k1 + k2 + k3 + k4 + k5 + k6 + k7;
		$('#kode-wa-all').val(semuaKA);

		if(semuaKA.length == 7){
			return true;
		}

		return false;

}

function clearAllData(){

	localStorage.clear();

}

function showDataByFilter(statusFind){

	// clear first
	$('#table-absen tbody').empty();

	// match the status wanted
	let dat = ABSENSI_ALL;
	
	$.each(dat, function(index, item) {

					let statusCocok = false;
					if(item.status == statusFind && statusFind != 'all'){
						statusCocok = true;
					}else if(statusFind == 'all'){
						statusCocok = true;
					}	

					if(statusCocok){
			                    $('#table-absen tbody').append(
			                        '<tr>' +
			                            '<td>' + formatOnlyDay(item.date_created) + '</td>' +
			                          '<td>' + formatOnlyDate(item.date_created) + '</td>' +
			                            '<td>' + formatOnlyHour(item.date_created) + '</td>' +
			                        '</tr>'
			                    );
			            }

			 });


}

function grabDataAttendance(){
	let nama = localStorage.getItem(data_username);

	// clear first
	$('#table-absen tbody').empty();

	 let dataAbsen = $.post( URL_ATTENDANCE, { username: nama } );
 
  // Put the results in a div
	  dataAbsen.done(function( data ) {
	    if(data!=null){
	    	
	    	var dat = JSON.parse(data);
	    	
	    	ABSENSI_ALL = dat;

			 $.each(dat, function(index, item) {
			                    $('#table-absen tbody').append(
			                        '<tr>' +
			                            '<td>' + formatOnlyDay(item.date_created) + '</td>' +
			                          '<td>' + formatOnlyDate(item.date_created) + '</td>' +
			                            '<td>' + formatOnlyHour(item.date_created) + '</td>' +
			                        '</tr>'
			                    );
			                });


	    }
	    // data absensi all
	    // console.log(data);
	  });


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

function loadingWork(){
	if(detik == -1){
		clearInterval(animTimerTimeout);
		detik = 5;
		$('#loading').hide();
		$('#final').show();
        return false;
	}else{

		$('.detik').text(detik + ' detik.');
		detik--;
	}
}

	var animTimerTimeout;
	var detik = 5;

function timeoutWork(){

	if(detik == -1){
		clearInterval(animTimerTimeout);
		detik = 5;
		$('#exit').fadeOut();
		window.location.replace('http://fgroupindonesia.com');
        return false;
	}else{

		$('.detik').text(detik + ' detik.');
		detik--;
	}

}

function isEmpty(data){

	if(data.trim().length === 0){
		return true;
	}

	return false;

}

function verifikasiLagi(kode7DigitNa){

	let posting = null;

	// console.log('tadi ' + kode7DigitNa);

	if(!isEmpty(kode7DigitNa)){

	 posting = $.post( URL_VERIFIKASI_2ND, { code : kode7DigitNa } );
 
  // Put the results in a div
	  posting.done(function( data ) {
	    if(data!=null){
	    	
	    	var dat = JSON.parse(data);

	    	if(dat != false){

				showLocation();

		    	// save dulu data storage
		    	saveDataLocal();


			    $('.error-kode-wa').hide();
				showPage(NEXT_PAGE);


    
			}else{

				$('#loading-kode-wa').hide();
				$('.error-kode-wa').show();

			}

	    }

	    console.log(data);
	  });

	}

}

function requestWACode(namaOrang, nomorWA){

	// opening tab baru pergi ke whatsapp
	// sending the following format
	let _enterChar = "%0A";
	let dataRequest = "Hello *Admin* ! " + _enterChar +
						"Saya *" + namaOrang + "* baru saja mau " + _enterChar +
						"melengkapi *Abseni Kehadiran* di *Sistem Portal Absensi* " + _enterChar +
						"dengan nomor WA: *" + nomorWA + "*, " + _enterChar +
						"mohon dibantu aktifasinya ya.";


	window.open(URL_WA_ADMIN+dataRequest, "_blank"); 					

}

function verifikasi(nomer, email){

	let posting = '';

	if(!isEmpty(nomer)){

	 posting = $.post( URL_VERIFIKASI, { phone_numbers: nomer } );
 	console.log('mengirim wa verifikasi ');
	} else if(!isEmpty(email)){

	 posting = $.post( URL_VERIFIKASI, { user_email : email } );
	 console.log('mengirim email verifikasi ');
	}

  // Put the results in a div
	  posting.done(function( data ) {
	    if(data!=null){
	    	

	    	var dat = JSON.parse(data);

	    	if(dat != false){

				showLocation();
		    	$('#nama-lengkap').text(dat.username);
		    	let namana 	= $('#nama-lengkap').text();

		    	if(!isEmpty(nomer)){
		    		$('#check-email').hide();
		    		$('#check-kode-wa').show();
		    		//saveDataLocal(nomer, 'wa', dat.username);

		    		let wana 	= $('#phone_numbers').val();

		    		PHONE_NUMBERS = wana;

		    		// call after 4 seconds
		    		setTimeout(requestWACode(namana, wana), 4000);

			    }else {
			    	$('#check-email').show();
		    		$('#check-kode-wa').hide();

		    		let emailna = $('#email').val();
		    		EMAIL = emailna;

					//saveDataLocal(email, 'email', dat.username);
			    }

				USERNAME = namana;
		    	
			    $('.error-phone-numbers').hide();
			    showPage(NEXT_PAGE);

			} else{
				$('.error-phone-numbers').show();
				$('#img-loading').hide();
			}

	    }

	    console.log(data);

	  });


}

function saveDataLocal(){
	localStorage.setItem(data_username, USERNAME);

	localStorage.setItem(data_phone, PHONE_NUMBERS);
	localStorage.setItem(data_email, EMAIL);

	console.log('logged in success!');
}

function isDataLocalAvailable(){
	if(localStorage.getItem(data_username) != null && 
		(localStorage.getItem(data_phone) != null || localStorage.getItem(data_email) != null) ){
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
	for(i=1; i<9; i++){
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
	let endNum = 7;
	let nameVar = '';

	for(startNum=1; startNum<=endNum; startNum++){
		nameVar = "#page" + startNum;
		if(startNum==indexPage){
			// alert('nunjukkin ' + nameVar);
			$(nameVar).show();
		}else{
			$(nameVar).hide();
		} 
	}




}

var kali = 1;
function showLoading(dataNa){
	console.log('didapat lah '  + kali + ' yaitu ' + dataNa);
	kali++;
	stoppingCamera(true);
}

var videoStream;

function stoppingCamera(sendData){

	 if (videoStream) {
        const tracks = videoStream.getTracks();
        tracks.forEach(track => track.stop());
		$('#video').hide();
		$('#scan-line').hide();
		$('#coordinates').show();

    }

    if(sendData){

    setTimeout(function(){
    	$('#page7').hide();
    	$('#loading').show();
    	animLoading();	
    }, 2000);

    }
    

}

function calculateDistance(lat1, lon1, lat2, lon2) {
        var R = 6371; // km
      var dLat = toRad(lat2-lat1);
      var dLon = toRad(lon2-lon1);
      var lat1 = toRad(lat1);
      var lat2 = toRad(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
      var d = R * c;
      return d;

}


function toRad(Value) 
{
        return Value * Math.PI / 180;
}

function showLocation(){
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
      } else {
        $("#coordinates").text("Geolocation is not supported by this browser.");
      }
}

 function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // FGRoupIndonesia location
          var targetLocation = {
        latitude: -6.923582728172454,
        longitude: 107.70296536782762
      };

         var distance = calculateDistance(latitude, longitude, targetLocation.latitude, targetLocation.longitude);
         var jarak = distance.toFixed(1);

         if(jarak <= 2){
        	$("#coordinates").text("Latitude: " + latitude + ", Longitude: " + longitude + ', '  + distance.toFixed(1) + 'meter.');
			 $('#failed').hide();
			 $('#success').show();
		} else {
			 $("#coordinates").text("too far!");
			 $('#failed').show();
			 $('#success').hide();
		}      
}

function showError(error) {
        switch (error.code) {
          case error.PERMISSION_DENIED:
            $("#coordinates").text("User denied the request for Geolocation.");
            break;
          case error.POSITION_UNAVAILABLE:
            $("#coordinates").text("Location information is unavailable.");
            break;
          case error.TIMEOUT:
            $("#coordinates").text("The request to get user location timed out.");
            break;
          case error.UNKNOWN_ERROR:
            $("#coordinates").text("An unknown error occurred.");
            break;
        }
}

async function init() {
      const video = $('#video')[0];
      const scanLine = $('#scan-line');
      const rectangle = $('#coloring-camera');
       const boxRect = $('#rectangle');
	   const clickSound = $('#click-sound')[0];
	    const screenshot = $('#screenshot')[0];

	   
      try {

      	if ('mediaDevices' in navigator && 'getUserMedia' in navigator.mediaDevices) {
  			// start camera works

        const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
        video.srcObject = stream;
				videoStream = stream;

        // Wait for the video to load its metadata
        video.addEventListener('loadedmetadata', function() {
          const canvas = document.createElement('canvas');
          const canvasContext = canvas.getContext('2d');
          canvas.width = video.videoWidth;
          canvas.height = video.videoHeight;

          let isBarcodeFound = false;

          const drawFrame = () => {
            canvasContext.drawImage(video, 0, 0, canvas.width, canvas.height);

            try {
              const imageData = canvasContext.getImageData(0, 0, canvas.width, canvas.height);
              const code = jsQR(imageData.data, imageData.width, imageData.height);

              if (code) {
                if (!isBarcodeFound) {
                  isBarcodeFound = true;
                  rectangle.css('background-color', 'rgba(0, 255, 0, 0.3)');
                  //console.log('Barcode data:', code.data);
                  setTimeout(() => {
                    rectangle.css('background-color', 'rgba(255, 0, 0, 0.1)');
                    isBarcodeFound = false;
                  }, 500);
                }
				
				 screenshot.src = canvas.toDataURL();
                  //$(screenshot).css('width' , '100px');
                  //$(screenshot).css('height', '200px');
                  $(screenshot).show();
				
				clickSound.play(); 
				showLoading(code.data);
				
              } else {
                rectangle.css('background-color', 'rgba(255, 0, 0, 0.1)');
                isBarcodeFound = false;
              }
            } catch (error) {
              console.error('Error getting image data:', error);
            }

            requestAnimationFrame(drawFrame);
          };

          drawFrame();
        });

      } else {
      	alert('please switch to mobile device!');
      	$('#error-not-mobile').show();
      	console.log('camera can not be used in laptop/desktop!');
      }

      } catch (error) {
        console.error('Error accessing camera:', error);
      }
    }
