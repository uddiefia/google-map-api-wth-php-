<?php


session_start();
if($_SESSION['login']!='admin'){
  header('Location:index.php');
}

 require 'inc/functions.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $name=trim(filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING));
  $department=trim(filter_input(INPUT_POST,'department',FILTER_SANITIZE_STRING));
  $occupation=trim(filter_input(INPUT_POST,'occupation',FILTER_SANITIZE_STRING));
  $username=trim(filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING));
	$password=trim(filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING));
  $email=trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING));
  $contact=trim(filter_input(INPUT_POST,'contactNo',FILTER_SANITIZE_NUMBER_INT));


    if(add_users($name,$department,$occupation,$username,$password,$email,$contact)){
      header('Location:adminpage.php');
      exit;
    }else{
      $error_message='could not add user plz check again ';
    }


}




 ?>
