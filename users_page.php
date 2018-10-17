
<?php
session_start();
if(is_null($_SESSION['login'])){
  header('Location:index.php');
}


$pagetitle = "Main page ";
$link4="Sign_out.php";
$link1="users_page.php";
$link2="#news";
$link3="https://www.accuweather.com/en/lk/sri-lanka-weather";
$link2title="News";
$link1title="Home";
$link3title="Weather";
$link4title="Sign Out";
$target="#addnewuser";
$jumbotitle="";
$secondbutton="https://www.accuweather.com";
$secondbuttontitle="Weather";
include("inc/navibar.php");
require 'inc/functions.php';




  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
    $db = mysqli_connect("localhost", "root", "", "photos");
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target = "images/".basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }
    add_news($image,$image_text);


  }



?>

<div id="f1"class="row">
  <div class="col-lg-8 col-xl-8">

    <?php


        $array = get_location();
       // var_dump($array);die;
     ?>

    <div id="map" height="460px" width="85%"></div>


    <script>
      var map;
      var marker;
      var infowindow;
      var messagewindow;

        function initMap() {
        var colombo = {lat:6.901609, lng:80.008775};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center:colombo
        });

     <?php foreach ($array as $key) { ?>
      var item = <?php echo json_encode($key) ?>;
      var iconPath ='';
      if(item.type == 'Road Side Accidents'){
      if(item.ThreatLevel == 'High')
          iconPath = 'img/road side accidentsH.png';
      else if(item.ThreatLevel == 'Medium')
        iconPath = 'img/road side accidentsM.png';
      else if(item.ThreatLevel == 'Low')
        iconPath = 'img/road side accidentsL.png';
    }

   if(item.type == 'Cyclone'){
      if(item.ThreatLevel == 'High')
          iconPath = 'img/cycloneH.png';
      else if(item.ThreatLevel == 'Medium')
        iconPath = 'img/cycloneM.png';
      else if(item.ThreatLevel == 'Low')
        iconPath = 'img/cycloneL.png';}

 if(item.type == 'Landslide'){
      if(item.ThreatLevel == 'High')
          iconPath = 'img/landslidetH.png';
      else if(item.ThreatLevel == 'Medium')
        iconPath = 'img/landslidetM.png';
      else if(item.ThreatLevel == 'Low')
        iconPath = 'img/landslidetL.png';}


 if(item.type == 'Other'){
      if(item.ThreatLevel == 'High')
          iconPath = 'img/otherH.png';
      else if(item.ThreatLevel == 'Medium')
        iconPath = 'img/otherM.png';
      else if(item.ThreatLevel == 'Low')
        iconPath = 'img/otherL.png';}

 if(item.type == 'Fires'){
      if(item.ThreatLevel == 'High')
          iconPath = 'img/fireH.png';
      else if(item.ThreatLevel == 'Medium')
        iconPath = 'img/fireM.png';
      else if(item.ThreatLevel == 'Low')
        iconPath = 'img/fireL.png';}


 if(item.type == 'Flood'){
      if(item.ThreatLevel == 'High')
          iconPath = 'img/floodH.png';
      else if(item.ThreatLevel == 'Medium')
        iconPath = 'img/floodM.png';
      else if(item.ThreatLevel == 'Low')
        iconPath = 'img/floodL.png';}

 if(item.type == 'Electrical Breakdown Leakages'){
      if(item.ThreatLevel == 'High')
          iconPath = 'img/Electrical breakdown @ leakagesH.png';
      else if(item.ThreatLevel == 'Medium')
        iconPath = 'img/Electrical breakdown @ leakagesM.png';
      else if(item.ThreatLevel == 'Low')
        iconPath = 'img/Electrical breakdown @ leakagesL.png';}

        var contentString = '<div id="content">'+
             '<div id="siteNotice">'+
             '</div>'+
             '<h1 id="firstHeading" class="firstHeading">Polgasovita</h1>'+
             '<div id="bodyContent">'+
             '<p> ThreatLevel is High </b>' +
             'type is flood '+
             '(last visited january 15, 2018).</p>'+
             '</div>'+
             '</div>';


          var infowindows = new google.maps.InfoWindow({
            content: contentString
            });

            marker = new google.maps.Marker({
            position: { lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
            map: map,
            icon: iconPath,
              animation: google.maps.Animation.DROP,
            title:"Drag me !"
          });

                  marker.addListener('click', function() {
                    infowindows.open(map, marker);
                  });
    <?php } ?>


        infowindow = new google.maps.InfoWindow({
          content: document.getElementById('form')
        });

        messagewindow = new google.maps.InfoWindow({
          content: document.getElementById('message')
        });

        var li=0;

       google.maps.event.addListener(map, 'click', function(event) {
        if(li==0) { marker = new google.maps.Marker({
            position: event.latLng,
            map: map,
            draggable:true,
            title:"Drag me !"
          });
          li=1;
        }

          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });
        });
      }

      function saveData() {

        var Location = escape(document.getElementById('Location').value);

        //var dateTime = document.getElementById('dateTimeText').value;

        var Description = escape(document.getElementById('Description').value);
        var type = document.getElementById('type').value;
        var latlng = marker.getPosition();
//console.log(dateTime);
        var ThreatLevel  = document.getElementById('ThreatLevel').value;

        var url = 'locationview.php?Location=' + Location +'&Description=' + Description +
                  '&type=' + type + '&lat=' + latlng.lat()  + '&lng=' + latlng.lng() + '&ThreatLevel=' +ThreatLevel;

        //var url = 'index.php?Location=' + Location +'&Description=' + Description +
                  //'&type=' + type + '&lat=' + latlng.lat()  + '&lng=' + latlng.lng() + '&ThreatLevel=' +ThreatLevel+'&dateTime='+dateTime;

        downloadUrl(url, function(data, responseCode) {

          if (responseCode == 200 && data.length <= 1) {
            infowindow.close();
            messagewindow.open(map, marker);
          }
        });

        setTimeout(function(){
            location.reload();
        } , 2000)
      }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request.responseText, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing () {
      }

    </script>


  </div>


    <div class="col-lg-4 col-xl-4">



          <div class="form-group mx-auto my-4 ">
            <label for="inputAddress">Description</label>
            <input type="text" class="form-control" id="Description" placeholder="Enter Description">
          </div>

          <div class="form-group mx-auto my-4 ">
            <label for="inputAddress">Location</label>
            <input type="text" class="form-control" id="Location" placeholder="Enter Location">
          </div>


      <div class="form-group mx-auto my-4 ">
        <label for="inputState">State</label>
        <select id="type" class="form-control">
          <option selected>Choose...</option>
                     <option value='Flood'>Flood</option>
                     <option value='Landslide'>Landslide</option>
                     <option value='Fires'>Fire</option>
                     <option value='Road Side Accidents'>Road Side Accidents</option>
                     <option value='Electrical Breakdown Leakages'>Electrical Breakdown Leakages</option>
                     <option value='Cyclone'>Cyclone</option>
                     <option value='Other'>Other</option>
        </select>
      </div>
      <div class="form-group mx-auto my-4 ">
        <label for="inputState">Threat Level</label>
        <select id="ThreatLevel" class="form-control">
          <option selected>Choose...</option>

          <option value='High'>High</option>
          <option value='Medium'>Medium</option>
          <option value='Low'>Low</option>
        </select>
      </div>
        <button type="button" class="btn btn-outline-dark btn-lg d-block mx-auto my-4 " onclick='saveData()'>Save</button>

  </div>

  </div>

<div class="well well-lg mt-3">
    <h3 id="news" class="text-center mb-3 text-secondary">Add News</h3>
  <form method="POST" action="users_page.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
  	<div>
      <textarea class="form-control" rows="5"
      	id="text"
      	cols="40"

      	name="image_text"
      	placeholder="Add yout latest News..."></textarea>
  	</div>
  	<div>
  		<button type="submit" class="btn btn-outline-dark btn-lg d-block mx-auto my-4 "  name="upload">POST</button>
  	</div>
  </form>
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



<?php include("inc/footer.php");?>
