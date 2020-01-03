
function updateCounter(){
  $.ajax({
    url : "../xml/Counter.xml",
    type : "get",
    contentType : false,
    cache: false
  }).done(function(response){
      var connectedUsers = $(response).find('counter')[0].childNodes[0].nodeValue;
      $("#connUsers").html("Usuarios conectados a la aplicación: " + connectedUsers);
    }).fail(function() {
    alert( "Ha ocurrido un error inesperado al contactar con el servidor");
  });
}

updateCounter();
setInterval(updateCounter, 7000);
