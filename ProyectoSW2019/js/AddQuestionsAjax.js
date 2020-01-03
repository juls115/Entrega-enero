
$("document").ready(function(){

  $("#subm").click(function(){

    $("#response").html("");
    var request_url = $("#fquestion").attr("action"); //get form action url
	  var request_method = $("#fquestion").attr("method"); //get form GET/POST method
    var enct = $("#fquestion").attr("enctype");
    var form_data = new FormData($("#fquestion").get(0));

    $.ajax({
      url : request_url,
      type : request_method,
      data : form_data,
      encType : enct,
      contentType : false,
      cache: false,
      dataType : 'HTML',
      processData : false,
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
        $('#response').empty().append($('<div/>').append(response).children().find('div.response'));
        retrieveXML();
    }).fail(function() {
      alert( "Ha ocurrido un error inesperado al contactar con el servidor");
    });
  });

});
