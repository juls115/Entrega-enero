/*
function isImage(file){
   return file['type'].split('/')[0]=='image';
 }

function validate(){
  var email = $("#email");
  var expAlumnos = /^[a-z]{2,}[0-9]{3}@ikasle\.ehu\.(eus|es)$/;
  var expProfesores = /([a-z]+\.)?[a-z]+@ehu\.(eus|es)$/;
  var isValid = true;

  if(document.getElementById("im").files[0] && !isImage(document.getElementById("im").files[0])){
    isValid = false;
  }

  return isValid;
}*/

$("document").ready(function(){

  $("#reset").click(function(){
    //$("#email").val("");
    $("#qst").val("");
    $("#correct").val("");
    $("#error1").val("");
    $("#error2").val("");
    $("#error3").val("");
    $("#complexity").val("");
    $("#topic").val("");
    $("#im").val("");
    $("#sim").html("");   
  })

/*
  $("#mailtype").change(function(){
    var expAlumnos = "^[a-z]{2,}[0-9]{3}@ikasle\\.ehu\\.(eus|es)$";
    var expProfesores = "([a-z]+\\.)?[a-z]+@ehu\\.(eus|es)$";
    if ($("#mailtype").val() == 1){
      $("#email").attr("pattern", expProfesores);
    } else {
      $("#email").attr("pattern", expAlumnos);
    }
  })

  $("#mailtype").val(1);*/
})
