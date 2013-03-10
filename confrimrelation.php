<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:mainpage.html");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">      
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
   
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="index.css" />
  <title>Meeplez.com Member Area</title>
  </head>
  <body>
  <?php include("db.php"); ?>
    <?php
      $userid = $_SESSION['userid'];
      $fname = $_SESSION['fname'];
      $lname = $_SESSION['lname'];
      
      $userid = $_SESSION['userid'];
    ?>
    <div id="header">
      <strong><a href="mainpage.php">Meeplez.com</a></strong>
      <div style='float:right;'><a href="logout.php">Logout</a></div>
    </div>
      
    <div id="colmask"> 
      <div id="colmid"> 
        <div id="colright"> 
          <div id="col1wrap"> 
            <div id="col1pad"> 
              <div id="col1"> 
                <h2>Pending Relationship Requests</h2>
                
                
                <?php
                  $sql="SELECT userid, relationshipid, fname, lname FROM relationship, members WHERE userid='$userid' AND requests.relationshipid=members.userid";
                  $result=mysql_query($sql);
                  $count=mysql_num_rows($result);
                  for ($i=0; $i<$count; $i++) {
                    $row = mysql_fetch_assoc($result);
                    print ("<p><a href=memberpage.php?member=" . $row["requestorid"] . ">" . $row["fname"] . " " . $row["lname"] . "</a><br/>");
                    print ("<small><a href=acceptfriend.php?member=" . $row["requestorid"] . ">[Accept Friend]</a></p>");
                  }
                ?>
              </div>
            </div>
          </div>
          <div id="col2">
            <?php
              print ("<p><small><a href=memberpage.php?member=" . $row["userid"] . ">" . $row["fname"] . " " . $row["lname"] . "</a></small><br/>");
              print ("<small><a href=\"editprofile.php\">(Edit Profile)</a></small></p>");
            ?>
            <p><a href="friends.php">Friends</a></p>
            <p><a href="search.php">People Search</a></p>  
            <p><a href="inbox.php">Inbox
              <?php
                $sql="SELECT postings.text, postings.date, members.fname, members.lname, members.userid FROM postings, members WHERE postings.wallid='$userid' AND postings.posterid=members.userid AND postings.type = 0 ORDER BY date desc";
                $result=mysql_query($sql);
                $count=mysql_num_rows($result);
                print("(" . $count . ")");
              ?>            
            </a></p>
          </div>
          <div id="col3">
          
          </div>
        </div>
      </div>
    </div>    
    <div id="footer">
    
    </div>
    </body>
</html>