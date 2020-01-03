
var isValid = true;
var vacio = "Campo obligatorio vacio";
var email = $("#email");
var p = $("#qst");
var c = $("#correct");
var e1 = $("#error1");
var e2 = $("#error2");
var e3 = $("#error3");
var s = $("#complexity");
var t = $("#topic");
var i = $("#im");
isValid = true;
var expAlumnos = /^[a-z]{2,}[0-9]{3}@ikasle\.ehu\.(eus|es)$/;
var expProfesores = /([a-z]+\.)?[a-z]+@ehu\.(eus|es)$/;

function isImage(file){
   return file['type'].split('/')[0]=='image';
 }

 function emailValidation(){
   if (!email.val()){
     isValid = false;
     $("#sEmail").html(vacio);
   } else if (!(expAlumnos.test(email.val()) || expProfesores.test(email.val()))) {
     isValid = false;
     $("#sEmail").html("El formato del correo no es válido");
   } else {
     $("#sEmail").html("");
   }
 }

 function questionValidation(){
   if (!p.val()){
     isValid = false;
     $("#sqst").html(vacio);
   } else if (p.val().length < 10){
     isValid = false;
     $("#sqst").html("Longitud de la pregunta inferior a 10 caracteres");
   } else {
     $("#sqst").html("");
   }
 }

 function correctAnswerValidation(){
   if (!c.val()){
     isValid = false;
     $("#scorrect").html(vacio);
   } else {
     $("#scorrect").html("");
   }
 }

 function wrongFirstValidation(){
   if (!e1.val()){
     isValid = false;
     $("#serror1").html(vacio);
   } else {
     $("#serror1").html("");
   }
 }

 function wrongSecondValidation(){
   if (!e2.val()){
     isValid = false;
     $("#serror2").html(vacio);
   } else {
     $("#serror2").html("");
   }
 }

 function wrongThirdValidation(){
   if (!e3.val()){
     isValid = false;
     $("#serror3").html(vacio);
   } else {
     $("#serror3").html("");
   }
 }

 function complexityValidation(){
   if (!s.val()){
     isValid = false;
     $("#scomplexity").html(vacio);
   } else if (!(s.val()==1 || s.val()==2 || s.val()==3)) {
     isValid = false;
     $("#scomplexity").html("La complejidad tiene un valor inapropiado");
   } else {
     $("#scomplexity").html("");
   }
 }

 function topicValidation(){
   if (!t.val()){
     isValid = false;
     $("#stopic").html(vacio);
   } else {
     $("#stopic").html("");
   }
 }

 function imageCheck(){
   if(document.getElementById("im").files[0] && !isImage(document.getElementById("im").files[0])){
     isValid = false;
   }
 }

function validate(){
  isValid = true;

  emailValidation();
  questionValidation();
  correctAnswerValidation();
  wrongFirstValidation();
  wrongSecondValidation();
  wrongThirdValidation();
  complexityValidation();
  topicValidation();
  imageCheck();

  return isValid;
}

$("document").ready(function(){

  $("#fquestion").submit(function(){
    return validate();
  });

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
    validate();
  });

  $("#email").on("keyup change input", function(){
    emailValidation();
  });

  $("#qst").on("keyup change input", function(){
    questionValidation();
  });

  $("#correct").on("keyup change input", function(){
    correctAnswerValidation();
  });

  $("#error1").on("keyup change input", function(){
    wrongFirstValidation();
  });

  $("#error2").on("keyup change input", function(){
    wrongSecondValidation();
  });

  $("#error3").on("keyup change input", function(){
    wrongThirdValidation();
  });

  $("#complexity").change(function(){
    complexityValidation();
  });

  $("#topic").on("keyup change input", function(){
    topicValidation();
  });

})
