<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:index.html");
}
?>
<?php include("db.php"); ?>
<?php
// Get registration info
$education = $_POST['education'];
$work = $_POST['work'];

$userid = $_SESSION['userid'];

$education = addslashes($education);
$work = addslashes($work);

$sql="UPDATE profiles SET education='$education', work='$work' WHERE userid='$userid'";
	 
mysql_query($sql) or die("ERROR: Can't update profile.");
header("location:editprofile.php?saved=true");
?>