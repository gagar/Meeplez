<?php
session_start();
if(!isset( $_SESSION['userid'])) {
}

$userid=$_COOKIE["meeps"];
if ($userid>0) {
  $_SESSION["userid"]=$userid;
  header("location:login.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" type="image/gif" href="favicon.gif" />
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta name="description" content="Meeplez is a awesome social networking site. It at the moment does not have all the big features, but it will." /> 
  <meta name="keywords" content="feednight, social network, friends, networking, facebook, myspace, social" /> 
  <meta name="robots" content="index, nofollow" />
  <link rel="stylesheet" type="text/css" href="index.css" />
  <title>Meeplez.com</title>
  </head>
  <body>
  
  <div id="header">
    <div style=margin:25px;>
    <strong>Meeplez.com</strong>
    </div>
  </div>
    
  <div id="colmask"> 
    <div id="colmid"> 
      <div id="colright"> 
        <div id="col1wrap"> 
          <div id="col1pad"> 
            <div id="col1"> 
            <table>
              <tr>
                <td>
                  <h1>Welcome to meeplez.com</h1>
                                    
                  <p>New user?  <a href="register.php"><img src="http://www.figkids.com/photos/xy-register-button.png"></a> for an account to join the <em>meeplez</em> community.</p>
                  <table>
                    <form method="post" action="login.php">
                      <tr><td class="login">EMAIL</td><td><input type="text" name="email" /></td></tr>
                      <tr><td class="login">PASSWORD</td><td><input type="password" name="password" /></td></tr>
                      <tr><td class="login"></td><td><input type="checkbox" name="setcookie" value="1"/><small>Keep me logged in for the next two weeks</small></td></tr>
					  <tr><td></td><td><input type="image" src="images/login-button.jpg" /></td></tr>
                    </form>
                  </table>
                </td>
                </table>
              <br/><br/><br/>
            </div>
          </div>
        </div>
        <div id="col2">
			<p></p>
              </div>
        <div id="col3">      
		
        
        </div>
      </div>
    </div>
  </div>    
  </body>
    
</html>