<?php
session_start();
if(isset($_SESSION[$userid])){
header("location:index.html");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">			
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    <link rel="shortcut icon" href="favicon.ico" >
    <link rel="icon" type="image/gif" href="animated_favicon1.gif" >
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="index.css" />
	<title>SEARCH</title>
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
								
								$sql="SELECT members.userid, members.fname, members.lname, profiles.photo FROM members, profiles WHERE members.userid=profiles.userid ORDER BY fname asc";
								$result=mysql_query($sql);

								// Mysql_num_row is counting table row
								$count=mysql_num_rows($result);
								// If result matched $myusername and $mypassword, table row must be 1 row
								
								print ("<h2> People on Meeplez.com: </h2>");
								if($count>0){
									print ("<table class=reg>");
									if (($count % 3) == 0)
										print ("<tr>");
									for ($i=0; $i<$count; $i++)
									{
									$row = mysql_fetch_assoc($result);
									print ("<td class=reg><img height=50% width=50% src=./profilepics/" . $row["photo"] . " />");
									print ("<br/><a href=memberpage.php?member=" . $row["userid"] . ">" . $row["fname"] . " " . $row["lname"] . "</a></td>");
									if (($i+1) % 3 == 0)
										print ("</tr>");
									}
									
									if (($i % 3) == 0)
										print ("<td></td><td></td></tr>");
									if (($i % 3) == 1)
										print ("<td></td></tr>");
									if (($i %3 ) == 2)
										print ("</tr>");
									print ("</table>");
								}
								else
									print ("<p>No one is registered.  It's a ghost town.</p>");
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