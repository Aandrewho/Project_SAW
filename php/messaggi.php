<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Messaggi</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
    </head>

    <body>
        
        <div class="msg-tot">
        	<div class="msg-titolo">
                <h1>MESSAGGI</h1>
            </div>
            
            <!-- DIV complessivo-->
            <div class="msg-format">
            	
                <!-- DIV fisso descrizione campi-->
                <div class="msg-base">
                	<table>
                    	<tr>
    						<th class="tg-9hbo">MITTENTE</th>
    						<th class="tg-9hbo">OGGETTO</th>
    						<th class="tg-9hbo">DATA</th>
  						</tr>
  						<tr>
						    <td class="tg-yw4l"></td>
						    <td class="tg-yw4l"></td>
						    <td class="tg-yw4l"></td>
						</tr>
					</table>
                </div>
                
                
            </div>
        </div>               
    </body>
</html>