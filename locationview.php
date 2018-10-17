<?php


  $conn = mysqli_connect("localhost","root","","asp");

  if (!$conn){

    die ("Connection Failed : ".mysqli_connect_error());

  }

// Gets data from URL parameters.
$location = $_GET['Location'];
$description = $_GET['Description'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];
$threatLevel = $_GET['ThreatLevel'];

//$dateTime = $_GET['dateTime'];


  $sql = "INSERT INTO markers_db (Location,Description,lat,lng,type, ThreatLevel)  VALUES ('$location','$description',$lat, $lng, '$type', '$threatLevel')";
//add new column dateTime
//  $sql = "INSERT INTO markers_db (Location,Description,lat,lng,type, ThreatLevel, dateTime)  VALUES ('$location','$description',$lat, $lng, '$type', '$threatLevel', '$dateTime')";

  $result = mysqli_query($conn,$sql);








 ?>
