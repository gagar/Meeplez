<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:memberpage.php?member=$wallid");
}
?>
<?php include("db.php"); ?>
<?php
// Get registration info
$wallpost = $_POST['wallpost'];
$posterid = $_SESSION['userid'];
$wallid = $_GET['post2'];

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];

$wallpost = str_replace("\r\n", " [br]", $wallpost);
$pieces = explode(" ", $wallpost);
$num = count($pieces);
echo ($num);
for ($i=0; $i<$num; $i++) {
  $pos = strpos($pieces[$i], "youtube.com/watch?v=");
  
  if ($pos === false) {
    // do nothing, not a YouTube element
    }
  else
    {
      $youtubeid = substr($pieces[$i], $pos+20, 11);
        
      $pieces[$i] = "[YOUTUBE]" . $youtubeid . "[/YOUTUBE]";
      $wallpost = implode(" ", $pieces);
    }
}

$wallpost = addslashes($wallpost);

$sql="INSERT INTO postings (wallid, posterid, text, type) VALUES ('$wallid','$posterid','$wallpost', '1')";
   
mysql_query($sql) or die("ERROR: Can't post to wall.");

$sql="SELECT email FROM members WHERE userid='$wallid'";
$result=mysql_query($sql);
$row = mysql_fetch_assoc($result);
$email = $row['email'];

$to = $email;
$subject = 'Meeplez.com Notification'; 
$message = "$fname $lname has just left a Merp on your Meeps page.\nVisit www.meeplez.com to see the message.\n"; 
$headers = "From: donotreply@meeplez.com\r\nReply-To: donotreply@meeplez.com";
mail( $to, $subject, $message, $headers );


?>