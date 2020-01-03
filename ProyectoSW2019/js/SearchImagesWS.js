
function visualizeSearchInput(){
  var search_input = "<label for='searchTag'>Inserta el tema de búsqueda: </label><input type='text' name='etiqueta' id='searchTag'><button type='button' id='sbutton' name='searchimage'>Buscar</button><div id='imageTable'></div><script>$('#sbutton').click(function(){retrieveJSON($('#searchTag').val());});</script>";
  $("#imvsl").html(search_input);
}

function retrieveJSON(tag){
  $.ajax({
    url : '../php/SearchImageJSON.php',
    type : 'post',
    data: { tag : tag },
    cache: false
  }).done(function(response){
    $("#imTable").html(response);
  });
}

$("document").ready(function(){

  $("#lim").click(function(){
    $("#response").html("");
    $("#visl").html("");
    visualizeSearchInput();
  });

});
