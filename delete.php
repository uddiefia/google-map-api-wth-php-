<?php

//Process URL
$deleid = $_GET['LocationId'];

//Making SQL
$sql = "DELETE FROM markers_db WHERE id='$deleid'";

//Connect Database
$link=mysqli_connect('localhost','root','','asp');

//Run (Execute)
$res = mysqli_query($link,$sql);

//Redirecting
header('location:AdmTable.php');



?>
