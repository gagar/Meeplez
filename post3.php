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
$wallid = $_GET['post3'];

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];

$wallpost = addslashes($wallpost);

$sql="INSERT INTO postings (wallid, posterid, text, type) VALUES ('$wallid','$posterid','$wallpost', '0')";
	 
mysql_query($sql) or die("ERROR: Can't post this message.");

$sql="SELECT email FROM members WHERE userid='$wallid'";
$result=mysql_query($sql);
$row = mysql_fetch_assoc($result);
$email = $row['email'];

$to = $email;
$subject = 'Meeplez Notification'; 
$message = "$fname $lname has just send you a private message in your meeplez inbox.\nVisit www.meeplez.com to see the message.\n"; 
$headers = "From: donotreply@meeplez.com\r\nReply-To: donotreply@meeplez.com";
mail( $to, $subject, $message, $headers );

header("location:memberpage.php?member=$wallid");
?>