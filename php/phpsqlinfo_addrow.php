<?php

// Gets data from URL parameters.
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];


// Opens a connection to a MySQL server.
include ("connessione.php");

// Inserts new row with place data.
$query = sprintf("INSERT INTO Markers " .
         " (id, name, address, lat, lng, type) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s');",
		mysqli_real_escape_string($con, $name),
		mysqli_real_escape_string($con, $address),
		mysqli_real_escape_string($con, $lat),
		mysqli_real_escape_string($con, $lng),
		mysqli_real_escape_string($con, $type));

$result = mysqli_query($con, $query);

if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

?>