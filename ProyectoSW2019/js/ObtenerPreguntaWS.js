
function getQuestion(){
  var identificador = $("#identifier").val();

  $.ajax({
    url : "../php/ClientGetQuestion.php",
    type : 'post',
    data : { id : identificador },
    cache: false,
    xhr: function(){
      // Upload progress bar
      var xhr = $.ajaxSettings.xhr();
      if (xhr.upload) {
        xhr.upload.addEventListener('progress', function(event) {
          var percent = 0;
          var position = event.loaded || event.position;
          var total = event.total;
          if (event.lengthComputable) {
            percent = Math.ceil(position / total * 100);
          }
          //update progressbar
          $("#upload-progress .progress-bar").css("width", + percent +"%");}, true);
        }
        return xhr;
      }
  }).done(function(response){
    $("#qst").html(response);
  });

}

$("document").ready(function(){

  $("#subm").click(function(e){
    e.preventDefault();
    getQuestion();
  });

  $("#reset").click(function(e){
    $("#qst").html("");
  });

});
