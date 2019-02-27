<?php
		
	//richiama il file php per connettersi al server
	include ("connessione.php");
	
	//Con questa funzione posso acquisire i parametri di sessione ($id)
	session_start();
	$id = $_SESSION['Id'];
	$data = $_SESSION['data'];
	$luogo = $_SESSION['luogo'];
	$descrizione = $_SESSION['descrizione'];
	$link = $_SESSION['link'];
	
	if (!empty($_POST["data"]))	{
		$data = mysqli_real_escape_string($con, $_POST['data']);
	}
			
	if (!empty($_POST["luogo"]))	{
		$luogo = mysqli_real_escape_string($con, $_POST['luogo']);
	}
	
	if (!empty($_POST["descrizione"]))	{
		$descrizione = mysqli_real_escape_string($con, $_POST['descrizione']);
	}
	
	if (!empty($_POST["link"]))	{
		$link = mysqli_real_escape_string($con, $_POST['link']);
	}
	
	$toinsert = ("UPDATE Users SET data = '".$data."', luogo = '".$luogo."', descrizione = '".$descrizione."', link = '".$link."' WHERE Id = '$id'");
	$result = mysqli_query($con, $toinsert);
	
    header("Location:../php/pagriservata.php");
?>