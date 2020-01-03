
var modal = document.getElementById("myModal");
var captionText = document.getElementById("caption");

function clickImage(imagen_src, imagen_topic){
  modal.style.display = "block";
  // URL_image_directory must be specified as a global variable
  var URL_image = URL_image_directory + imagen_src;
  $("#imagen_zoom1").attr("src", URL_image);
  captionText.innerHTML = imagen_topic;
}

function forceDownload(url){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.responseType = "blob";
    xhr.onload = function(){
        var urlCreator = window.URL || window.webkitURL;
        var imageUrl = urlCreator.createObjectURL(this.response);
        var tag = document.createElement('a');
        tag.href = imageUrl;
        tag.download = "imagen.jpg";
        document.body.appendChild(tag);
        tag.click();
        document.body.removeChild(tag);
    }
    xhr.send();
}

function clickImageSearch(imagen_src){
  modal.style.display = "block";
  // URL_image_directory must be specified as a global variable
  var URL_image = imagen_src;
  $("#imagen_zoom1").attr("src", URL_image);
  captionText.innerHTML = "<button onclick='forceDownload(" + '"' + imagen_src + '"' + ")'>Download</button>";
}

var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
  modal.style.display = "none";
}
