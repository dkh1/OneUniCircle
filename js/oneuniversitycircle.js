// Autoclear form field default values
jQuery(document).ready(function($) {
  $('.autoclear').focus(function(){
    $(this).removeClass('error');
    if ( this.value == this.defaultValue ) this.value = '';
  })
  $('.autoclear').blur(function(){
    if ( this.value == '' ) this.value = this.defaultValue;
  })

  var first_name = $('#mce-FNAME');
  var last_name = $('#mce-LNAME')
  var email_address = $('#mce-EMAIL');
  var phone_number = $('#mce-PHONEYUI_');

  // Validate form
  $('#mc-embedded-subscribe-form').submit(function(ev){
    if ( $(phone_number).val() != $(phone_number).prop('defaultValue') ) $(phone_number).val($(phone_number).val().replace(/[^0-9]/g,''));
    if ( $(phone_number).val() != $(phone_number).prop('defaultValue') ) $(phone_number).val($(phone_number).val().replace(/([0-9]{3})([0-9]{3})([0-9]{4})/,'$1-$2-$3'));
    if ( $(first_name).val().length < 3 || $(first_name).val() == $(first_name).prop('defaultValue') ) $(first_name).addClass('error'); else $(first_name).removeClass('error');
    if ( $(last_name).val().length < 3 || $(last_name).val() == $(last_name).prop('defaultValue') ) $(last_name).addClass('error'); else $(last_name).removeClass('error');
    if ( !$(phone_number).val().match(/^([0-9]{3})-([0-9]{3})-([0-9]{4})/) ) $(phone_number).addClass('error'); else $(phone_number).removeClass('error');
    if ( !$(email_address).val().match(/^[\w!#$%&\'*+\/=?`{|}~^-]+(?:\.[\w!#$%&\'*+\/=?`{|}~^-]+)*@(?:[A-Z0-9-]+\.)+[A-Z]{2,6}$/i) ) $(email_address).addClass('error'); else $(email_address).removeClass('error');

    if ( $('.error').length > 0 ) {
      ev.preventDefault();
      alert('All fields are required.');
    }
  })
});
