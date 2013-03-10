<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:index.html");
}
?>
<?php include("db.php"); ?>
<?php
// Get registration info
$postid = $_GET['postid'];
$userid = $_SESSION['userid'];
$comment = $_POST['comment'];
$memberid = $_GET['memberid'];

$comment = addslashes($comment);

$sql="INSERT INTO comments (postid, posterid, text) VALUES ('$postid','$userid','$comment')";
	 
mysql_query($sql) or die("ERROR: Can't comment.");

if ($memberid==0)
	header("location:mainpage.php");
else
	header("location:memberpage.php?member=" . $memberid);
?>