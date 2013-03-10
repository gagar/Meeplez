<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:mainpage.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">      
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" type="image/gif" href="animated_favicon1.gif" />
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="index.css" />
  <script type="text/javascript" src="bbeditor/ed.js"></script>
  <script type="text/javascript" language="JavaScript">
    function CheckTextareaFieldSize(postid) {
    // If the number of characters in the textarea 
    //    field exceeds the col number multiplied 
    //    by the row number minus one, add another 
    //    row to the field.
    // Customize with form name and field name, both 
    //    in 4 places.
    var fname = "comment" + postid;
    var ic = document.forms[fname].comment.cols;
    var ir = document.forms[fname].comment.rows;
    var j = document.forms[fname].comment.value.length;
    var k = ic * (ir - 1);
    if(j > k) {
       document.forms[fname].comment.rows = (ir + 1);
       }
    }  
  </script>
  <title>Meeplez.com Member Area</title>
  </head>
  <body>
  <?php include("db.php"); ?>
  <?php include("convert_text.php"); ?>
  <?php
    $userid = $_SESSION['userid'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];

    $userid = $_SESSION['userid'];
    $member = $_SESSION['userid'];

  ?>
  <div id="header">
    <div style=margin:25px;>
    <strong><a href="mainpage.php">Meeplez.com</a></strong>
    <div style='float:right;'><a href="logout.php">Logout</a></div>
    </div>
  </div>
    
  <div id="colmask"> 
    <div id="colmid"> 
      <div id="colright"> 
        
        
        <div id="col1wrap"> 
          <div id="col1pad"> 
            <div id="col1"> 
              <form method="post" action="post.php">
              <?php
                $sql="SELECT * FROM requests WHERE memberid='$userid'";
                $result=mysql_query($sql);
                $count=mysql_num_rows($result);
                if ($count>0) {
                  print("<h3><font color=red>You have pending friend requests!</font></h3>");
                  print("<a href=confirmfriend.php>[View Requests]</a>");
                }
              ?>
                <?php
                    $sql="SELECT * FROM relationship WHERE userid='$userid'";
                    $result=mysql_query($sql);
                    $count=mysql_num_rows($result);
                    if ($count>0) {
                        print ("<h4><font color=blue>You have a Relationship Request!</font></h4>");
                        print("<a href=confrimrelation.php>[View Relationship]</a>");
                     }
                   ?>
                <?php
  if($_SESSION['userid'])
  echo '<p>'.$_SESSION['fname'].'<small>, Create a Merp</small><br/>';
   ?>
             
               
               <script>edToolbar('wallpost'); </script>
                <textarea name="wallpost" id="wallpost" class="ed"></textarea>
                <!--<textarea name="wallpost" rows="2" cols="60"></textarea>-->
                <!--<input type="submit" value="POST" name="post" /><br/>-->
                <input type="image" src="images/post_button.gif" border=0 title="Click here to post your message" alt="Post"><br/>
                <small><a href="http://videos.meeplez.com">Upload Video|</a></small>
                  <small><a href="uploadpic.php">Upload Picture|</a></small>
                <small><a href="tips.php">Posting Tips</a></small></p>
              </form>
              <hr/>
              <h3>Recent Merps:</h3>
              
              <?php
                $sql = "SELECT profiles.photo, postings.postid, postings.text, postings.date, members.fname, members.lname, members.userid FROM profiles, postings, members, friends \n"
                  . "WHERE friends.userid='$userid' AND profiles.userid=friends.friendid AND \n"
                  . "friends.friendid=postings.wallid AND postings.wallid=postings.posterid AND \n"
                  . "postings.wallid=members.userid AND postings.type = 1 \n" 
                  . "UNION \n"
                  . "SELECT profiles.photo, postings.postid, postings.text, postings.date, members.fname, members.lname, members.userid FROM profiles, postings, members \n"
                  . "WHERE postings.wallid=postings.posterid AND postings.wallid='$userid' AND postings.wallid=members.userid AND postings.wallid=profiles.userid AND postings.type = 1 ORDER BY date desc";
                $result=mysql_query($sql);
                
                // Mysql_num_row is counting table row
                $count=mysql_num_rows($result);
                // If result matched $myusername and $mypassword, table row must be 1 row

                if($count>0){
                  for ($i=0; $i<$count; $i++)
                  {
                  $row = mysql_fetch_assoc($result);
                  $modtext = nl2br(bbcode_format($row["text"]));
                  print ("<table><tr>");
                  print ("<td width=100px><a href=memberpage.php?member=" . $row["userid"] . "><img border=0 height=50 src=/profilepics/" . $row['photo'] . " /></a></td>");
                  print ("<td><p><small><a href=memberpage.php?member=" . $row["userid"] . ">" . $row["fname"] . " " . $row["lname"] . "</a></small><br/>");
                  print ($modtext . "<br/>");
                  print ("<small>" . $row["date"] . "</small></p></td></tr>");
                  
                  //Process any comments
                  $postid = $row['postid'];
                  $sql_comments = "SELECT comments.posterid, comments.text, comments.date, profiles.photo, members.fname, members.lname, members.userid FROM comments, profiles, members \n"
                          . "WHERE comments.postid='$postid' AND comments.posterid=members.userid AND comments.posterid=profiles.userid ORDER BY comments.date ASC";
                  $result_comments=mysql_query($sql_comments);
                  $count_comments=mysql_num_rows($result_comments);
                  
                  if ($count_comments > 0) {                    
                    for ($j=0; $j<$count_comments; $j++)
                    {
                      $row2 = mysql_fetch_assoc($result_comments);
                      $modtext = nl2br(bbcode_format($row2["text"]));
                      print ("<tr><td></td><td>");
                      print ("<table><tr>");
                      print ("<td width=100px><a href=memberpage.php?member=" . $row2["userid"] . "><img border=0 height=50 src=/profilepics/" . $row2['photo'] . " /></a></td>");
                      print ("<td><p><small><a href=memberpage.php?member=" . $row2["userid"] . ">" . $row2["fname"] . " " . $row2["lname"] . "</a></small><br/>");
                      print ($modtext . "<br/>");
                      print ("<small>" . $row2["date"] . "</small></p></td></tr></table>");
                      print ("</td></tr>");
                    }
                  }
                  print ("<tr><td></td><td>");
                  print ("<form name=comment" . $postid . " method=post action=comment.php?postid=" . $postid . "&memberid=0>");
                  print ("<textarea onkeyup=CheckTextareaFieldSize(" . $postid . ") name='comment' id='comment' style='overflow:hidden;' cols=40 rows=1></textarea>");
                  print ("<input type='image' src='images/comment_button.jpeg' border=0 title='Click here to write a comment' alt='Post'><br/>");
                  
                  // close up
                  print ("</form></td></tr>");
                  print ("</table><hr/>\n\n");
                  }
                }
                                                                else print ("<p>You have not added any friends yet.  Once you do, you'll see their updates on this page.  You can then comment on their updates, or click to visit their pages.   How about doing a people search and finding some people that you know?</p>");

              ?>
            </div>
          </div>
        </div>
        <div id="col2">
		
		
          
               
          <?php
            print ("<p><a href=\"memberpage.php?member=$userid\">" . $fname . " " . $lname . "</a><br/>");
            print ("<small><a href=\"editprofile.php\">(Edit Profile)</a></small></p>");
          ?>
          <p><a href="friends.php">Friends</a></p>
          <a href="/support/">Submit a Ticket</a>
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
