<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:index.html");
}
?>
<?php include("db.php"); ?>
<?php

$aim = $_POST['aim'];
$google = $_POST['google'];
$skype = $_POST['skype'];
$windowslive = $_POST['windowslive'];
$yim = $_POST['yim'];
$icq = $_POST['icq'];
$facebook = $_POST['facebook'];
$myspace = $_POST['myspace'];
$twitter = $_POST['twitter'];
$youtube = $_POST['youtube'];
$bebo = $_POST['bebo'];
$flickr = $_POST['flickr'];
$Xbox = $_POST['Xbox'];

$userid = $_SESSION['userid'];

$education = addslashes($education);
$work = addslashes($work);

$sql="UPDATE profiles SET aim='$aim', google='$google', skype='$skype', windowslive='$windowslive', yim='$yim', icq='$icq', facebook='$facebook', myspace='$myspace', twitter='$twitter', youtube='$youtube', bebo='$bebo', flickr='$flickr', Xbox='$Xbox' WHERE userid='$userid'";
	 
mysql_query($sql) or die("ERROR: Can't update profile.");
header("location:editprofile.php?saved=true");
?>