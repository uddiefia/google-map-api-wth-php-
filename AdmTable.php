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

$pagetitle = "ADMIN Page";
$link4="Sign_out.php";
$link2="#news";
$link3="https://www.accuweather.com/en/lk/sri-lanka-weather";
$link1title="Home";
$link3title="Weather";
$link4title="Sign Out";
$link2title="News";
$link1="adminpage.php";
$target="";
$jumbotitle="";
 $secondbutton="admin_map.php";
  $secondbuttontitle="View Map";
include("inc/navibar.php");
require 'inc/functions.php';?>


  <div class="table-responsive">

    <p>Type something in the input field to search</p>
      <input class="form-control" id="myInput" type="text" placeholder="Search..">
      <?php
echo '<table class="table table-hover">';
    echo  '<thead>';
    echo  '<tr>';
    echo '<th scope="col"> ID </th>';
    echo '<th scope="col"> Location </th>';
    echo '<th scope="col"> Description </th>';
    echo '<th scope="col"> Lat </th>';
    echo '<th scope="col"> Lng </th>';
    echo '<th scope="col"> Type </th>';
    echo '<th scope="col"> Threat Level </th>';
    echo '<th scope="col"> Delete </th>';
    echo '<th scope="col"> Update </th>';
    echo '<th scope="col"> State </th>';
    echo  '</tr>';
    echo  '</thead>';
    echo '<tbody id="myTable">';
    foreach (get_lo() as  $row) {
      echo '<tr>';
      echo '<td>'.$row['id'].'</td>';
      echo '<td>'.$row['Location'].'</td>';
      echo '<td>'.$row['Description'].'</td>';
      echo '<td>'.$row['lat'].'</td>';
      echo '<td>'.$row['lng'].'</td>';
       echo '<td>'.$row['type'].'</td>';
        echo '<td>'.$row['ThreatLevel'].'</td>';
      if($row['Submit']==1){
          $ee="Confirmed";
        }else{$ee="Not Confirmed";}

      echo '<td>'.'<a href="delete.php?LocationId='
           .$row['id'].'"
            onclick="return Delete()">Delete</a>'.'</td>';

      echo "<td><a href='Loupdate.php?LocationId=".$row['id']."'>Update</a></td>";
      echo "<td><a href='confirm.php?stateid=".$row['id']."'>$ee</a></td>' ";

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




<?php include("inc/footer.php");

?>
