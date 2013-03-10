<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="index.css" />
	<title>Meeplez registration</title>
	</head>
	<body>
	<?php
		function validate_email($vemail) {

		   //check for all the non-printable codes in the standard ASCII set,
		   //including null bytes and newlines, and exit immediately if any are found.
		   if (preg_match("/[\\000-\\037]/",$vemail)) {
			  return false;
		   }
		   $pattern = "/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD";
		   if(!preg_match($pattern, $vemail)){
			  return false;
		   }
		   
		   return true;
		} // end function validate_email
	?>
		<?php include("db.php"); ?>
	
		<?php
		// Get registration info
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zipcode'];
		$email = $_POST['email'];
		
		$sql="SELECT * FROM members WHERE email='$email'";
		$result=mysql_query($sql);

		$count=mysql_num_rows($result);
		if ($count>0) die ("That email account already exists in the database!<br/>Please use the back button and try again");
		
		if ($_POST['password']=="") die ("You must enter a password<br/>Please use the back button and try again");
		if ($_POST['password']!=$_POST['password2']) die ("Passwords do not match!<br/>Please use the back button and try again");
		$password = md5($_POST['password']);
		$birthday = $_POST['year'] . $_POST['month'] . $_POST['day'];
		
		if (!validate_email($email)) die ("INVALID EMAIL ADDRESS<br/>Please use the back button and try again");
		if ($fname=="") die ("You must enter a FIRST NAME<br/>Please use the back button and try again");
		if ($lname=="") die ("You must enter a LAST NAME<br/>Please use the back button and try again");
		
		$sql="INSERT INTO members (fname, lname, address1, address2, city, state, zip, email, password, birthday)
			 VALUES ('$fname','$lname','$address1', '$address2', '$city', '$state', '$zip', '$email', '$password', '$birthday')";
		mysql_query($sql);
		
		$sql="SELECT userid FROM members WHERE email='$email'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$userid = $row["userid"];
		
		// create new profiles table
		$sql="INSERT INTO profiles (userid) VALUES ('$userid')";
		mysql_query($sql);
		?>
		<h2>You are now registered</h2>
		<p>Click <a href=index.php>[here]</a> to return to the login page</p>
	</body>
</html>