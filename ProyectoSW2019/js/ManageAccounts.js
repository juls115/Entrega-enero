
function changeState(){
  var json_change = '{ "usuarios" : [';
  var n_users = 0;
  document.querySelectorAll("input.userSelector:checked").forEach(f => {
    json_change += "\"" + f.value + "\",";
    n_users ++;
  });
  // Delete the last separator of the vector
  if (n_users > 0){
    json_change = json_change.slice(0, -1);
  }
  json_change += "]}";
  //document.getElementById("cont").innerHTML = json_change;
  if (n_users > 0){
    document.getElementById("chInput").value = json_change;
    if(confirm("¿Cambiar estado de la selección de usuarios?")){
      document.getElementById("chForm").submit();
    }
  } else {
    alert("Ningún usuario seleccionado");
  }
}

function deleteUser(){
  var json_change = '{ "usuarios" : [';
  var n_users = 0;
  document.querySelectorAll("input.userSelector:checked").forEach(f => {
    json_change += "\"" + f.value + "\",";
    n_users ++;
  });
  // Delete the last separator of the vector
  if (n_users > 0){
    json_change = json_change.slice(0, -1);
  }
  json_change += "]}";
  if (n_users > 0){
    document.getElementById("deInput").value = json_change;
    if (confirm("¿Borrar usuario(s) seleccionados?(Se elimina por completo al usuario)")){
      document.getElementById("deForm").submit();
    }
  } else {
    alert("Ningún usuario seleccionado");
  }
}

$("document").ready(function(){

  $("#stateButton").click(function(){
    changeState();
  });

  $("#deleteButton").click(function(){
    deleteUser();
  });

});
