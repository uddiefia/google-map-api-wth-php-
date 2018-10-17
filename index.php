<?php
$pagetitle = "Main page";
$link4="Sign_out.php";
$link2title="News";
$link1="index.php";
$link2="#news";
$link3="http://www.meteo.gov.lk/index.php?option=com_content&view=article&id=102&Itemid=360&lang=en";
$link2title="News";
$link1title="Home";
$link3title="Weather";
$link4title="";
$target="#loginmodel";
$jumbotitle="Sign In";
 $secondbutton="#news";
$secondbuttontitle="See News";

include("inc/navibar.php");
require 'inc/functions.php';

?>
  <div id="f1"class="row">
        <div class="col-lg-12 col-xl-12">
          <?php

              if(isset($error_message)){
                var_dump($error_message);
                exit;
                  echo "<p class='message'>$error_message</p>";
              }
  ?>
          <?php
          $array = get_location();
             //var_dump($array);die;
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

                  marker = new google.maps.Marker({
                  position: { lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
                  map: map,
                  icon: iconPath,
                  animation: google.maps.Animation.DROP,
                  title:"Click me !"
                });
                var infowindows = new google.maps.InfoWindow({
                  content: contentString
                  });
                  // google.maps.event.addListener(marker, "click", function (e) {
                  //                     //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                  //                     infoWindow.setContent("gg");
                  //                     infoWindow.open(map, marker);
                  //                 });

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


        </div>



      <h1 id="news" class="text-center mb-3 text-secondary">News</h1>
      <div class="card-deck">
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/Flood-natural-disaster.jpg" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">NodeStradamus</h4>
<p class="card-text">"more details soon"</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/Tsunami_recreation.jpg" alt="Card image cap">
          <div class="card-body">

            <h4 class="card-title">Geo "Lo" Cation</h4>
  <p class="card-text"></p>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="https://placeimg.com/277/200/tech/grayscale" alt="Card image cap">
          <div class="card-body">

            <h4 class="card-title">Ecma Scriptnstuff</h4>
  <blockquote class="blockquote-reverse"class="card-text"></blockquote>
          </div>
        </div>
      </div>
      <div class="card-deck">
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/Blizzard_picture.jpg" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">Winter accident</h4>
<p class="card-text">This is a compilation of accidents involving SUVs, trucks, semis, all-wheel drive vehicles, 4WD vehicles, vehicles with traction control and winter tires. No driver or vehicle can safely go highway speeds on icy roads!</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/Flood_information.jpg" alt="Card image cap">
          <div class="card-body">

            <h4 class="card-title">Geo "Lo" Cation</h4>
  <p class="card-text"></p>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="http://cdn.basicplanet.com/wp-content/uploads/2013/05/twister_picture.jpg" alt="Card image cap">
          <div class="card-body">

            <h4 class="card-title">Ecma Scriptnstuff</h4>
  <p class="card-text"></p>
          </div>
        </div>
      </div>
<!-- /schedule -->
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



<div class="modal" id="loginmodel">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
        <h5 class="modal-title">Sign In Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>hurry!</strong> You should Sign in
  <?php
if(isset($error_message)){

  echo $error_message;




}
?>
</div>
        <form method="post" action="login.php" >
    <div class="form-group">

      <input type="text" class="form-control"  id="username" name="username"  aria-describedby="emailHelp" placeholder="Enter Username" required>
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">

      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>



      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="login_user">Sign In</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php include("inc/footer.php");?>
