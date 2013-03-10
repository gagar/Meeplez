<?php session_start(); ?>
<?php include("db.php"); ?>
<?php	
		if ($_SESSION['userid'] > 0) {
			$userid=$_SESSION['userid'];
			$sql="SELECT * FROM members WHERE userid='$userid' ";
			$result=mysql_query($sql);
		}
		else {
			// username and password sent from form 
			$email=$_POST['email']; 
			$password=md5($_POST['password']);

			$sql="SELECT * FROM members WHERE email='$email' and password='$password'";
			$result=mysql_query($sql);	
		}

		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		// If result matched $myusername and $mypassword, table row must be 1 row

		if($count==1){
			// Register userid, fname and redirect to file "mainpage.php"
			$row = mysql_fetch_assoc($result);
			$_SESSION['userid'] = $row["userid"];
			$_SESSION['fname'] = $row["fname"];
			$_SESSION['lname'] = $row["lname"];
			$_SESSION['host'] = $host;
			
			if (isset($_POST['setcookie']) && ($_POST['setcookie']=="1"))
				setcookie ("meeps", $row["userid"], time()+60*60*24*14);
			header("location:mainpage.php");
			}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
							<p style="color:red;";><img src="images/icon_alert_1.gif" /><strong>You have entered an invalid username and / or password.</strong></p>
							<h4>Retry your login below, or register for an account</h4>
							
							<p>New user?  <a href="register.php">[Register]</a> for an account to join the <em>Meeplez</em> community.</p>
							<table>
								<form method="post" action="login.php">
									<tr><td class="login">EMAIL</td><td><input type="text" name="email" /></td></tr>
									<tr><td class="login">PASSWORD</td><td><input type="password" name="password" /></td></tr>
									<tr><td class="login"></td><td><input type="checkbox" name="setcookie" value="1"/><small>Keep me logged in for the next two weeks</small></td></tr>
									<tr><td></td><td><input type="image" src="images/login-button.jpg" /></td></tr>
								</form>
							</table>							
						</div>
					</div>
				</div>
				<div id="col2">
				
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