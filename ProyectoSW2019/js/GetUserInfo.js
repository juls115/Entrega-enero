
$("document").ready(function(){

    $("#rUser").click(function(){
      $("#username").val("");
      $("#surname").val("");
      $("#phone").val("");
      $("#sEmail").html("");
      $.get('../xml/Users.xml', function(d){
        var usuarios = $(d).find("usuario");
        var email = $("#email").val();
        var i = 0;
        var found = false;
        while(i<usuarios.length && !found){
          if ($(usuarios[i]).find("email")[0].childNodes[0].nodeValue == email){
            found = true;
            $("#username").val($(usuarios[i]).find("nombre")[0].childNodes[0].nodeValue);
            $("#surname").val($(usuarios[i]).find("apellido1")[0].childNodes[0].nodeValue + " " + $(usuarios[i]).find("apellido2")[0].childNodes[0].nodeValue);
            $("#phone").val($(usuarios[i]).find("telefono")[0].childNodes[0].nodeValue);
          }
          i++;
        }
        if(!found){
          alert("No se ha encontrado ningun usuario registrado con este email");
          $("#sEmail").html("No se ha encontrado ningun usuario registrado con este email");
        }
      });

    });

})
