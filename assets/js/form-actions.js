
const URL_CHECKPOINT_DOWNLOAD_PDF = URL_MAIN_PORTAL + 'checkpoint/download/pdf';
const URL_ACTIVATE_STAFF = URL_MAIN_PORTAL + "staff/activate";
const URL_DELETE_STAFF = URL_MAIN_PORTAL + "staff/delete";
const URL_ADD_CHECKPOINT = URL_MAIN_PORTAL + "checkpoint/add";

$(document).ready(function(){

// ensure the data for user is extracted to form
displayUserActivation();

//trigger the email activation for this user
callEmailActivation();

// when download click on checkpoint generated qr
downloadCheckPoint();

// when checkpoint form 
	 $('#patokan-checkpoint').on('change', function() {
        var selected = $(this).val();
       
        if(selected == 'event'){
        	//$('#container-nama-event').show();
        	$('#container-nama-lokasi').hide();
        	$('#map').hide();
        }else{
        	//$('#container-nama-event').hide();
        	$('#container-nama-lokasi').show();
        	$('#map').show();

        	 
        	renderUlangMap();

        }

      });

	// when link link-save-staff clicked
	$('#link-save-staff').click(function(){

		let dataForm = $('#staff-form').serialize();
		//alert(dataForm);
		addStaff(dataForm);


	});

	// when link link-generate-qrcode clicked
	$('#link-generate-qrcode').click(function(){

		let dataForm = $('#checkpoint-form').serialize();
		//alert(dataForm);
		addCheckpoint(dataForm);

	});

	// ketika ada form checkpoint dan nama ataupun lokasi blm di isi maka
	// smbunyikan generate qrcode
	 function toggleGenerateButton(){
        const namaEvent = $('input[name="nama-event"]').val().trim();
        const lokasi = $('#locationInput').val().trim();

        if(namaEvent !== "" || lokasi !== ""){
            $('#link-generate-qrcode').show();
        } else {
            $('#link-generate-qrcode').hide();
        }
    }

    $('#modal-checkpoint').on('shown.bs.modal', function () {
  			toggleGenerateButton();
		});
   

    // cek setiap kali user mengetik di form tadi
    $('input[name="nama-event"], #locationInput').on('input', function(){
        toggleGenerateButton();
    });

     $('#expired_unlimited, #expired2h, #expired1h, #starting_time, #starting_date').on('change', function(){
        toggleGenerateButton();
    });

	// when link link-checkpoint-cancel clicked
	$('#link-checkpoint-cancel').click(function(){

		let perluRefresh = $(this).attr('data-need-refresh');

		if(perluRefresh == 'true'){
			window.location.reload();
		}else{
			$('#modal-checkpoint').find('.btn-close').click();
		}

	});	

// when btn-activation-whatsapp clicked
$('#btn-activation-whatsapp').click(function(){

		let tokenNa = $('#staff-activation-token').val();
		let waNa = $('#staff-activation-whatsapp').val();

		sendingWAActivation(waNa, tokenNa);

}); 


// when link link-activate-staff clicked
	$(document).on('click', '.link-activate-staff', function(){

		let idNa = $(this).data('id');
		let tokenNa = $(this).data('token');
		let works = $(this).data('type');

		//show the form after 3 secs
		if(works == 'activate'){
			activateOptionStaff(idNa, tokenNa, true);
		}else{
			activateOptionStaff(idNa, tokenNa, false);	
		}
		

	}); 

	// when reset device tag clicked
	$(document).on('click', '.link-reset-device-staff', function(){

		let idNa = $(this).data('id');
		let tokenNa = $(this).data('token');
		let works = $(this).data('type');

		
			resetDevice(idNa, tokenNa);
		
		

	}); 

	// when link link-edit-staff clicked
	$(document).on('click', '.link-edit-staff', function(){

		let idNa = $(this).data('id');
		let tokenNa = $(this).data('token');

		
			editStaff(idNa, tokenNa);
		
		

	}); 

	// when button bulk delete clicked
	prosesBulkDeleteStaff();

	// when link link-delete-staff clicked
	$(document).on('click', '.link-delete-staff', function(){

		let idNa = $(this).data('id');
		let tokenNa = $(this).data('token');

	
			deleteStaff(idNa, tokenNa);
		
	});

	// when entry limit is entered
	$('#entry_limit').keyup(function(e){

		if(e.keyCode == 13){
			resubmitManagementStaff();
		}

	});

});

function prosesBulkDeleteStaff(){

	$('.btn-delete-staff').on('click', function() {
    let staffToken = $(this).data('token');

    let ids = [];
    let nama = [];
    $('.staff-id:checked').each(function() {
        ids.push($(this).val());
        nama.push($(this).attr('data-name'));
    });

    if (ids.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Pilih dulu staff yang mau dihapus!',
        });
        return;
    }

    Swal.fire({
        title: 'Yakin?',
        html: "Mau hapus staff:<br><b>" + nama.join(", ") + "</b> ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

        	let datana = {
                    ids: ids,
                    public_token: staffToken
                };

        	alert(JSON.stringify(datana));

            $.ajax({
                url: URL_DELETE_STAFF,
                type: "POST",
                dataType: "json",
                data: datana,
                success: function(res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: res.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // delete si card
                    ids.forEach(function(staffId) {
                        $('.staff-card').has('.staff-id[value="'+staffId+'"]').remove();
                    });

                    // refresh table management
                    refreshTableStaff();
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Gagal hapus staff',
                    });
                    console.error(xhr.responseText);
                }
            });
        }
    });
});


}

function hideModalByID(anID){
	let modalName = anID;

	if(anID.includes('#')){
		modalName = anID.replace('#','');
	}

	//console.log(modalName);

	const modalEl = document.getElementById(modalName);
  const modalInstance = bootstrap.Modal.getInstance(modalEl);
  if (modalInstance) {
    modalInstance.hide();
  }

}

function showModalByButtonID(anID){
	let modalName = anID;

	if(!anID.includes('#')){
		modalName = '#' + anID;
	}

	console.log('button name ' + modalName);
	$(modalName).click();

}

function displayStaffForm(idMasuk, tokenMasuk, dataJSON){
	// changing state
	let formStaff = $('#modal-staff').find('form');
	formStaff.attr('action', '/staff/update');
	formStaff.attr('data-id', idMasuk);
	
	// ensure the string is in json format
	dataJSON = JSON.parse(dataJSON);
	dataJSON = dataJSON.data;

	$('#staff-id').val(idMasuk);
	
	$('#staff-token').val(tokenMasuk);
	$('#staff-title').text("Edit Staff");

	$('#staff-notes').text(dataJSON.notes);
	$('#staff-whatsapp').val(dataJSON.whatsapp);
	$('#staff-email').val(dataJSON.email);

	$('#staff-number_ic').val(dataJSON.number_ic);
	
	$('#staff-name').val(dataJSON.name);

	if(dataJSON.status == 'active'){
		$('#staff-status_aktif').prop('checked', true);
	}else{
		$('#staff-status_non_aktif').prop('checked', true);
	}

	// divisions haru direcreate perbaris...
	let i = 1;
	$.each(dataJSON.divisions, function(index, divisi) {
    
		let newRow = null;

		if(i==1){
			newRow = $('#division-container .division-row:first');
		}else{
			newRow = $('#division-container .division-row:first').clone();	
		}
    
      newRow.find('select').val(divisi.id);
      newRow.find('.division-input-new').addClass('d-none').val('');
      newRow.find('.btn-save-division, .btn-cancel-division').addClass('d-none');
      newRow.find('.btn-create-division').removeClass('d-none');

      if(i!=1)
      $('#division-container').append(newRow);

      i++;

	});

	$('#link-save-staff').text('Update Staff Data');
	
	

}

function sendingWAActivation(nomorWA, code7){

	let  number = nomorWA.replace(/\D/g, '');
  let message = "*7 Digit OTP - Sistem Absensi* untuk Anda yaitu : *" + code7 + "*";
  // Create the WhatsApp link
  let link = 'https://wa.me/' + number + '?text=' + encodeURIComponent(message);

  // Open the link in a new tab
  window.open(link, '_blank');

}

function sendingEmailActivation(){

	

}

function downloadCheckPoint(){

	$('body').on('click', '#checkpoint-download', function(e){

		e.preventDefault();

		let el = $('#generated-qr');
		let acara = $('#checkpoint-name-event').val();
		clickDownloadImage(el, acara);

	});

}

function displayActivationForm(idMasuk, tokenMasuk, dataJSON){
	// changing state
	let formStaff = $('#modal-activation').find('form');
	formStaff.attr('action', '/staff/activate');
	formStaff.attr('data-id', idMasuk);

	//showModalByButtonID('#btn-activate-staff');
	
	// ensure the string is in json format
	dataJSON = JSON.parse(dataJSON);

	$('#staff-activation-id').val(idMasuk);
	
	$('#staff-activation-token').val(tokenMasuk);
	$('#staff-activation-title').text("Staff Activation");

	$('#staff-activation-whatsapp').val(dataJSON.whatsapp);
	$('#staff-activation-email').val(dataJSON.email);

	$('#staff-activation-name').val(dataJSON.name);

	$('#link-activation-staff').hide();
	
	// trigger the button clicked
	bukaModal('modal-activation');


}

function editStaff(idMasuk, tokenMasuk){

	let dataForm = {id: idMasuk, public_token:tokenMasuk};

	// after timeout render into the edit form
	let urlNa = URL_MAIN_PORTAL + "/staff/edit";
	
		// ajax post started
		 $.ajax({
		      url: urlNa, 
		      type: "POST",
		      data: dataForm,
		      success: function(response) {
		        
		        //refreshMe();
		        console.log(response);

		       
		        	displayStaffForm(idMasuk, tokenMasuk, response);
		       
		        

		      },
		      error: function(jqXHR, textStatus, errorThrown) {
		      		console.log('ERROR', textStatus, errorThrown);
		      		console.log(jqXHR.responseText);
		      		
		      }
		 }); // ajax post ended


}

function resetDevice(idMasuk, tokenMasuk){
    $.ajax({
        url: URL_MAIN_PORTAL + "staff/clear-tag", 
        type: "POST",
        dataType: "json",
        data: {
            id: idMasuk,
            public_token: tokenMasuk
        },
        success: function(res){
            if(res.status === "success"){
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.message,
                    timer: 2000,            // 2 detik
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: res.message || "Terjadi kesalahan!",
                    timer: 2000,            // 2 detik
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            }
        },
        error: function(xhr, status, error){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Koneksi ke server gagal!",
                timer: 2000,            // 2 detik
                showConfirmButton: false
            }).then(() => {
                //location.reload();
            });
        }
    });
}


function activateOptionStaff(idMasuk, tokenMasuk, aktifkan){

statusna = 0;

if(aktifkan){
	statusna = 1;
}

let dataForm = {id: idMasuk, public_token:tokenMasuk, via : 'email', status : statusna};	

	
	// after timeout render into the edit form
	let urlNa = URL_ACTIVATE_STAFF;
	
		// ajax post started
		 $.ajax({
		      url: urlNa, 
		      type: "POST",
		      data: dataForm,
		      success: function(response) {
		        
		      	if(!aktifkan){
		      		pesan = 'Berhasil dimatikan!';
		      	}else {
		      		pesan = 'Aktifasi via email terkirim!';
		      	}

		      	Swal.fire({
							  icon: 'success',
							  title: pesan,
							  timer: 1800,
							  showConfirmButton: false
							});

		      	refreshMe();

		       
		      },
		      error: function(jqXHR, textStatus, errorThrown) {
		      		console.log('ERROR', textStatus, errorThrown);
		      		console.log(jqXHR.responseText);
		      		
		      }
		 }); // ajax post ended


}

function deleteStaff(idMasuk, tokenMasuk){

	let dataForm = {ids: idMasuk, public_token:tokenMasuk};

	// after timeout render into the edit form
	let urlNa = URL_MAIN_PORTAL + "/staff/delete";
	
		// ajax post started
		 $.ajax({
		      url: urlNa, 
		      type: "POST",
		      data: dataForm,
		      success: function(response) {
		        
		        let jawab = JSON.parse(response);

		        if(jawab.status == 'success'){

		        	Swal.fire({
							  title: 'Sukses!',
							  text: 'Data berhasil dihapus.',
							  icon: 'success',
							  timer: 1800, // 2 detik
							  showConfirmButton: false
							});

		        	
		        		refreshMe();		
		        
		        	
		        }else{
		        		Swal.fire({
							  title: 'Error!',
							  text: jawab.message,
							  icon: 'error',
							  timer: 2000, // 2 detik
							  showConfirmButton: false
							});
		        }
		        
		       
		      },
		      error: function(jqXHR, textStatus, errorThrown) {
		      		console.log('ERROR', textStatus, errorThrown);
		      		console.log(jqXHR.responseText);
		      		
		      }
		 }); // ajax post ended


}

function resubmitManagementStaff(){
	let limitNumber = $('#entry_limit').val();
	window.location = URL_MAIN_PORTAL + "/portal/management-staff?entry_limit=" + limitNumber;

}	

function addCheckpoint(dataForm){

	let endPoint = $('#checkpoint-form').attr('action');


	//let urlNa = URL_MAIN_PORTAL + "/staff/add";
	let urlNa = URL_ADD_CHECKPOINT;

	let idna = $('#staff-checkpoint-id').val();

	if(idna !== ''){
		urlNa = URL_UPDATE_CHECKPOINT;
	}
	//alert('kirim ke ' + urlNa);
	//console.log('datana ' + dataForm);

	// ajax post started
		 $.ajax({
		      url: urlNa, 
		      type: "POST",
		      data: dataForm,
		      success: function(response) {
		        
		        if(isValidJSON(response)){
		        	let data = JSON.parse(response);

		        	if(!isInvalid(data.status)){
		        		$('#generated-qr').attr('src', data.qr_code);
		        		$('#generated-qr').attr('alt', data.checkpoint);

		        		$('#preview-qr-section').show();
		        		$('#link-generate-qrcode').hide();

		        		$('#link-checkpoint-cancel').attr('data-need-refresh', 'true');
		        		$('#link-checkpoint-cancel').text('OK');
		        		$('#link-checkpoint-cancel').attr('class','btn btn-primary');

		        	}else{
		        		showWarningAlert('Data gagal disimpan!');
		        	}
		        }

		      },
		      error: function(jqXHR, textStatus, errorThrown) {
		      		console.log('ERROR', textStatus, errorThrown);
		      		console.log(jqXHR.responseText);
		      		
		      }
		 }); // ajax post ended

}

function addStaff(dataForm){

	let endPoint = $('#staff-form').attr('action');

	//let urlNa = URL_MAIN_PORTAL + "/staff/add";
	let urlNa = URL_MAIN_PORTAL + endPoint;
	//alert('kirim ke ' + urlNa);
	console.log('datana ' + dataForm);

	// ajax post started
		 $.ajax({
		      url: urlNa, 
		      type: "POST",
		      data: dataForm,
		      success: function(response) {
		        
		      	let jawab = JSON.parse(response);

		        if(jawab.status == 'success'){
		        	Swal.fire({
							  title: 'Berhasil!',
							  text:  jawab.message,
							  icon: 'success',
							  timer: 2000, // 2 detik
							  showConfirmButton: false
							});

		        }else {

		        	Swal.fire({
							  title: 'Error!',
							  text: jawab.message,
							  icon: 'error',
							  timer: 2000, // 2 detik
							  showConfirmButton: false
							});


		        }

		        setTimeout(function(){
		        	window.location.reload();	
		        },2000);
		        
		        

		      },
		      error: function(jqXHR, textStatus, errorThrown) {
		      		console.log('ERROR', textStatus, errorThrown);
		      		console.log(jqXHR.responseText);
		      		
		      }
		 }); // ajax post ended

		 // clear staff-id yg berhasil tersave / update
		 $('#modal-staff').find('#staff-id').val('');

}

function isMobile() {
  const ua = navigator.userAgent || navigator.vendor || window.opera;
  return /cordova|android|iphone|ipad|ipod/i.test(ua);
}

function clickDownloadImage(element, namaEvent) {
  const { jsPDF } = window.jspdf;

  const imgElement = $(element)[0];
  
  // Create a canvas element
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');
  
  // Set canvas dimensions to match the image
  canvas.width = imgElement.naturalWidth;
  canvas.height = imgElement.naturalHeight;
  
  // Draw the image onto the canvas
  ctx.drawImage(imgElement, 0, 0);
  
  // Create a new jsPDF instance
  const pdf = new jsPDF({
    orientation: canvas.width > canvas.height ? 'landscape' : 'portrait',
    unit: 'px',
    format: [canvas.width, canvas.height + 50] // lebih tinggi sedikit
  });

  // Tambahkan judul (namaEvent) di atas gambar
  pdf.setFontSize(18); // lebih besar (kayak h2)
  pdf.setTextColor(0, 0, 0); // hitam
  pdf.text(namaEvent, canvas.width / 2, 25, { align: 'center' });

  // Add the image ke PDF (posisi agak turun biar gak ketindih judul)
  const imgData = canvas.toDataURL('image/jpeg', 1.0);
  pdf.addImage(imgData, 'JPEG', 0, 33, canvas.width, canvas.height);

  // Tambahkan copyright di bawah gambar
  const year = new Date().getFullYear();
  const copyrightText = `(c) ${year} Sistem Kehadiran & Absensi - FGroupIndonesia`;
  pdf.setFontSize(7);
  pdf.setTextColor(100); // abu-abu
  pdf.text(copyrightText, canvas.width / 2, canvas.height + 45, { align: 'center' });

  // Download PDF
  const filename = $(imgElement).attr('alt') || "checkpoint";
  

  if(isMobile()){
  
  	// gimana proses downloadnya ini??
  	 const blob = pdf.output("blob");
		  const formData = new FormData();
		  formData.append("file", blob, filename + '.pdf');

		  fetch(URL_CHECKPOINT_DOWNLOAD_PDF, {
		    method: "POST",
		    body: formData
		  })
		  .then(r => r.json())
		  .then(res => {
		    if (res.url) {
		      
		      alert(res.url);
		      /* these not working */
		      //window.open(res.url, "_blank");
		      //window.open(res.url, "_self");
		      //window.location.href = 'cdvfile://download?file=' + encodeURIComponent(res.url);
		      //window.location.href = res.url;
		      /* OMG i will try to use postmessage */

		       let datana = {
	            action: 'download',
	            url: res.url
	          };

		      if (window.cordova_iab && typeof window.cordova_iab.postMessage === 'function') {
					    alert('Cordova IAB postMessage tersedia');
					    //window.cordova_iab.postMessage(datana);
					    window.cordova_iab.postMessage(JSON.stringify(datana));

					} else if (window.parent && typeof window.parent.postMessage === 'function') {
					    alert('Parent postMessage tersedia');

					   
					    window.parent.postMessage(JSON.stringify(datana), '*');


					} else if (window.opener && typeof window.opener.postMessage === 'function') {
					    alert('Opener postMessage tersedia');
					} else if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.cordova_iab) {
					    // iOS
						alert('ios postMessage tersedia');
					   window.webkit.messageHandlers.cordova_iab.postMessage(JSON.stringify(datana), '*');
					} else  {
					    // Android
						alert('ga tau apaan');
					   
					}



					

		      

		    }
		  });

  }else{
  	pdf.save(filename + '.pdf');	
  }

}


function isValidJSON(str) {
  try {
    JSON.parse(str);
    return true;
  } catch (e) {
    return false;
  }
}

function isInvalid(value) {
  // Convert to lowercase for case-insensitive comparison
  const lowerValue = String(value).toLowerCase();
  
  // Check if the value is one of the valid options
  if (lowerValue === "success" || lowerValue === "valid" || lowerValue === "ok") {
    return false; // Not invalid (i.e., valid)
  } else {
    return true; // Invalid
  }
}

function refreshMe(){
	setTimeout(function(){
		location.reload();
	}, 2000);
}


function showSuccessAlert(mess) {
  Swal.fire({
    title: 'Success!',
    text: mess,
    icon: 'success',
	timer: 1400,
	timerProgressBar: true,
	showConfirmButton: false
  });
}

// Info alert
function showInfoAlert(mess) {
  Swal.fire({
    title: 'Information',
    text: mess,
    icon: 'info',
    timer: 1400,
  timerProgressBar: true,
  showConfirmButton: false
  });
}

// Warning alert
function showWarningAlert(mess) {
  Swal.fire({
    title: 'Warning!',
    text: mess,
    icon: 'warning',
    confirmButtonText: 'OK'
  });
}

// Error alert
function showErrorAlert(mess) {
  Swal.fire({
    title: 'Error!',
    text: mess,
    icon: 'error',
    confirmButtonText: 'Close'
  });
}

function callEmailActivation(){

	$('#btn-activation-email').on('click', function(){

		showInfoAlert("Activation terkirim via email!");
		let formStaff = $('#modal-activation').find('form');
		let idna = formStaff.find('#staff-activation-id').val();
		let tokena = formStaff.find('#staff-activation-token').val();
		let viana = 'email';

		let datana = {id: idna, public_token: tokena, via: viana};

		$.ajax({
            url: URL_MAIN_PORTAL + '/staff/activate',
            type: 'POST',             // Metode POST
            data: datana,
            success: function(response) {
                console.log('Response:', response); // Lihat response dari server di console

                // Cek status dari server
                if(response.status === 'success') {
                    showInfoAlert('Check email untuk aktifasinya!');
                } else {
                    showErrorAlert('Gagal aktifasi');
                }
            },
            error: function(xhr, status, error) {
                // Jika AJAX gagal
				showErrorAlert('Gagal aktifasi');
                console.error('AJAX Error:', error);
            }
        }); // ←—— ⬅️ AKHIR DARI AJAX $.ajax


	});

}

function tutupModal(idna){
	const modalEl = document.getElementById(idna);
	const modal = bootstrap.Modal.getInstance(modalEl);
	if (modal) modal.hide();
}

function bukaModal(idna){
 const modal = new bootstrap.Modal(document.getElementById(idna));
modal.show();

}

function displayUserActivation(){

	$('#btn-activate-staff').on('click', function(){

		let checkedBoxes = $('#table-staff .checkbox-staff-selection:checked');

		if (checkedBoxes.length === 0) {
			showInfoAlert('Pilih (centang) dulu datanya!');

			return;
		}

		$('#table-staff .checkbox-staff-selection:checked').each(function() {
			const staffId = $(this).attr('data-id');
			const token = $(this).attr('data-token');
			
			bukaModal('modal-loading');

			setTimeout(function(){
				hideModalByID('#modal-loading');
	
				activateOptionStaff(staffId, token);
			}, 2000);

		});

	});


}