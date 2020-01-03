
function validateEmail(){
  var email = $("#email").val();
  var form_data = new FormData();

  $.ajax({
    url : "../php/ClientVerifyEnrollmentAjax.php",
    type : 'post',
    data : { emailData : email },
    cache: false
  }).done(function(response){
    $("#emailWService").html(response);
  });

}

function validatePassword(){
  var pass = $("#pass").val();

  $.ajax({
    url : "../php/ClientVerifyPassAjax.php",
    type : 'post',
    data : {passwordData : pass},
    cache: false,
  }).done(function(response){
    $("#passWService").html(response);
  });
}

$("document").ready(function() {
  $("#email").on("focusout keyup", function() {
    validateEmail();
  });
  $("#pass").on("focusout keyup", function() {
    validatePassword();
  });
});
