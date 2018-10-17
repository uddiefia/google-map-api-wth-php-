<?php
function add_users($name,$department,$occupation,$username,$password,$email,$contact){
require_once("inc/dbconnection.php");

$sql= 'INSERT INTO signup (Name,Department,Occupation,UserName,Password,Email,ContactNumber) VALUES (?,?,?,?,?,?,?)';
try{
$re=$db->prepare($sql);
$re->bindParam(1,$name,PDO::PARAM_STR);
$re->bindParam(2,$department,PDO::PARAM_STR);
$re->bindParam(3,$occupation,PDO::PARAM_STR);
$re->bindParam(4,$username,PDO::PARAM_STR);
$re->bindParam(5,$password,PDO::PARAM_STR);
$re->bindParam(6,$email,PDO::PARAM_STR);
$re->bindParam(7,$contact,PDO::PARAM_STR);
$re->execute();

} catch (PDOException $e) {
  echo "<p class=header>Error!: " . $e->getMessage() . "</p>";
return false;
}
  return true;
}

function  update_map($Description,$Location,$type,$ThreatLevel,$Upl){


  require_once("inc/dbconnection.php");
    $sql='update markers_db set Location=?,Description=?,type=?,ThreatLevel=? where markers_db.id=?';

  try{
  $re=$db->prepare($sql);
  $re->bindParam(1,$Location,PDO::PARAM_STR);
  $re->bindParam(2,$Description,PDO::PARAM_STR);
  $re->bindParam(3,$type,PDO::PARAM_STR);
  $re->bindParam(4,$ThreatLevel,PDO::PARAM_STR);
  $re->bindParam(5,$Upl,PDO::PARAM_INT);

  $re->execute();

  } catch (PDOException $e) {
    echo "<p class=header>Error!: " . $e->getMessage() . "</p>";
  return false;
  }
    return true;
  }









function get_location($id=null){
require_once("inc/dbconnection.php");
if($id){
$sql='SELECT * FROM markers_db WHERE id=?';
}
else{
$sql='SELECT * FROM markers_db where Submit=1';
  }
 try{
 $re=$db->prepare($sql);
 if($id){
     $re->bindParam(1,$id,PDO::PARAM_INT);
 }
 $re->execute();
 } catch (PDOException $e) {
   echo "<p>Error!: " . $e->getMessage() . "</p>";
   return false;
 }
 if($id){
 $bows=$re->fetchALL(PDO::FETCH_ASSOC);

 }else{
   $bows=$re->fetchALL(PDO::FETCH_ASSOC);}

 if($bows){
   return $bows;
 }else{
 return false ;
 }

 }



function submit_location($id){
require_once("inc/dbconnection.php");

$sql= 'UPDATE markers_db set Submit="1" where id=?';
try{
$re=$db->prepare($sql);
$re->bindParam(1,$id,PDO::PARAM_INT);

$re->execute();

} catch (PDOException $e) {
  echo "<p class=header>Error!: " . $e->getMessage() . "</p>";
return false;
}
  return true;
}


function login_users($username,$password)
{
require_once("inc/dbconnection.php");
try{
$re=$db->prepare('select * from signup where UserName=? and Password=?');
$re->bindParam(1,$username);
$re->bindParam(2,$password);
$re->execute();
} catch (PDOException $e) {
echo "<p class=header>Error!: " . $e->getMessage() . "</p>";
return false;
}
$bows=$re->fetch(PDO::FETCH_ASSOC);
if($bows){
return true;
}else{
return false;
}
return false;
}


function update_users($name,$department,$occupation,$username,$password,$email,$contact)
{
  require_once("inc/dbconnection.php");
  $sql='update signup set Name=?,Department=?,Occupation=?,Password=?,Email=?,ContactNumber=? where signup.Username=?';
try{
 $re=$db->prepare($sql);
 $re->bindParam(1,$name,PDO::PARAM_STR);
 $re->bindParam(2,$department,PDO::PARAM_STR);
 $re->bindParam(3,$occupation,PDO::PARAM_STR);
 $re->bindParam(4,$password,PDO::PARAM_STR);
 $re->bindParam(5,$email,PDO::PARAM_STR);
 $re->bindParam(6,$contact,PDO::PARAM_INT);
 $re->bindParam(7,$username,PDO::PARAM_STR);
 $re->execute();
} catch (PDOException $e) {
echo "<p>Error!: " . $e->getMessage() . "</p>";
return false;
 }
 return true;
}



function remove_users($id)
{
  require_once("inc/dbconnection.php");
  $sql='DELETE FROM signup WHERE ID=?';
try{
 $re=$db->prepare($sql);
 $re->bindParam(1,$id,PDO::PARAM_INT);

 $re->execute();
} catch (PDOException $e) {
echo "<p>Error!: " . $e->getMessage() . "</p>";
return false;
 }
 return true;
}


function get_lo()
{
  require_once("inc/dbconnection.php");

$sql='SELECT * FROM markers_db';

 try{
 $re=$db->prepare($sql);
 $re->execute();
 } catch (PDOException $e) {
   echo "<p>Error!: " . $e->getMessage() . "</p>";
   return false;
 }

   $bows=$re->fetchALL(PDO::FETCH_ASSOC);

 if($bows){
   return $bows;
 }else{
 return false ;
 }
 return false;
 }






 function get_users($id=null)
 {  require_once("inc/dbconnection.php");
   if($id){
     $sql='SELECT * FROM signup where ID=?';
   }else{
   $sql='SELECT * FROM signup';
  }
   try{
  $re=$db->prepare($sql);
  if($id){
  $re->bindParam(1,$id,PDO::PARAM_INT);
  }
  $re->execute();
  } catch (PDOException $e) {
    echo "<p>Error!: " . $e->getMessage() . "</p>";
    return false;
  }
if($id){
$bows=$re->fetch(PDO::FETCH_ASSOC);

}else{
  $bows=$re->fetchALL(PDO::FETCH_ASSOC);}
  if($bows){
  return $bows;
  }else{
  return false ;
  }
  return false;
  }

function add_news($image,$image_text){
    $db = mysqli_connect("localhost", "root", "", "asp");
    $sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";
    // execute query
    mysqli_query($db, $sql);


    return true;
}
function get_news(){
  $db = mysqli_connect("localhost", "root", "", "asp");
    $result = mysqli_query($db, "SELECT * FROM images");
    return $result;
}


 ?>
