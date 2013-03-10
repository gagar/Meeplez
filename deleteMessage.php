<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:index.html");
}
?>
<?php include("db.php"); ?>
<?php
// Get registration info
$wallpost = $_POST['wallpost'];
$posterid = $_SESSION['userid'];
$postid = $_GET['postid'];

$sql="DELETE FROM postings WHERE postid='$postid'";
mysql_query($sql) or die("ERROR: Can't delete this message.");
header("location:inbox.php");
?>