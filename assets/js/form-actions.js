var mainURL = "http://absensi.fgroupindonesia.com";

$(document).ready(function(){

	// when link link-save-staff clicked
	$('#link-save-staff').click(function(){

		let dataForm = $('#staff-form').serialize();
		//alert(dataForm);
		addStaff(dataForm);


	});

// when btn-activation-whatsapp clicked
$('#btn-activation-whatsapp').click(function(){

		let tokenNa = $('#staff-activation-token').val();
		let waNa = $('#staff-activation-whatsapp').val();

		sendingWAActivation(waNa, tokenNa);

}); 


// when link link-activate-staff clicked
	$('.link-activate-staff').click(function(){

		let idNa = $(this).data('id');
		let tokenNa = $(this).data('token');

		//show the form after 3 secs
		setTimeout(function(){
			hideModalByID('#modal-loading');

			activateOptionStaff(idNa, tokenNa);
		}, 3000);
		

	}); 

	// when link link-edit-staff clicked
	$('.link-edit-staff').click(function(){

		let idNa = $(this).data('id');
		let tokenNa = $(this).data('token');

		//show the form after 3 secs
		setTimeout(function(){
			hideModalByID('#modal-loading');

			editStaff(idNa, tokenNa);
		}, 3000);
		

	}); 

	// when link link-delete-staff clicked
	$('.link-delete-staff').click(function(){

		let idNa = $(this).data('id');
		let tokenNa = $(this).data('token');

		//show the form after 3 secs
		setTimeout(function(){
			hideModalByID('#modal-loading');

			deleteStaff(idNa, tokenNa);
		}, 3000);
		

	});

	// when entry limit is entered
	$('#entry_limit').keyup(function(e){

		if(e.keyCode == 13){
			resubmitManagementStaff();
		}

	});

});

function hideModalByID(anID){
	let modalName = anID;

	if(!anID.includes('#')){
		modalName = '#' + anID;
	}

	//console.log(modalName);

	$(modalName).find('button').click();

			//$(modalName).removeClass('show');			
			//$(modalName).removeAttr('aria-modal');
			//$(modalName).attr('aria-hidden', 'true');
			//$(modalName).hide();

			//$('.modal-backdrop').remove();
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

	showModalByButtonID('#btn-add-staff');
	
	// ensure the string is in json format
	dataJSON = JSON.parse(dataJSON);

	$('#staff-id').val(idMasuk);
	
	$('#staff-token').val(tokenMasuk);
	$('#staff-title').text("Edit Staff");

	$('#staff-notes').text(dataJSON.notes);
	$('#staff-whatsapp').val(dataJSON.whatsapp);
	$('#staff-email').val(dataJSON.email);

	$('#staff-number_ic').val(dataJSON.number_ic);
	$('#staff-unit_division').val(dataJSON.unit_division);
	$('#staff-name').val(dataJSON.name);

	if(dataJSON.status == 'aktif'){
		$('#staff-status_aktif').attr('checked');
	}else{
		$('#staff-status_non_aktif').attr('checked');
	}

	$('#link-save-staff').text('Update Staff Data');
	
	// trigger the button clicked
	$('#btn-add-staff').click();

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

function displayActivationForm(idMasuk, tokenMasuk, dataJSON){
	// changing state
	let formStaff = $('#modal-activation').find('form');
	formStaff.attr('action', '/staff/activate');
	formStaff.attr('data-id', idMasuk);

	showModalByButtonID('#btn-activate-staff');
	
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
	$('#btn-activate-staff').click();

}

function editStaff(idMasuk, tokenMasuk){

	let dataForm = {id: idMasuk, public_token:tokenMasuk};

	// after timeout render into the edit form
	let urlNa = mainURL + "/staff/edit";
	
		// ajax post started
		 $.ajax({
		      url: urlNa, 
		      type: "POST",
		      data: dataForm,
		      success: function(response) {
		        
		        //refreshMe();
		        console.log(response);

		        // show after 2 secs
		        setTimeout(function(){
		        	displayStaffForm(idMasuk, tokenMasuk, response);
		        }, 3000);
		        

		      },
		      error: function(jqXHR, textStatus, errorThrown) {
		      		console.log('ERROR', textStatus, errorThrown);
		      		console.log(jqXHR.responseText);
		      		
		      }
		 }); // ajax post ended


}

function activateOptionStaff(idMasuk, tokenMasuk){

	let dataForm = {id: idMasuk, public_token:tokenMasuk};

	// after timeout render into the edit form
	let urlNa = mainURL + "/staff/edit";
	
		// ajax post started
		 $.ajax({
		      url: urlNa, 
		      type: "POST",
		      data: dataForm,
		      success: function(response) {
		        
		      	//console.log('kirim ' + JSON.stringify(dataForm));

		        //refreshMe();
		        console.log(response);

		        // show after 2 secs
		        setTimeout(function(){
		        	displayActivationForm(idMasuk, tokenMasuk, response);
		        }, 3000);
		        

		      },
		      error: function(jqXHR, textStatus, errorThrown) {
		      		console.log('ERROR', textStatus, errorThrown);
		      		console.log(jqXHR.responseText);
		      		
		      }
		 }); // ajax post ended


}

function deleteStaff(idMasuk, tokenMasuk){

	let dataForm = {id: idMasuk, public_token:tokenMasuk};

	// after timeout render into the edit form
	let urlNa = mainURL + "/staff/delete";
	
		// ajax post started
		 $.ajax({
		      url: urlNa, 
		      type: "POST",
		      data: dataForm,
		      success: function(response) {
		        
		        refreshMe();
		       
		      },
		      error: function(jqXHR, textStatus, errorThrown) {
		      		console.log('ERROR', textStatus, errorThrown);
		      		console.log(jqXHR.responseText);
		      		
		      }
		 }); // ajax post ended


}

function resubmitManagementStaff(){
	let limitNumber = $('#entry_limit').val();
	window.location = mainURL + "/portal/management-staff?entry_limit=" + limitNumber;

}	

function addStaff(dataForm){

	let endPoint = $('#staff-form').attr('action');

	//let urlNa = mainURL + "/staff/add";
	let urlNa = mainURL + endPoint;
	//alert('kirim ke ' + urlNa);
	//console.log('datana ' + dataForm);

	// ajax post started
		 $.ajax({
		      url: urlNa, 
		      type: "POST",
		      data: dataForm,
		      success: function(response) {
		        
		        refreshMe();

		      },
		      error: function(jqXHR, textStatus, errorThrown) {
		      		console.log('ERROR', textStatus, errorThrown);
		      		console.log(jqXHR.responseText);
		      		
		      }
		 }); // ajax post ended

}

function refreshMe(){
	setTimeout(function(){
		location.reload();
	}, 2000);
}