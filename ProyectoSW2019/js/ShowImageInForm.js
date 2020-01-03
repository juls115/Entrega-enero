
function isImage(file){
   return file['type'].split('/')[0]=='image';
 }

$("document").ready(function(){
  $("#im").val("");
  $("#im").change(function(){
    $("#sim").html("");
    if (this.files[0] && isImage(this.files[0])) {
    	var reader = new FileReader();
    	reader.onload = function (e) {
        var image = document.createElement("IMG");
        image.setAttribute("src", e.target.result);
        image.setAttribute("style", "max-height:200px;max-width:500px;height:auto;width:auto;")
    		$("#sim").append(image);
    	}
    	reader.readAsDataURL(this.files[0]);
    } else {
      //$("#sim").html("El archivo subido no es una imagen");
    }
  });
})
