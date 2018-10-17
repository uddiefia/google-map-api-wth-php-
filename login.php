<?php


require 'inc/functions.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
$username=trim(filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING));
$password=trim(filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING));

if(login_users($username,$password)){
    session_start();
    $_SESSION['login']= filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
      if($_SESSION['login']==admin){
          header('Location:adminpage.php');
          exit;
            }
      else{

      header('Location:users_page.php');
            }
    }

  else{

     echo "<script>
     alert('Wrong UserName or Password plz try again !');
     window.location.href='index.php';
     </script>";
  }


}

?>
