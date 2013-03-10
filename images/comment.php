<?php
session_start();
if(!session_is_registered(userid)){
header("location:index.html");
}
?>
<?php include("db.php"); ?>
<?php
// Get registration info
$postid = $_GET['postid'];
$userid = $_SESSION['userid'];
$comment = $_POST['comment'];

$comment = addslashes($comment);

$sql="INSERT INTO comments (postid, posterid, text) VALUES ('$postid','$userid','$comment')";
	 
mysql_query($sql) or die("ERROR: Can't comment.");
header("location:mainpage.php");
?>