
var indexPage = 0;
const TUNGGU = 0;
const SHUTDOWN = 4;
const QRTERBACA = 5;
const SIAP = 1;
const BERHASIL = 2;
const GAGAL = 3;

var NEXT_PAGE = "N";
var PREV_PAGE = "P";

const limitPage = 5;

var URL_ADD_ABSENSI 	= "/device/add-absensi";
var URL_WA_ADMIN 			= "https://api.whatsapp.com/send?phone=6285795569337&text=";
//var URL_MAIN_PORTAL = "http://absensi.fgroupindonesia.com/portal";
//var URL_MAIN_PORTAL 	= "http://192.168.0.10";

var data_username 		= "username";
var data_phone 				= "phone_numbers";
var data_email 				= "user_email";

$( document ).ready(function() {
   
   // show animated loading for 3-4 seconds
	// only for the usage of portal UI
	// other than that dont use the movement
	var curURL = window.location.href;
	if(curURL.includes('/device'))
   setTimeout(moveOn, 2000);

	$('.btn-continue').click(function(){
		playAudio(TUNGGU);

		if(indexPage == 5){

			resetBack();

		} else {

			showPage(NEXT_PAGE);

			setTimeout(function(){
					 showPage(NEXT_PAGE);
					 playAudio(SIAP);
					 	init();
			}, 2000);

		}

	});

	$('.home').click(function(){
			resetBack();
	});
   

   
});

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

function checkDataQR(n){

	//alert('we got ' + n + ' mau dikirim ke ' + URL_MAIN_PORTAL+URL_ADD_ABSENSI);

let dataNa = {'email' : n};
let urlTarget = URL_MAIN_PORTAL+URL_ADD_ABSENSI;

$.ajax({
  url: urlTarget,
  type: "POST",
  data: dataNa,
  success: function(response) {
    // Handle the server response here
    playAudio(BERHASIL);

    showPage(NEXT_PAGE);
    //alert('server says ' + response);
  },
  error: function(xhr, status, error) {
    // Handle any errors that occur during the request
      alert('aw !' + error + ' status : ' + status);
    	playAudio(GAGAL);

    	indexPage=6;
    	showSpecificPage(indexPage);
  }
});


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

      		// switch 'user' -> front camera
      		// to 'environment' -> rear camera
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
									playAudio(QRTERBACA);
									stoppingCamera();

									// show loading
									showPage(NEXT_PAGE);

									setTimeout(function(){
											// calling POST to check data
											checkDataQR(code.data);
									}, 2000);
									
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
