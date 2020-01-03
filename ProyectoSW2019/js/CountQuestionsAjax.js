
function getNumberOfQuestions(){
  //alert("check");
  $.ajax({
    url : "../xml/Questions.xml",
    type : "get",
    contentType : false,
    cache: false
  }).done(function(response){
      var author = $("#email").val();
      var questions = $(response).find('assessmentItems').children();
      var userQuestions = 0;
      for(i = 0; i < questions.length; i++){
        if (author == $(questions[i]).attr("author")) userQuestions++;
      }
      $("#usertotal").html("Mis preguntas/Todas las preguntas: " + userQuestions + "/" + questions.length + " ");
    }).fail(function() {
    alert( "Ha ocurrido un error inesperado al contactar con el servidor");
  });
}

getNumberOfQuestions();
setInterval(getNumberOfQuestions, 7000);
