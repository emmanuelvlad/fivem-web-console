<?php require "./config.php"; ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
  	<meta charset="UTF-8">
  	<title>GTA V - Console</title>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<link rel="stylesheet" href="main.css">
  	<script>
      $(document).ready(function() {
        var firstLoad = 1

         function loadLogs(){
           var bottom = $('#content').prop('scrollHeight')
           $.get({
             url: "<?php echo $log_file; ?>",
             cache: false
           }).then(function(data) {
             var heightAfter = $('#content').scrollTop() + $('#content').height()
             var split = data.replace(/\n/g, "<br />")
             $('#content').html(split);
             if (firstLoad || bottom === heightAfter){
               $("#content").animate({ scrollTop: $('#content').prop('scrollHeight') }, 0);
               firstLoad = 0
             }
             setTimeout(loadLogs, 1000);
           });
         }
         setTimeout(loadLogs, 10);

         $('#rcon').keyup(function(e) {
           if (e.keyCode === 13) {
             var command = $('#rcon').val()
             $('#rcon').val('')
             $.post("process.php", { data: command }, function(data) {})
           }
         })
      })
    </script>
  </head>

  <body>
    <h1>FiveM Web Console</h1>

    <!-- Console stuff -->
    <console>
      <div id="content"></div>
      <div id="input">
          <input id="rcon" type="text" placeholder="rcon ...">
      </div>
    </console>
    <!-- /Console stuff -->

    <p>made with ♥ by <a href="http://emmanuelvlad.com/" style="text-decoration:none;">eVlad</a></p>
  </body>
</html>
