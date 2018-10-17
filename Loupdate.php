
<?php
session_start();
if(is_null($_SESSION['login'])){
  header('Location:index.php');
}


$pagetitle = "Main page ";
$link4="Sign_out.php";
$link1="adminpage.php";
$link2="#news";
$link3=".php";
$link2title="News";
$link1title="Home";
$link3title="Other Sites";
$link4title="Sign Out";
$target="#addnewuser";
$jumbotitle="";
$secondbutton="Sign_out.php";
$secondbuttontitle="Sign Out";
include("inc/navibar.php");
require 'inc/functions.php';

if(isset($_GET['LocationId'])){
$Upl = filter_input(INPUT_GET,'LocationId',FILTER_SANITIZE_STRING);
$items=get_location($Upl);

}if($_SERVER['REQUEST_METHOD']=='POST'){
 $Description=trim(filter_input(INPUT_POST,'Description',FILTER_SANITIZE_STRING));
 $Location=trim(filter_input(INPUT_POST,'Location',FILTER_SANITIZE_STRING));
 $type=trim(filter_input(INPUT_POST,'type',FILTER_SANITIZE_STRING));
 $ThreatLevel= trim(filter_input(INPUT_POST,'ThreatLevel',FILTER_SANITIZE_STRING));



if(update_map($Description,$Location,$type,$ThreatLevel,$Upl)){
     header('AdmTable.php');
     exit;
   }else{
     $error_message='could not update  plz check again ';
   }
}


?>
<div id="f1"class="row">
  <div class="col-lg-8 col-xl-8">

    <?php


      //  $array = get_location($Upl);
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

     <?php foreach ($items as $key) { ?>
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


            marker = new google.maps.Marker({
            position: { lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
            map: map,
            icon: iconPath,
            draggable:true,
            title:"Drag me !"
          });

    <?php } ?>


        infowindow = new google.maps.InfoWindow({
          content: document.getElementById('form')
        });

        messagewindow = new google.maps.InfoWindow({
          content: document.getElementById('message')
        });

       google.maps.event.addListener(map, 'click', function(event) {
          marker = new google.maps.Marker({
            position: event.latLng,
            map: map,
            draggable:true,
            title:"Drag me !"
          });


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
    <form  method="post">
    <?php foreach ($items as $item): ?>


      <div class="form-group mx-auto my-4 ">
          <label for="inputAddress">Description</label>
          <input type="text" class="form-control" name="Description" value="<?php echo $item['Description'];  ?>">
        </div>

        <div class="form-group mx-auto my-4 ">
          <label for="inputAddress">Location</label>
          <input type="text" class="form-control" name="Location" value="<?php echo $item['Location'];  ?>">
        </div>
  <div class="form-group mx-auto my-4 ">
      <label for="inputState">State</label>
      <select name="type" class="form-control">
        <option selected><?php echo $item['type'];  ?></option>
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
      <label for="inputState"></label>
      <select name="ThreatLevel" class="form-control">
        <option selected><?php echo $item['ThreatLevel']; ?></option>
        <option value='High'>High</option>
        <option value='Medium'>Medium</option>
        <option value='Low'>Low</option>
      </select>
    </div>
    <?php endforeach; ?>
      <button type="submit" class="btn btn-outline-dark btn-lg d-block mx-auto my-4 ">Save</button>
      </form>
    </div>

</form>

  </div>













<?php include("inc/footer.php");?>
