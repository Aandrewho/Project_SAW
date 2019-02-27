<?php
	//Elenco campi della funzione mysqli_connect
	//localhost, indica che sta girando sul server su cui è salvato questo file
	//my_user, username dell account sul server
	//my_password
	//my_db, nome del database sul server
	$con = mysqli_connect("localhost","S3784848","DarkPoloGang","S3784848");
	
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>
