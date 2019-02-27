<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pagina riservata</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDipKv50SMB245Shn-hbvgRYfbY6YtlZQI&libraries=places&callback=initAutocomplete" async defer></script>
        <script src="../js/modifica.js"></script>
    </head>

    <body>
        <?php 
        	//richiama il file php per connettersi al server
        	include ("connessione.php"); 
        	
        	//Controllo se il login è stato effettuato
        	if(empty($_SESSION['Id'])){
        		echo "Pagina rieservata, esegui l'accesso per poterla visualizzare.";
        		exit();
        	}
        	
        	//Associo alla variabile locale il valore della variabile globale
        	$id = $_SESSION['Id'];
        		
        	//Query che ricerca per Id
        	$informazioniProfilo = mysqli_query($con, "SELECT * FROM Users WHERE Id = '$id'");
        	//Associo i valori presenti nel db a delle variabili locali
        	if (mysqli_num_rows($informazioniProfilo) > 0) {
        		while ($row = $informazioniProfilo->fetch_assoc()) {
        			$nome = $row['nome'];
        			$cognome = $row['cognome'];
        			$sesso = $row['sesso'];
        			$email = $row['email'];
        			$data = $row['data'];
        			$_SESSION['data'] = $data;
        			$luogo = $row['luogo'];
        			$_SESSION['luogo'] = $luogo;
        			$descrizione = $row['descrizione'];
        			$_SESSION['descrizione'] = $descrizione;
        			$link = $row['link'];
        			$_SESSION['link'] = $link;
        			//Se nessuna immagine è stata settata, viene impostata quella di default
        			if($row['immagine'] == "")	{
        				$immagine = "pictureprof/default.jpeg";
        			}
        			//Altrimenti viene concatenata la stringa per ottenere il path
        			else {
        				$immagine = "pictureprof/";
        				$immagine .= $row['immagine'];
        			}
        		}
        	}
        	
        	
        ?>
        <div class="prof-tot">
        	<div class="prof-titolo">
                <h1>IL MIO PROFILO</h1>
            </div>
            
            <!-- DIV complessivo-->
            <div class="prof-format">
            	
            	<!-- DIV Immagine di profilo-->
                <div class="prof-img">
                        <form  method="post" enctype="multipart/form-data" action="immagineprofilo.php">
                        	<?php print"<img src = '$immagine' height='300px' >";?>
                        	<br>
                            <input type="file" name="nomefile">
                            <input type= "submit" name="submit"> 
                        </form>                        
                </div>
                
                <!-- DIV Informazioni base del profilo-->
                <div class="prof-base">
                	<table>
                    	<tr>
                        	<th>Nome:</th><td><?=$nome;?></td> 
                      	</tr>
                      	
                      	<tr>
                        	<th>Cognome:</th><td><?=$cognome;?></td> 
                      	</tr>
                      	
                      	<tr>
                        	<th>Sesso:</th><td><?=$sesso;?></td> 
                      	</tr>
                      	
                      	<tr>
                        	<th>Email:</th><td><?=$email;?></td> 
                      	</tr>
					</table>
                </div>
                
                <!-- DIV Informazioni aggiuntive del profilo-->
                <div class="prof-agg">
                	<form id = "modifica" method = "post" action="modificaprofilo.php">
                		<table>
                      		<tr>
                        		<th>Data di nascita:</th><td id="data"><?=$data;?></td> 
                      		</tr>
                      		
                      		<tr>
                        		<th>Luogo di Nascita:</th><td id="luogo"><?=$luogo;?></td> 
                      		</tr>
                      		
                      		<tr>
                        		<th>Descrizione:</th><td id="descrizione"><?=$descrizione;?></td> 
                      		</tr>
                      		
                      		<tr>
                        		<th>Link:</th><td id="link"><a href = <?=$link;?>><?=$link;?></a> </td> 
                      		</tr>
                    	</table>
                    	
                    	<input id="tasto" type="reset" name="button" onclick="myFunction();" value="MODIFICA"/>
                    </form>                   
                </div>
            </div>
        </div>               
    </body>
</html>