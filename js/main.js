$(function() {

  var firstLoad = 1

   function functionToLoadFile(){
     var bottom = $('#content').prop('scrollHeight')
     $.get({
       url: "output.txt",
       cache: false
     }).then(function(data) {
       var heightAfter = $('#content').scrollTop() + $('#content').height()
       var split = data.replace(/\n/g, "<br />")
       $('#content').html(split);
       if (firstLoad || bottom === heightAfter){
         $("#content").animate({ scrollTop: $('#content').prop('scrollHeight') }, 0);
         firstLoad = 0
       }
       setTimeout(functionToLoadFile, 1000);
     });
   }
   setTimeout(functionToLoadFile, 10);

   $('#rcon').keyup(function(e) {
     if (e.keyCode === 13) {
       var command = $('#rcon').val()
       $('#rcon').val('')
       $.post("process.php", { data: command }, function(data) {})
     }
   })

})
