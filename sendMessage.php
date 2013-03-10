<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:index.html");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">			
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="index.css" />
	<title>Meeplez SEND MESSAGE</title>
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
						
						
						<form method="post" action="post3.php?post3=<?php echo $member ?>">
							<h3>Send Message!!!</h3>
							<textarea name="wallpost" rows="20" cols="40"></textarea><br /><br />
							<input name="post" type="submit" value="Send Message!" />
						</form>
						
						
							
													
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
						$sql="SELECT * FROM members WHERE userid = $member";
						$result=mysql_query($sql) or die ("Could not get user info!");
						$row = mysql_fetch_assoc($result);
						$memberfname = $row["fname"];
						$memberlname = $row["lname"];
						
						
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
	</body>
</html>