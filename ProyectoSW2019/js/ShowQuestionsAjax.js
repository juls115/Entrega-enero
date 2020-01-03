
function generateTable(xml_file){
  var questions = $(xml_file).find('assessmentItem');
  var html_text = "<table id='data'><caption style='font-weight:bold;text-decoration: underline;' >Lista de preguntas</caption><thead><tr><th>Autor</th><th>Pregunta</th><th>R_correcta</th></tr></thead><tbody>";
  //alert(questions.length);
  for(i = 0; i < questions.length; i++){
    //alert($(questions[i]).attr("author"));
    //alert($(questions[i]).find("itemBody").find('p')[0].childNodes[0].nodeValue);
    //alert($(questions[i]).find("correctResponse").find('value')[0].childNodes[0].nodeValue);
    html_text += "<tr><td><span>";
    html_text += $(questions[i]).attr("author");
    html_text += "</span></td><td><span>";
    html_text += $(questions[i]).find("itemBody").find('p')[0].childNodes[0].nodeValue;
    html_text += "</span></td><td><span>";
    html_text += $(questions[i]).find("correctResponse").find('value')[0].childNodes[0].nodeValue;
    html_text += "</span></td></tr>";
  }
  html_text += "</tbody></table>";
  return html_text;
}

function retrieveXML(){

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //alert(this.responseText);
      $("#visl").html(this.responseText);
      navbar();
    }
  };
  xhttp.open("GET", "../php/ShowQuestionsAjax.php", true);
  xhttp.setRequestHeader('Cache-Control', 'no-cache');
  xhttp.send();
}

$("document").ready(function(){

  $("#watchQ").click(function(){
    $("#imvsl").html("");
    $("#imTable").html("");
    retrieveXML();
  });

});
