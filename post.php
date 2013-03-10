<?php
session_start();
if(!isset($_SESSION[$userid])){
header("location:mainpage.php");
}
?>

<?php include("db.php"); ?>
<?php
// Get registration info
$wallpost = $_POST['wallpost'];
$userid = $_SESSION['userid'];

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


$sql="INSERT INTO postings (wallid, posterid, text, type) VALUES ('$userid','$userid','$wallpost', '1')";
   
mysql_query($sql) or die("ERROR: Can't post to wall.");
header("location:mainpage.php");
?>