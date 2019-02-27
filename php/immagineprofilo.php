<?php
	//richiama il file php per connettersi al server
	include ("connessione.php");
	
	//Con questa funzione posso acquisire i parametri di sessione ($id)
	session_start();
	$id = $_SESSION['Id'];
	$uploadOk = 1;
	
	//Associo alla variabile locale il nome dell'immagine selezionata
	$name = $_FILES['nomefile']['name'];
	$tipo = pathinfo($name, PATHINFO_EXTENSION);
	
	if ($_FILES['nomefile']['size'] > 5000000) {
		echo "Dimensione massima consentita di 5MB";
		$uploadOk = 0;
	}
	
	// Allow certain file formats
	if($tipo != "jpg" && $tipo!= "png" && $tipo!= "jpeg" && $tipo!= "gif" ) {
		echo "Sono accettati solamente formati JPG, JPEG, PNG & GIF.";
		$uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Siamo spiacenti, l'immagine non è stata caricata.";
		// if everything is ok, try to upload file
	} else {
		//Carico l'immagine selezionata nella cartella pictureprof e la rinomino con l'id del account (no ridondanza)
		if (move_uploaded_file($_FILES['nomefile']['tmp_name'], "pictureprof/".$id)) {
			//Aggiorno il campo immagine nel DB
			$query = mysqli_query($con, "UPDATE Users SET immagine = '".$id."' WHERE Id = '$id'");  
			echo "Il file ". basename( $_FILES['nomefile']['name']). " è stato caricato.";
		} else {
				echo "C'è stato un errore durante il caricamento dell'immagine";
		}
	}
    
    header("Location:../php/pagriservata.php");
?>
                    