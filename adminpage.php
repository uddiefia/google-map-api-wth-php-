<?php
session_start();
if($_SESSION['login']!='admin'){
  header('Location:index.php');
}
$pagetitle = "ADMIN Page";
$link4="Sign_out.php";
$link1="adminpage.php";
$link2="#news";
$link3="https://www.accuweather.com/en/lk/sri-lanka-weather";
$link2title="News";
$link1title="Home";
$link3title="Weather";
$link4title="Sign Out";
 $secondbutton="#news";
  $secondbuttontitle="See News";
$target="#addnewuser";
$jumbotitle="ADD  User";
include("inc/navibar.php");
require 'inc/functions.php';

?>




      <div id="f1"class="row">
        <div class="col-lg-4 col-xl-6">
          <h3 class="mb-3">About Full Stack Conf</h3>
            <img  img-fluid src="https://i.ytimg.com/vi/GTM9hIIPwTw/maxresdefault.jpg" alt="happpy" class="mb-3 img-fluid rounded border border-warning">
          <p>The beautiful city of Portland, Oregon will be the host city for Full Stack Conf!</p>
          <p>A tsunami (from Japanese: 津波, "harbour wave";English pronunciation: /tsuːˈnɑːmi/ tsoo-NAH-mee) or tidal wave, also known as a seismic sea wave, generally in an ocean or a large lake.[3] Earthquakes, volcanic eruptions and other underwater explosions... </p>
        </div>
        <div class="col-lg-4 col-xl-3">
            <h3 class="mb-3">Expert Speakers</h3>

          <p>On March 11, 2011, a magnitude-9 earthquake shook northeastern Japan, unleashing a savage tsunami.</p>
          <p>In Japan, residents are still recovering from the disaster. As of February 2017, there were still about 150,000 evacuees who lost their homes; 50,000 of them were still living in temporary housing, Japan's Reconstruction Agency said.</p>
          <p>More than 120,000 buildings were destroyed, 278,000 were half-destroyed and 726,000 were partially destroyed, the agency said. The direct financial damage from the disaster is estimated to be about $199 billion dollars</p>
        </div>
        <div class="col-lg-4 col-xl-3">
            <h3 class="mb-3">What You Can Do!</h3>
            <div class="list-group">
      <a href="AdmTable.php" class="list-group-item"><strong>Disasters</strong>: Confirm ,Update or Delete</a>

      <a href="admin_users.php" class="list-group-item"><strong>Users </strong>: View And Delete Users</a>
      <a href="admin_map.php" class="list-group-item"><strong>Map</strong>: View Map</a>

    </div>
        </div>
      </div>
      <h1 id="news" class="text-center mb-3 text-secondary">Speakers</h1>
      <div class="card-deck">
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/Flood-natural-disaster.jpg" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">NodeStradamus</h4>
<p class="card-text">"NodeStra" is a software engineer and philosopher trying to leave the world better than he found it. He codes for non-profits, eCommerce, and large-scale web apps.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/Tsunami_recreation.jpg" alt="Card image cap">
          <div class="card-body">

            <h4 class="card-title">Geo "Lo" Cation</h4>
  <p class="card-text">Geo is a JavaScript developer working on large-scale applications. He's also a teacher who strives to support students in removing all barriers to learning code.</p>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="https://placeimg.com/277/200/tech/grayscale" alt="Card image cap">
          <div class="card-body">

            <h4 class="card-title">Ecma Scriptnstuff</h4>
  <p class="card-text">Ecma found her passion for computers and programming over 15 years ago. She is excited to introduce people to the wonderful world of JavaScript.</p>
          </div>
        </div>
      </div>
      <div class="card-deck">
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/Blizzard_picture.jpg" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">NodeStradamus</h4>
<p class="card-text">"NodeStra" is a software engineer and philosopher trying to leave the world better than he found it. He codes for non-profits, eCommerce, and large-scale web apps.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/Flood_information.jpg" alt="Card image cap">
          <div class="card-body">

            <h4 class="card-title">Geo "Lo" Cation</h4>
  <p class="card-text">Geo is a JavaScript developer working on large-scale applications. He's also a teacher who strives to support students in removing all barriers to learning code.</p>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/twister_picture.jpg" alt="Card image cap">
          <div class="card-body">

            <h4 class="card-title">Ecma Scriptnstuff</h4>
  <p class="card-text">Ecma found her passion for computers and programming over 15 years ago. She is excited to introduce people to the wonderful world of JavaScript.</p>
          </div>
        </div>
      </div>

      <h1 id="news" class="text-center mb-3 text-secondary">News</h1>

        <?php  $news=get_news();

        foreach ($news as $row) {


          echo "<div class='card-deck container img-responsive center-block mx-auto'>";
      echo ' <div class="card">';
        echo  "<img class='card-img-top' src='images/".$row['image']."' alt='Card image cap'>";
          echo "<div class='card-body'>";
              //<h4 class="card-title">NodeStradamus</h4>
            echo "<p class='card-text'>".$row['image_text']."</p>";
          echo "<p class='card-text'><small class='text-muted'>Last updated 3 mins ago</small></p>";
        echo "</div>";
      echo " </div>";
      echo " </div>";
      }
        ?>



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

<?php include("inc/footer.php");?>
