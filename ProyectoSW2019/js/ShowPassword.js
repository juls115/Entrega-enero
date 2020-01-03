
$("document").ready(function(){

  $("#cpass1").click(function(){
    var tipo = ""
    if ($("#pass").attr("type") == "password"){
      tipo = "text";
    } else if ($("#pass").attr("type") == "text"){
      tipo = "password";
    }
    $("#pass").attr("type", tipo);
  });
  
  $("#cpass2").click(function(){
    var tipo = ""
    if ($("#pass2").attr("type") == "password"){
      tipo = "text";
    } else if ($("#pass2").attr("type") == "text"){
      tipo = "password";
    }
    $("#pass2").attr("type", tipo);
  });

});
