<?php
session_start();
if(isset($_SESSION[$userid])){
header("location:index.html");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <link rel="shortcut icon" href="favicon.ico" >
    <link rel="icon" type="image/gif" href="animated_favicon1.gif" >
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="index.css" />
  <link rel="stylesheet" type="text/css" href="./css/custom-theme/jquery-ui-1.8.17.custom.css" />
  <script type="text/javascript" src="./bbeditor/ed.js"></script>
  <script type="text/javascript" src="./js/textareafieldsize.js"></script>
  <script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="./js/jquery-ui-1.8.17.custom.min.js"></script>
  <script type="text/javascript" src="./js/myjavascript.js"></script>  
  <script type="text/javascript">
  //<![CDATA[
    function setHelp(x) {
      document.getElementById(x).rows="10";
      if (x=="bio") document.getElementById('help').innerHTML="<h3>About Me</h3>Enter general information about yourself here. <br/><br/> Don't forget, you can use the text formatting codes work here to spice your profile up some.";
      if (x=="activities") document.getElementById('help').innerHTML="<h3>Activities</h3>Tell about the things you like to do here...  hiking, camping, sleeping...  you get the idea!";
      if (x=="interests") document.getElementById('help').innerHTML="<h3>Interests</h3>What are your interests?  <br/><br/>Cars? Computers? Stamp Collecting? Celebrities?";
      if (x=="music") document.getElementById('help').innerHTML="<h3>Music</h3>Country?  Jazz?  Today's hits?  <br/><br/>Let everyone know the music and artists that you enjoy listening to.";
      if (x=="books") document.getElementById('help').innerHTML="<h3>Books</h3>Do you love a good mystery?  Maybe a romance novel.  How about reading a terrifying thriller when all the lights are out, and no one's awake?  <br/><br/>Tell everyone what your favorite books are here!";
      if (x=="tv") document.getElementById('help').innerHTML="<h3>TV</h3>The boob tube, the idiot box, the small screen...  whatever you call your television (I'll call mine Steve), here's where you can talk about what you like to watch!";
      if (x=="movies") document.getElementById('help').innerHTML="<h3>Movies</h3>The big screen!  Hollywood!  What movies get you going to the theater, and which ones do you just watch over and over again?";
      if (x=="foods") document.getElementById('help').innerHTML="<h3>Foods</h3>Apples, peaches, pumpkin pie...  or burgers and fries.  <br/><br/>What are your favorite foods?";
    }
    
    function resetSize(x) {
      document.getElementById('help').innerHTML="<h3>Editing</h3>You can use all the BBCode formatting that you use when 'chirping'. <br/><br/> Those same codes work here to spice your profile up some.";
      document.getElementById(x).rows="1";
    }
    
    function setHelpEE(x) {
      if (x=="education") document.getElementById('help').innerHTML="<h3>Education</h3>Where did you go to school?<br/><br/>Where are you currently going to school?<br/><br/>Where did you attend until you were expelled for putting gum on the bottom of the desks?  ";
      if (x=="work") document.getElementById('help').innerHTML="<h3>Employment</h3>Jobs...  we all need one if we plan on having any money.<br/><br/>Where do you work?";
    }
    
    function setHelpNetwork(x) {
      if (x=="aim") document.getElementById('help').innerHTML="<h3>AIM</h3>Only enter your AIM id here.  Charple will create a link so that others can send you an IM!";
      if (x=="google") document.getElementById('help').innerHTML="<h3>Google Talk</h3>Only enter your Google Talk id here (usually your full gmail address).  Charple will create a link so that others can send you an IM!";
      if (x=="skype") document.getElementById('help').innerHTML="<h3>Skype</h3>Enter your Skype id here.  Charple will create a link so that others can send you an IM!";
      if (x=="windowslive") document.getElementById('help').innerHTML="<h3>Windows Live</h3>Enter your Windows Live id here.  Charple will create a link so that others can send you an IM!";
      if (x=="yim") document.getElementById('help').innerHTML="<h3>Yahoo Messenger</h3>Enter your Yahoo Messenger id here.  Charple will create a link so that others can send you an IM!";
      if (x=="icq") document.getElementById('help').innerHTML="<h3>ICQ</h3>Enter your ICQ id here.  Charple will create a link so that others can send you an IM!";
      if (x=="facebook") document.getElementById('help').innerHTML="<h3>Facebook</h3>Enter your Facebook id here.  Charple will create a link to your profile page.";
      if (x=="myspace") document.getElementById('help').innerHTML="<h3>MySpace</h3>Enter your Myspace id here.  Charple will create a link to your profile page.";
      if (x=="twitter") document.getElementById('help').innerHTML="<h3>Twitter</h3>Enter your Twitter id here.  Charple will create a link to your Twitter account.";
      if (x=="youtube") document.getElementById('help').innerHTML="<h3>YouTube</h3>Enter your YouTube id here.  Charple will create a link to your YouTube page.!";
      if (x=="bebo") document.getElementById('help').innerHTML="<h3>Bebo</h3>Enter your Bebo id here.  Charple will create a link to your Beebo account.";
      if (x=="flickr") document.getElementById('help').innerHTML="<h3>Flickr</h3>Enter your Flickr id here.  Charple will create a link to your Flickr page.";
      if (x=="Xbox") document.getElementById('help').innerHTML="<h3>Xbox</h3>Enter your Xbox Gamertag id here. Charple will create a link to your Xbox account.";
      if (x=="Tumblr") document.getElementById('help').innerHTML="<h3>Tumblr</h3>Enter your Tumblr id here. Charple will create a link to your tumblr account.";
    }
    
    function setHelpNetwork(x) {
      if (x=="music") document.getElementById('help').innerHTML="<h3>AIM</h3>Enter your favorite music here.  Charple will create a link so that you can play it from your profile";
          }
    
    function unsetHelp(x) {
      document.getElementById('help').innerHTML="<h3>Editing</h3>You can use all the BBCode formatting that you use when 'chirping'. <br/><br/> Those same codes work here to spice your profile up some.";
    }
    //]]>
  </script>
  <title>Profile Editor</title>
  </head>
  <body>
  <?php include("db.php"); ?>
  <?php include("convert_text.php"); ?>
  <?php
    $userid = $_SESSION['userid'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $saved = $_GET['saved'];
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
                $sql="SELECT * FROM profiles WHERE userid='$userid'";
                $result=mysql_query($sql);
                $row = mysql_fetch_assoc($result);
                if ($saved)
                  print("<p><font color=red>Your changes have been saved!!!</font></p>");
              ?>
              <div id="tabs">
              <ul style="font-size:75%;">
                <li><a href="#tab1">Main Profile</a></li>
                <li><a href="#tab2">Profile Photo</a></li>
                <li><a href="#tab3">Family</a></li>
                <li><a href="#tab4">Pets</a></li>
                <li><a href="#tab5">Education and Work</a></li>
                <li><a href="#tab6">Networking</a></li>
              </ul>
              
              <!-- TAB 1 - MAIN PROFILE -->
              <div class="tabContent" id="tab1">
                <h3>Profile Editor</h3>
                <hr/>
                <form method="post" action="saveprofile.php">
                  <table class="reg">
                    <tr><td></td>
                      <td style=text-align:right;><input type="submit" value="Save Changes" /></td></tr>
                    <tr><td class="reg">About Me</td>
                      <td><textarea id="bio" name="bio" onfocus=setHelp(this.id) onblur=resetSize(this.id) rows="1" cols="50"><?php echo $row['bio']?></textarea></td></tr>
                    <tr><td class="reg">Activities</td>
                      <td><textarea id="activities" name="activities" onfocus=setHelp(this.id) onblur=resetSize(this.id) rows="1" cols="50"><?php echo $row['activities']?></textarea></td></tr>
                    <tr><td class="reg">Interests</td>
                      <td><textarea id ="interests" name="interests" onfocus=setHelp(this.id) onblur=resetSize(this.id) rows="1" cols="50"><?php echo $row['interests']?></textarea></td></tr>
                    <tr><td class="reg">Music</td>
                      <td><textarea id="music" name="music" onfocus=setHelp(this.id) onblur=resetSize(this.id) rows="1" cols="50"><?php echo $row['music']?></textarea></td></tr>
                    <tr><td class="reg">Books</td>
                      <td><textarea id="books" name="books" onfocus=setHelp(this.id) onblur=resetSize(this.id) rows="1" cols="50"><?php echo $row['books']?></textarea></td></tr>
                    <tr><td class="reg">Televison</td>
                      <td><textarea id="tv" name="tv" onfocus=setHelp(this.id) onblur=resetSize(this.id) rows="1" cols="50"><?php echo $row['tv']?></textarea></td></tr>
                    <tr><td class="reg">Movies</td>
                      <td><textarea id="movies" name="movies" onfocus=setHelp(this.id) onblur=resetSize(this.id) rows="1" cols="50"><?php echo $row['movies']?></textarea></td></tr>
                    <tr><td class="reg">Foods</td>
                      <td><textarea id="foods" name="foods" onfocus=setHelp(this.id) onblur=resetSize(this.id) rows="1" cols="50"><?php echo $row['foods']?></textarea></td></tr>                    
                  
                  </table>
                </form>
              </div>
              <!-- TAB 1 end -->
              
              <!-- TAB 2 - Profile Picture -->
              <div class="tabContent" id="tab2">
                <h3>Profile Picture</h3>
                <hr/>
                <p>Current Photo:</p>
                <?php $pic = './profilepics/' . $row['photo']; ?>
                <img src="<?php echo $pic ?>" alt="Profile Picture" />
                <?php
                // filename: upload.form.php
                // first let's set some variables
                // make a note of the current working directory relative to root.
                $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

                // make a note of the location of the upload handler script
                $uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

                // set a max file size for the html upload form
                $max_file_size = 3000000; // size in bytes

                ?>
    
                <form id="Upload" action="<?php echo $uploadHandler ?>" enctype="multipart/form-data" method="post">
                  <p><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>"></p>
                  <p>
                    <label for="file">File to upload:</label>
                    <input id="file" type="file" name="file">
                  </p>
                  <p>
                    <label for="submit">Press to...</label>
                    <input id="submit" type="submit" name="submit" value="Upload me!">
                  </p>
                </form>
 
              </div>
              <!-- TAB 2 end -->
              
              <!-- TAB 3 - Family -->
              <div class="tabContent" id="tab3">
                <h3>Family</h3>
                <hr/>
                <p><form method="post" action="saveprofileEE.php">
                  <table class="reg">
                    <tr><td></td>
                      <td style=text-align:right;><input type="submit" value="Save Changes" /></td></tr>                  
                    <tr><td class="reg">Relationship</td>
                      <td>
                        <select>
                            <option>Single</option>
                            <option>In a Relationship</option>
                            <option>Married</option>
                        </select>
                      </td></tr>
                          
                  </table>
                </form>              
              </p>              
              
              </div>
              <!-- TAB 3 end -->

              <!-- TAB 4 - Pets -->
              <div class="tabContent" id="tab4">
                <h3>Pets</h3>
                <hr/>
                <p>Coming soon...</p>              
              </div>
              <!-- TAB 4 end -->
              
              <!-- TAB 5 - Education / Work -->
              <div class="tabContent" id="tab5">
                <h3>Education and Work</h3>
                <hr/>
                <form method="post" action="saveprofileEE.php">
                  <table class="reg">
                    <tr><td></td>
                      <td style=text-align:right;><input type="submit" value="Save Changes" /></td></tr>                  
                    <tr><td class="reg">Education</td>
                      <td><textarea id="education" name="education" onfocus=setHelpEE(this.id) onblur=unsetHelp(this.id) rows="10" cols="50"><?php echo $row['education']?></textarea></td></tr>
                    <tr><td class="reg">Employment</td>
                      <td><textarea id="work" name="work" onfocus=setHelpEE(this.id) onblur=unsetHelp(this.id) rows="10" cols="50"><?php echo $row['work']?></textarea></td></tr>        
                  </table>
                </form>              
              
              </div>
              <!-- TAB 5 end -->

              <!-- TAB 6 - Networking -->
              <div class="tabContent" id="tab6">
                <h3>Networking</h3>
                <hr/>
                <form method="post" action="saveprofileNW.php">
                  <table>
                    <tr><td></td>
                      <td style=text-align:right;><input type="submit" value="Save Changes" /></td></tr>                  
                    <tr><td><img src="./images/logos/aim.jpeg" /></td>
                      <td style=width:250px><input type="text" name="aim" id="aim" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['aim'] ?>"/></td>
                    <td><img src="./images/logos/google_talk.jpeg" /></td>
                      <td><input type="text" name="google" id="google" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['google'] ?>"/></td></tr>
                      
                    <tr><td><img src="./images/logos/skype.jpeg" /></td>
                      <td><input type="text" name="skype" id="skype" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['skype'] ?>"/></td>
                    <td><img src="./images/logos/windows_live.jpeg" /></td>
                      <td><input type="text" name="windowslive" id="windowslive" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['windowslive'] ?>"/></td></tr>
                      
                    <tr><td><img src="./images/logos/yahoo.jpeg" /></td>
                      <td><input type="text" name="yim" id="yim" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['yim'] ?>"/></td>
                    <td><img src="./images/logos/icq.jpeg" /></td>
                      <td><input type="text" name="icq" id="icq" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['icq'] ?>"/></td></tr>
                      
                    <tr><td><img src="./images/logos/facebook logo.png" /></td>
                      <td><input type="text" name="facebook" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) id="facebook" value="<?php echo $row['facebook'] ?>"/></td>
                    <td><img src="./images/logos/myspace.jpeg" /></td>
                      <td><input type="text" name="myspace" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) id="myspace" value="<?php echo $row['myspace'] ?>"/></td></tr>
                      
                    <tr><td><img src="./images/logos/Twitter-logo.png" /></td>
                      <td><input type="text" name="twitter" id="twitter" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['twitter'] ?>"/></td>
                    <td><img src="./images/logos/youtube.png" /></td>
                      <td><input type="text" name="youtube" id="youtube" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['youtube'] ?>"/></td></tr>
                      
                    <tr><td><img src="./images/logos/bebo.jpeg" /></td>
                      <td><input type="text" name="bebo" id="bebo" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['bebo'] ?>"/></td>
                    
                    <td><img src="./images/logos/flickr.jpeg" /></td>
                      <td><input type="text" name="flickr" id="flickr" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['flickr'] ?>"/></td></tr>
                    
                    <tr><td><img src="./images/logos/xbox360-logo-image_normal.jpg" /></td>
                      <td><input type="text" name="Xbox Gamertag" id="Xbox" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['Xbox'] ?>"/></td></tr>
                    
              
                    <tr><td><img src="./images/logos/tumblr.png" /></td>
                      <td><input type="text" name="Tumblr" id="Tumblr" onfocus=setHelpNetwork(this.id) onblur=unsetHelp(this.id) value="<?php echo $row['Tumblr'] ?>"/></td></tr>
                      
                  </table>
                </form>
              </div>
              <!-- TAB 6 end -->  
              </div>
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
        </div>
        <div id="col3">
          <br/><br/><br/><br/><span id="help"><h3>Editing</h3>You can use all the BBCode formatting that you use when "merping". <br/><br/> Those same codes work here to spice your profile up some.</span>
        </div>
      </div>
    </div>
  </div>    
  <div id="footer">
  
  </div>
  <script>init();</script>
  </body>
</html>