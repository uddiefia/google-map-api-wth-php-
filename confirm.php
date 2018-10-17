<?php
require 'inc/functions.php';
if(isset($_GET['stateid'])){
$clo = filter_input(INPUT_GET,'stateid',FILTER_SANITIZE_STRING);
if(submit_location($clo)){
  header('Location:AdmTable.php');
  exit;


}else{
$error_message="already confirmed";
header('Location:AdmTable.php');


}

}



 ?>
