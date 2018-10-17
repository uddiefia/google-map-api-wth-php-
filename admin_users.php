<?php
session_start();
if($_SESSION['login']!='admin'){
  header('Location:index.php');
}?>
<script>
function Delete()
{
  return confirm("Are you sure?");
}
</script>

<?php
$error_message=NULL;
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
$jumbotitle="Add users";
$secondbuttontitle="Sign Out";
$secondbutton="Sign_out.php";
include("inc/navibar.php");
require 'inc/functions.php';

if(isset($_GET['DID'])){
$deuid = filter_input(INPUT_GET,'DID',FILTER_SANITIZE_STRING);

if(remove_users($deuid)){

    header('location:admin_users.php');}
    else{
      $error_message="coldnt delete the recode";
    }
}?>



  <div class="table-responsive">



<?php if($error_message){
  echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button><strong>Error!</strong>'.$error_message.'</div>';


}?>


    <p>Type something in the input field to search</p>
      <input class="form-control" id="myInput" type="text" placeholder="Search..">
      <?php



    echo '<table class="table table-hover">';
    echo  '<thead>';
    echo  '<tr>';
    echo '<th scope="col"> ID </th>';
    echo '<th scope="col"> Name </th>';
    echo '<th scope="col"> Department </th>';
    echo '<th scope="col"> Occupation </th>';
    echo '<th scope="col"> Username </th>';
    echo '<th scope="col"> Password </th>';
    echo '<th scope="col">Email </th>';
      echo '<th scope="col">contact No</th>';
    echo '<th scope="col"> Delete </th>';
    echo '<th scope="col"> Update </th>';
    echo  '</tr>';
    echo  '</thead>';
      echo '<tbody id="myTable">';

                        foreach (get_users() as  $row) {
                          echo '<tr>';
                          echo '<td>'.$row['ID'].'</td>';
                          echo '<td>'.$row['Name'].'</td>';
                          echo '<td>'.$row['Department'].'</td>';
                          echo '<td>'.$row['Occupation'].'</td>';
                          echo '<td>'.$row['UserName'].'</td>';
                           echo '<td>'.$row['Password'].'</td>';
                            echo '<td>'.$row['Email'].'</td>';
                             echo '<td>'.$row['ContactNumber'].'</td>';

                          echo '<td>'.'<a href="admin_users.php?DID='
                               .$row['ID'].'"
                                onclick="return Delete()">Delete</a>'.'</td>';

                          echo "<td><a href='update.php?UID=".$row['ID']."'>Update</a></td>";

                          echo '</tr>';



                        }

     echo '</tbody>';
    echo '</table>';


    ?>
    <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>

    </div>

    <div class="modal" id="addnewuser">




      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <h5 class="modal-title">Registration Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>ADD!</strong> a New User
      <?php
    	if(isset($error_message)){
    			echo $error_message;
    	}
    ?>
    </div>
            <form method="post" action="user_regi.php">
        <div class="form-group">

          <input type="text" class="form-control" name="username" aria-describedby="usernameHelp" placeholder="Enter Username" required>
          <small id="usernameHelp" class="form-text text-muted">Plz make sure Username is Unique</small>
        </div>
        <div class="form-group">

          <input type="password" class="form-control" name="password" placeholder=" Enter Password" required>
        </div>
        <div class="form-group">

          <input type="password" class="form-control" placeholder="Re-Enter Password" required>
        </div>
        <div class="form-group">

          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
        </div>

        <div class="form-group">

          <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Enter Occupation" required >
        </div>
        <div class="form-group">

          <input type="email" class="form-control" id="email" name="email" placeholder="Enter E mail"required>
        </div>
        <div class="form-group">

          <input type="text" class="form-control" id="contact" name="contactNo" placeholder="Enter Contact Number" required>
        </div>
        <div class="form-group">
          <select class="custom-select form-control" name="department" id="department" required>
            <option selected>Select your Department/Office</option>
            <option  value="police station">police station</option>
            <option value="grama nildari">grama nildari</option>
            <option value="post Office">post Office</option>
            <option value="other" >other</option>
          </select>


        </div>




          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="login_user">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>


<?php include("inc/footer.php");
?>
