function countChars(obj){
      var maxLength = 3000;
      var strLength = obj.value.length;
      var charRemain = (maxLength - strLength);
      if(charRemain < 0){
        document.getElementById("charNum").innerHTML = '<span style="color: red;">You have exceeded the limit of '+maxLength+' characters</span>';
        document.getElementById("saveContent").disabled = true;
      }else{
        document.getElementById("charNum").innerHTML = charRemain+' characters remaining';
        document.getElementById("saveAstrologer").disabled = false;
      }
    }

$('#add-astrologer-modal .close, #add-astrologer-modal #cancelSaveAstrologer').on('click', function(){
  $('.errorMsg').html('');
  var userPlaceholderImage = window.location.hostname+"/public/assets/images/id_placeholder.jpg";
  $('#new_astro_profile_image').attr('src', userPlaceholderImage);
  $('#add_astrologer #full_name').val('');
  $('#add_astrologer #phone_number').val('');
  $('#add_astrologer #dob').val('');
  $('#add_astrologer #gender').val('M').change();
  $('#add_astrologer #email_id').val('');
  $('#add_astrologer #address1').val('');
  $('#add_astrologer #address2').val('');
  $('#add_astrologer #city').val('');
  $('#add_astrologer #state').val('');
  $('#add_astrologer #country').val('');
  $('#add_astrologer #zip_code').val('');
  $('#certificate').tagsinput('removeAll');
  $("#expertise").val('').change();
  $("#language").val('').change();
  $('#experience').val(10);
  $('#aadhar_number').val('');
  $('#pan_no').val('');
  $('#none').click();
  $('#hidden_new_id_image1').val('');
  $('#hidden_new_id_image2').val('');
  $('#biography').val('');
  $('#bank_account_holder').val('');
  $('#bank_account_type').val('').change();
  $('#bank_account_number').val('');
  $('#ifsc_code').val('');
  $('#call_rate_inr').val('10.00');
  $('#call_rate_usd').val('0.50');
  $('#call_discount').val('0');
  $('#chat_rate_inr').val('10.00');
  $('#chat_rate_usd').val('0.50');
  $('#chat_discount').val('0');

});

$('#idProofContainer').css('display','none');
$('#aadhar_card, #votor_id, #driving_license, #pan_card').on('click',function(){
  $('#idProofContainer').css('display','block');
  $('#hidden_add_idfiles').val(1);
});
$('#none').on('click',function(){
  $('#idProofContainer').css('display','none');
  $('#hidden_add_idfiles').val(0);
  $('#hidden_new_id_image1').val('');
  $('#hidden_new_id_image2').val('');
  $('#new_astro_id_image1').attr('src', '');
  $('#new_astro_id_image2').attr('src', '');
  $('#file_error').text('');
  $('#saveAstrologer').attr('disabled', false);
});


//Add astrologer form validation starts
$('#hidden_astro_pic').change(function(){
  if($('#hidden_astro_pic').val().trim() != ''){
    $('#error_astro_profile').text('');
    $('#saveAstrologer').attr('disabled', false);
  }
});
$('#full_name').on('keypress blur', function(){
  if($('#full_name').val().trim() != ''){
    $('#error_full_name').text('');
    $('#saveAstrologer').attr('disabled', false);
  }
});
$('#city').on('keypress blur', function(){
  if($('#city').val().trim() != ''){
    $('#error_city').text('');
    $('#saveAstrologer').attr('disabled', false);
  }
});
$('#experience').on('keypress blur change', function(){
  if($('#experience').val().trim() != ''){
    $('#error_experience').text('');
    $('#saveAstrologer').attr('disabled', false);
  }
});

$('#biography').on('keypress blur', function(){
  if($('#biography').val().trim() != ''){
    $('#error_biography').text('');
    $('#saveAstrologer').attr('disabled', false);
  }
});
$('#call_rate_inr').on('keypress blur change', function(){
  if($('#call_rate_inr').val().trim() != ''){
    $('#error_call_rate_inr').text('');
    $('#saveAstrologer').attr('disabled', false);
  }
});
$('#call_rate_usd').on('keypress blur change', function(){
  if($('#call_rate_usd').val().trim() != ''){
    $('#error_call_rate_usd').text('');
    $('#saveAstrologer').attr('disabled', false);
  }
});
$('#chat_rate_inr').on('keypress blur change', function(){
  if($('#chat_rate_inr').val().trim() != ''){
    $('#error_chat_rate_inr').text('');
    $('#saveAstrologer').attr('disabled', false);
  }
});
$('#chat_rate_usd').on('keypress blur change', function(){
  if($('#chat_rate_usd').val().trim() != ''){
    $('#error_chat_rate_usd').text('');
    $('#saveAstrologer').attr('disabled', false);
  }
});




$(document).ready(function(event) {
  $('#hidden_country').val('India');
  
  //Add astrologer validation on button click
	$('#saveAstrologer').on('click', function(){
    var idImage1 = $('#new_astro_id_image1').attr('src');
    image1 = idImage1.substr(idImage1.length-18);
    var idImage2 = $('#new_astro_id_image2').attr('src');
    image2 = idImage2.substr(idImage2.length-18);
    /*var telInput = $("#phone_number"),
    errorMsg = $("#error-msg"),
    validMsg = $("#valid-msg");
    // initialise plugin
    telInput.intlTelInput({
      separateDialCode:true,
      utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
    });

    if ($.trim(telInput.val())) {
        if (telInput.intlTelInput("isValidNumber")) {

        validMsg.removeClass("hide");
        var data = $("#phone_number").intlTelInput("getSelectedCountryData");
        $('#country_code').val(data.iso2);
        $('#country_dial_code').val(data.dialCode);
        $('#error_phone_number').text('');

        var phone_number = $(this).val();
        var data = $("#phone_number").intlTelInput("getSelectedCountryData");
        var dialCode = data.dialCode;
        phone_number = dialCode+phone_number;
        isExistAstrologerPhone(phone_number);


        }else{
          $('#error_phone_number').text('Please enter valid number.');
        }
    }*/

    
    if($('#hidden_astro_pic').val().trim() == ''){
      $('#error_astro_profile').focus();
      $('#error_astro_profile').text('Please upload profile image');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }else if($('#full_name').val().trim() == ''){
      $('#full_name').focus();
      $('#error_full_name').text('Please enter full name');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }else if($('#phone_number').val().trim() == ''){
      $('#phone_number').focus();
      $('#error_phone_number').text('Please enter phone number');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#experience').val().trim() == ''){
      $('#experience').focus();
      $('#error_experience').text('Please enter experience');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#city').val().trim() == ''){
      $('#city').focus();
      $('#error_city').text('Please enter city name');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#hidden_country').val().trim() == ''){
      $('#country').focus();
      $('#error_country').text('Please select country name');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#hidden_expertise_check').val().trim() != 1){
      $('#error_expertise').focus();
      $('#error_expertise').text('Please select expertise.');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#hidden_language_check').val().trim() != 1){
      $('#error_language').focus();
      $('#error_language').text('Please select language.');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#hidden_add_idfiles').val() == 1 && image1 == 'id_placeholder.jpg' && image2 == 'id_placeholder.jpg'){
      $('#file_error').text('Please upload id proof.');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#biography').val().trim() == ''){
      $('#biography').focus();
      $('#error_biography').text('Please enter biography');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#call_rate_inr').val().trim() == ''){
      $('#call_rate_inr').focus();
      $('#error_call_rate_inr').text('Please enter call rate (in INR)');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#call_rate_inr').val().trim() < 0){
      $('#call_rate_inr').focus();
      $('#error_call_rate_inr').text('Call rate can not be less than 0');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#call_rate_inr').val().trim() >= 9999.99){
      $('#call_rate_inr').focus();
      $('#error_call_rate_inr').text('Call rate must be less than or equal to INR 9999.99');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#call_rate_usd').val().trim() == ''){
      $('#call_rate_usd').focus();
      $('#error_call_rate_usd').text('Please enter call rate (in USD)');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#call_rate_usd').val().trim() < 0){
      $('#call_rate_usd').focus();
      $('#error_call_rate_usd').text('Call rate can not be less than 0');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#call_rate_usd').val().trim() > 9999.99){
      $('#call_rate_usd').focus();
      $('#error_call_rate_usd').text('Call rate must be less than or equal to USD 9999.99');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#chat_rate_inr').val().trim() == ''){
      $('#chat_rate_inr').focus();
      $('#error_chat_rate_inr').text('Please enter chat rate (in INR)');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#chat_rate_inr').val().trim() < 0){
      $('#chat_rate_inr').focus();
      $('#error_chat_rate_inr').text('Chat rate can not be less than 0');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#chat_rate_inr').val().trim() > 9999.99){
      $('#chat_rate_inr').focus();
      $('#error_chat_rate_inr').text('Chat rate must be less than or equal to INR 9999.99');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#chat_rate_usd').val().trim() == ''){
      $('#chat_rate_inr').focus();
      $('#error_chat_rate_usd').text('Please enter chat rate (in USD)');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#chat_rate_usd').val().trim() < 0){
      $('#chat_rate_usd').focus();
      $('#error_chat_rate_usd').text('Chat rate can not be less than 0');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#chat_rate_usd').val().trim() > 9999.99){
      $('#chat_rate_usd').focus();
      $('#error_chat_rate_usd').text('Chat rate must be less than or equal to USD 9999.99');
      $('#saveAstrologer').attr('disabled', true);
      return false;
    }else{
      $('#saveAstrologer').attr('disabled', false);
      $('#add_astrologer').submit();
    }
  });


  //Edit astrologer validation on button click
  $('#editAstrologer').on('click', function(){
    var idImage1 = $('#edit_new_astro_id_image1').attr('src');
    image1 = idImage1.substr(idImage1.length-18);
    var idImage2 = $('#edit_new_astro_id_image2').attr('src');
    image2 = idImage2.substr(idImage2.length-18);

    var telInput = $("#edit_phone_number"),
    errorMsg = $("#error-msg"),
    validMsg = $("#valid-msg");
    // initialise plugin
    telInput.intlTelInput({
      separateDialCode:true,
      utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
    });

    if ($.trim(telInput.val())) {
        if (telInput.intlTelInput("isValidNumber")) {
        validMsg.removeClass("hide");
        $('#edit-phone-error').text('');
        $('#editAstrologer').attr('disabled', false);
        var data = $("#edit_phone_number").intlTelInput("getSelectedCountryData");
        //console.log(data);
        $('#edit_country_code').val(data.iso2);;
        $('#edit_country_dial_code').val(data.dialCode);

        var phone_number = $(this).val();
        var dialCode = data.dialCode;
        phone_number = dialCode+phone_number;
        isExistAstrologerPhone(phone_number);
    }else{
        $('#edit-phone-error').text('Please enter valid number.');
        $('#editAstrologer').attr('disabled', true);
        return false;
    }
    }

    
    if($('#edit_full_name').val().trim() == ''){
      $('#edit_full_name').focus();
      $('#error_edit_full_name').text('Please enter full name');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }else if($('#edit_phone_number').val().trim() == ''){
      $('#edit_phone_number').focus();
      $('#edit-phone-error').text('Please enter phone number');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#editExperience').val().trim() == ''){
      $('#editExperience').focus();
      $('#error_editExperience').text('Please enter experience');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_city').val().trim() == ''){
      $('#edit_city').focus();
      $('#error_edit_city').text('Please enter city name');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_hidden_country').val().trim() == ''){
      $('#edit_country').focus();
      $('#error_edit_country').text('Please select country name');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#hidden_edit_expertise_check').val().trim() != 1){
      $('#error_edit_expertise').focus();
      $('#error_edit_expertise').text('Please select expertise.');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#hidden_edit_language_check').val().trim() != 1){
      $('#error_edit_language').focus();
      $('#error_edit_language').text('Please select language.');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#hidden_edit_idfiles').val() == 1 && image1 == 'id_placeholder.jpg' && image2 == 'id_placeholder.jpg'){
          $('#edit_file_error').text('Please upload id proof.');
          $('#editAstrologer').attr('disabled', true);
          return false;
    }
    else if($('#edit_biography').val().trim() == ''){
      $('#edit_biography').focus();
      $('#error_edit_biography').text('Please enter biography');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_call_rate_inr').val().trim() == ''){
      $('#edit_call_rate_inr').focus();
      $('#error_edit_call_rate_inr').text('Please enter call rate (in INR)');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_call_rate_inr').val().trim() < 0){
      $('#edit_call_rate_inr').focus();
      $('#error_edit_call_rate_inr').text('Call rate can not be less than 0');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_call_rate_inr').val().trim() >= 9999.99){
      $('#edit_call_rate_inr').focus();
      $('#error_edit_call_rate_inr').text('Call rate must be less than or equal to INR 9999.99');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_call_rate_usd').val().trim() == ''){
      $('#edit_call_rate_usd').focus();
      $('#error_edit_call_rate_usd').text('Please enter call rate (in USD)');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_call_rate_usd').val().trim() < 0){
      $('#edit_call_rate_usd').focus();
      $('#error_edit_call_rate_usd').text('Call rate can not be less than 0');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_call_rate_usd').val().trim() > 9999.99){
      $('#edit_call_rate_usd').focus();
      $('#error_edit_call_rate_usd').text('Call rate must be less than or equal to USD 9999.99');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_chat_rate_inr').val().trim() == ''){
      $('#edit_chat_rate_inr').focus();
      $('#error_edit_chat_rate_inr').text('Please enter chat rate (in INR)');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_chat_rate_inr').val().trim() < 0){
      $('#edit_chat_rate_inr').focus();
      $('#error_edit_chat_rate_inr').text('Chat rate can not be less than 0');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_chat_rate_inr').val().trim() > 9999.99){
      $('#edit_chat_rate_inr').focus();
      $('#edit_error_chat_rate_inr').text('Chat rate must be less than or equal to INR 9999.99');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_chat_rate_usd').val().trim() == ''){
      $('#edit_chat_rate_usd').focus();
      $('#error_edit_chat_rate_usd').text('Please enter chat rate (in USD)');
      $('#edit_Astrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_chat_rate_usd').val().trim() < 0){
      $('#edit_chat_rate_usd').focus();
      $('#error_edit_chat_rate_usd').text('Chat rate can not be less than 0');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else if($('#edit_chat_rate_usd').val().trim() > 9999.99){
      $('#edit_chat_rate_usd').focus();
      $('#error_edit_chat_rate_usd').text('Chat rate must be less than or equal to USD 9999.99');
      $('#editAstrologer').attr('disabled', true);
      return false;
    }
    else{
      $('#editAstrologer').attr('disabled', false);
      $('#edit_astrologer').submit();
    }
  });
});