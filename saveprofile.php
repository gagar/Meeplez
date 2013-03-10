<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:index.html");
}
?>
<?php include("db.php"); ?>
<?php
// Get registration info
$bio = $_POST['bio'];
$activities = $_POST['activities'];
$interests = $_POST['interests'];
$music = $_POST['music'];
$books = $_POST['books'];
$tv = $_POST['tv'];
$movies = $_POST['movies'];
$foods = $_POST['foods'];
$Xbox = $_POST['Xbox'];

$userid = $_SESSION['userid'];

$bio = addslashes($bio);
$activities = addslashes($activities);
$interests = addslashes($interests);
$music = addslashes($music);
$books = addslashes($books);
$tv = addslashes($tv);
$movies = addslashes($movies);
$foods = addslashes($foods);

$sql="UPDATE profiles SET bio='$bio', activities='$activities', interests='$interests', music='$music', books='$books', tv='$tv', movies='$movies', foods='$foods' WHERE userid='$userid'";
	 
mysql_query($sql) or die("ERROR: Can't update profile.");
header("location:editprofile.php?saved=true");
?>