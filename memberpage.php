<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">      
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="index.css" />
  <script type="text/javascript" src="tabscript.js"></script>
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
  <title>
    <?php
  if($_SESSION['userid'])
  echo ''.$_SESSION['member'].' Profile';
      ?>
    </title>
  </head>
  <body>
  <?php include("db.php"); ?>
  <?php include("convert_text.php"); ?>
  <?php
    $userid = $_SESSION['userid'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $member = $_GET['member'];

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
            
              <?php
                // Check if already a friend
                $sql="SELECT userid FROM friends WHERE friends.userid='$userid' AND friends.friendid='$member'";
                $result=mysql_query($sql);
                $count=mysql_num_rows($result);
                if ($count==0)
                  $isFriend=false;
                else
                  $isFriend=true;
                  
                $sql="SELECT * FROM members WHERE userid = $member";
                $result=mysql_query($sql) or die ("Could not get user info!");
                $row = mysql_fetch_assoc($result);
                $memberfname = $row["fname"];
                $memberlname = $row["lname"];
                
                $sql="SELECT bio, photo FROM profiles WHERE userid = $member";
                $result=mysql_query($sql) or die ("Error getting profile information");
                $count=mysql_num_rows($result);
                if ($count>0) {
                  $row_bio=mysql_fetch_assoc($result);
                  $bio=$row_bio["bio"];
                  $pic = $row_bio["photo"];
                }
                else {
                  $bio="";
                  $pic = "profile_blank.jpg";
                }
                
                $bio = nl2br(bbcode_format($bio));
                print ("<table><tr><td style=width:225px;><img src=./profilepics/" . $pic . " /></td>");
                print ("<td><h3>$memberfname $memberlname</h3>");
                print ("<p><small><em>" . $row["city"] . ", " . $row["state"] . "</em></small></p>About Me: <br/><span style=font-size:90%>" . $bio . "</span><br/></td></tr></table>");
                if ((!($isFriend==true)) && ($userid != $member))
                  print ("<div style='float:right;'><a href=\"addfriend.php?member=" . $member . "\">[ADD FRIEND]</a></div>");
                if ($userid != $member) print ("<div style='float:right;'><a href=\"sendMessage.php?member=" . $member . "\">[SEND MESSAGE]</a></div>");
                print ("<p>");
              ?>
              

              
              <ul id="tabs">
                <li><a href="#tab1">Main</a></li>
                <li><a href="#tab2">Info</a></li>
                <li><a href="#tab3">Find Me</a></li>
              </ul>
              
              <!-- TAB 1 - WALL -->
              
              <div class="tabContent" id="tab1">
              <?php
              
              
              if ($isFriend==true || $userid == $member)
              {
                $member = $_GET['member'];
                print ('<form method="post" action="post2.php?post2=' . $member . '">');
                print ('<p><small>Leave a Merp</small><br/>');
                print ("<script>edToolbar('wallpost'); </script>");
                print ('<textarea name="wallpost" id="wallpost" class="ed"></textarea>');
                print ('<input type="image" src="images/post_button.gif" border=0 title="Click here to post your message" alt="Post"><br/>');
                print ('<small><a href="tips.php">Posting Tips</a></small></p><hr/>');
                print ('</form>');
              }
              
                $member=$_GET['member'];
                $sql="SELECT profiles.photo, postings.postid, postings.text, postings.date, members.fname, members.lname, members.userid FROM profiles, postings, members WHERE postings.wallid='$member' AND postings.posterid=members.userid AND postings.posterid=profiles.userid AND postings.type = 1 ORDER BY date desc";
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
                  print ("<small>" . $row["date"] . "     </small>");
                  if ($userid == $member)
                    print ("<small><a href=deletechirp.php?postid=" . $row['postid'] . "&memberid=" . $row['userid'] . ">(Delete this merp)</a></small>");
                  print ("</p></div></td></tr>");
                  
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
                  print ("<form name=comment" . $postid . " method=post action=comment.php?postid=" . $postid . "&memberid=" . $member . ">");
                  print ("<textarea onkeyup=CheckTextareaFieldSize(" . $postid . ") name='comment' id='comment' style='overflow:hidden;' cols=40 rows=1></textarea>");
                  print ("<input type='image' src='images/comment_button.jpeg' border=0 title='Click here to write a comment' alt='Post'><br/>");
                  
                  // close up
                  print ("</form></td></tr>");
                  print ("</table><hr/>\n\n");
                  }                  
                }
              ?>

              </div>
              <!-- TAB 1 end -->
              
              <!-- TAB 2 - PROFILE -->
              <div class="tabContent" id="tab2">
              <?php
                $member=$_GET['member'];
                $sql="SELECT * FROM profiles WHERE profiles.userid='$member'";
                $result=mysql_query($sql);

                // Mysql_num_row is counting table row
                $count=mysql_num_rows($result);

                if($count>0){
                  $row = mysql_fetch_assoc($result);
                  print ("<h4>Activities</h4>");
                  $modtext = nl2br(bbcode_format($row["activities"]));
                  print ("<p>" .$modtext . "</p><hr/>");
                  
                  print ("<h4>Interests</h4>");
                  $modtext = nl2br(bbcode_format($row["interests"]));
                  print ("<p>" .$modtext . "</p><hr/>");
                  
                  print ("<h4>Music</h4>");
                  $modtext = nl2br(bbcode_format($row["music"]));
                  print ("<p>" .$modtext . "</p><hr/>");
                  
                  print ("<h4>Books</h4>");
                  $modtext = nl2br(bbcode_format($row["books"]));
                  print ("<p>" .$modtext . "</p><hr/>");
                  
                  print ("<h4>Television</h4>");
                  $modtext = nl2br(bbcode_format($row["tv"]));
                  print ("<p>" .$modtext . "</p><hr/>");
                  
                  print ("<h4>Movies</h4>");
                  $modtext = nl2br(bbcode_format($row["movies"]));
                  print ("<p>" .$modtext . "</p><hr/>");
                  
                  print ("<h4>Foods</h4>");
                  $modtext = nl2br(bbcode_format($row["foods"]));
                  print ("<p>" .$modtext . "</p><hr/>");
                  
                  print ("<h4>Education</h4>");
                  $modtext = nl2br(bbcode_format($row["education"]));
                  print ("<p>" .$modtext . "</p><hr/>");
                  
                  print ("<h4>Employment</h4>");
                  $modtext = nl2br(bbcode_format($row["work"]));
                  print ("<p>" .$modtext . "</p><hr/>");
                  
                  print ("<h4>Relationship</h4>");
    
                }
              ?>
              </div>
              
              <!-- TAB 2 end -->

              <!-- TAB 3 - FIND ME -->
              <div class="tabContent" id="tab3">
              <table class="reg">
              <?php
                if ($isFriend==true || $userid == $member) {
                  $member=$_GET['member'];
                  $sql="SELECT * FROM profiles WHERE profiles.userid='$member'";
                  $result=mysql_query($sql);

                  // Mysql_num_row is counting table row
                  $count=mysql_num_rows($result);

                  if($count>0){
                    $row = mysql_fetch_assoc($result);
                    if (!$row['aim']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/aim.jpeg\" /></td>");
                      print ("<td><a href=\"aim:goim?screenname=" . $row['aim'] . "\" target=\"_blank\">" . $row['aim'] . "</a></td>");
                      print ("</tr>");
                    }
                    
                    if (!$row['google']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/google_talk.jpeg\" /></td>");
                      print ("<td><a href=\"gtalk:chat?jid=" . $row['google'] . "\" target=\"_blank\">" . $row['google'] . "</a></td>");
                      print ("</tr>");                    
                    }

                    if (!$row['skype']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/skype.jpeg\" /></td>");
                      print ("<td><a href=\"skype:" . $row['skype'] . "?call\" target=\"_blank\">" . $row['skype'] . "</a></td>");
                      print ("</tr>");
                    }
                    
                    if (!$row['windowslive']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/windows_live.jpeg\" /></td>");
                      print ("<td><a href=\"msnim:chat?contact=" . $row['windowslive'] . "\" target=\"_blank\">" . $row['windowslive'] . "</a></td>");
                      print ("</tr>");
                    }
                    
                    if (!$row['yim']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/yahoo.jpeg\" /></td>");
                      print ("<td><a href=\"ymsgr:sendim?" . $row['yim'] . "\" target=\"_blank\">" . $row['yim'] . "</a></td>");
                      print ("</tr>");  
                    }

                    if (!$row['icq']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/icq.jpeg\" /></td>");
                      print ("<td><a href=\"http://wwp.mirabilis.com/" . $row['icq'] . "#pager\" target=\"_blank\"> " . $row['icq'] . "</a></td>");
                      print ("</tr>");    
                    }

                    if (!$row['facebook']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/facebook.jpeg\" /></td>");
                      print ("<td><a href=\"http://www.facebook.com/" . $row['facebook'] . "\" target=\"_blank\">" . $row['facebook'] . "</a></td>");
                      print ("</tr>");
                    }

                    if (!$row['myspace']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/myspace.jpeg\" /></td>");
                      print ("<td><a href=\"http://www.myspace.com/" . $row['myspace'] . "\" target=\"_blank\">" . $row['myspace'] . "</a></td>");
                      print ("</tr>");
                    }

                    if (!$row['twitter']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/twitter.jpeg\" /></td>");
                      print ("<td><a href=\"http://www.twitter.com/" . $row['twitter'] . "\" target=\"_blank\">" . $row['twitter'] . "</a></td>");
                      print ("</tr>");  
                    }

                    if (!$row['youtube']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/youtube.jpeg\" /></td>");
                      print ("<td><a href=\"http://www.youtube.com/user/" . $row['youtube'] . "\" target=\"_blank\">" . $row['youtube'] . "</a></td>");
                      print ("</tr>");
                    }

                    if (!$row['bebo']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/bebo.jpeg\" /></td>");
                      print ("<td><a href=\"http://www.bebo.com/" . $row['bebo'] . "\" target=\"_blank\">" . $row['bebo'] . "</a></td>");
                      print ("</tr>");  
                    }

                    if (!$row['flickr']=="") {
                      print ("<tr>");
                      print ("<td class=\"reg\"><img src=\"./images/logos/flickr.jpeg\" /></td>");
                      print ("<td><a href=\"http://www.flickr.com/photos/" . $row['flickr'] . "\" target=\"_blank\">" . $row['flickr'] . "</td>");
                      print ("</tr>");  
                    }
                  }
                }
                else
                  print ("<tr><td>Sorry, but you must be friends with someone before you can see this tab.</td></tr>");
              ?>
              </table>
              </div>
              
              <!-- TAB 3 end -->              
            </div>
          </div>
        </div>
        <div id="col2">
          <?php
            print ("<p><a href=\"memberpage.php?member=$userid\">" . $fname . " " . $lname . "</a><br/>");
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
                <?php
                  
                  $sql="SELECT members.fname, members.lname, members.userid FROM members, friends WHERE friends.userid='$member' AND members.userid=friends.friendid ORDER BY members.lname";
                  $result=mysql_query($sql);

                  // Mysql_num_row is counting table row
                  $count=mysql_num_rows($result);
                  // If result matched $myusername and $mypassword, table row must be 1 row
                  
                  print ("<br/><br/><hr/><h5>" . $memberfname. "'s Friends: </h5>");
                  if($count>0){
                    for ($i=0; $i<$count; $i++)
                    {
                    $row = mysql_fetch_assoc($result);
                    print ("<p><a href=memberpage.php?member=" . $row["userid"] . ">" . $row["fname"] . " " . $row["lname"] . "</a></p>");
                    }
                  }
                  else
                    print ("<p>$memberfname hasn't added any friends yet.</p>");
                ?>

        </div>
        <div id="col3">
        
        </div>
      </div>
    </div>
  </div>    
  <div id="footer">
  
  </div>
  <script>init();</script>
  </body>
</html>