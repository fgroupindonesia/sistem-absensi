let countdownInterval;
let timeLeft = 15;
let timeText = "";

function updateTimer() {

  if(timeLeft>1){
    timeText = timeLeft + ' seconds';   
  }else{
    timeText = timeLeft + ' second';   
  }
  
  $('#time-second').text(timeText);
  timeLeft--;
  if (timeLeft < 0) {
    clearInterval(countdownInterval);
    $('#time-second').text('0 second');
    fetchQRCode();
    timeLeft = 15;
  }
}

function fetchQRCode() {
  $('#loadingSpinner').show();
  $('#qrcode').hide();
  let codena = $('#public_token').val();
  let idna = $('#id').val();

  $('#message-recalibrate').fadeOut();

  setTimeout(function() { //Added setTimeout for 3-second delay
    $.ajax({
      url: URL_MAIN_PORTAL + 'checkpoint/recalibrate',
      type: 'post',
      data: { token: codena, id : idna },
      dataType: 'json',
      success: function(response) {
        if (response.path) {
         $('#message-recalibrate').fadeIn();
          $('#qrcode').attr('src', response.path);
        }
      },
      error: function(xhr, status, error) {
        console.log('AJAX Error:', error);
        $('#loadingSpinner').hide(); // Hide spinner on error
        $('#qrcode').show(); // Show QR code even if an error occurs
      },
      complete: function() {
        $('#loadingSpinner').hide();
        $('#qrcode').show();
        countdownInterval = setInterval(updateTimer, 1000);
      }
    });
  }, 3000); // 3000 milliseconds = 3 seconds
}

$(document).ready(function() {
  countdownInterval = setInterval(updateTimer, 1000);

  

});