
   <?php
try{
$db= new PDO('mysql:host=localhost;dbname=asp', 'root', '');

$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
echo "Error!: " . $e->getMessage() . "<br/>";
die();

}
?>
