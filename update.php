<?php
$pagetitle = "ADMIN Page";
$link4="Sign_out.php";
$link2title="News";
$link1="adminpage.php";
$link2="#news";
$link3=".php";
$link1title="Home";
$link3title="Weather";
$link4title="Sign Out";
$target="#addnewuser";
$jumbotitle="";
$secondbuttontitle="";
include("inc/navibar.php");
require 'inc/functions.php';
session_start();
if($_SESSION['login']!='admin'){
  header('Location:index.php');
}
if(isset($_GET['UID'])){
$Upuid = filter_input(INPUT_GET,'UID',FILTER_SANITIZE_STRING);

$item=get_users($Upuid);
}

if($_SERVER['REQUEST_METHOD']=='POST'){
 $name=trim(filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING));
 $department=trim(filter_input(INPUT_POST,'department',FILTER_SANITIZE_STRING));
 $occupation=trim(filter_input(INPUT_POST,'occupation',FILTER_SANITIZE_STRING));
 $username= trim(filter_input(INPUT_POST,'uusername',FILTER_SANITIZE_STRING));
 $password=trim(filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING));
 $email=trim(filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING));
 $contact=trim(filter_input(INPUT_POST,'contactNo',FILTER_SANITIZE_NUMBER_INT));

if(update_users($name,$department,$occupation,$username,$password,$email,$contact)){
     header('Location:admin_users.php');
     exit;
   }else{
     $error_message='could not update  plz check again ';
   }
}
?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
        <h5 class="modal-title">Update Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

  <?php
  if(isset($error_message)){
      echo $error_message;
  }else{
    echo "<strong>Make Sure!</strong>";
  }
?>
</div>
        <form method="post" action="update.php">
    <div class="form-group">

      <input type="text" class="form-control" name="uusername" aria-describedby="usernameHelp"  value="<?php echo $item['UserName'];  ?>"readonly>

      <small id="usernameHelp" class="form-text text-muted"> Check username again</small>
    </div>
    <div class="form-group">

      <input type="password" class="form-control" name="password" value="<?php echo $item['Password'];  ?>">
    </div>
    <div class="form-group">

      <input type="password" class="form-control" value="<?php echo $item['Password'];  ?>">
    </div>
    <div class="form-group">

      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo $item['Name']; ?>"required>
    </div>

    <div class="form-group">

      <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Enter Occupation" value="<?php echo $item['Occupation']; ?>"required >
    </div>
    <div class="form-group">

      <input type="email" class="form-control" id="email" name="email" placeholder="Enter E mail" value="<?php echo $item['Email']; ?>"required>
    </div>
    <div class="form-group">

      <input type="text" class="form-control" id="contact" name="contactNo" placeholder="Enter Contact Number" value="<?php echo $item['ContactNumber']; ?>"required>
    </div>
    <div class="form-group">
      <select class="custom-select form-control" name="department" id="department" required>
        <option selected><?php echo $item['Department']; ?></option>
        <option  value="police station">police station</option>
        <option value="grama nildari">grama nildari</option>
        <option value="post Office">post Office</option>
        <option value="other" >other</option>
      </select>


    </div>




      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="login_user">Submit</button>
        <button type="button" class="btn btn-secondary" onclick="admin_users.php">Close</button>
      </div>
      </form>
    </div>
  </div>
