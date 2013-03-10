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
	<title>Meeplez INBOX PAGE</title>
	</head>
	<body>
	<?php include("db.php"); ?>
	<?php include("convert_text.php"); ?>
	<?php
		$userid = $_SESSION['userid'];
		$fname = $_SESSION['fname'];
		$lname = $_SESSION['lname'];

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
							<h3>Inbox</h3>
							<div class="tabContent" id="tab1">
							<?php
								$member=$_GET['member'];
								$sql="SELECT postings.postid, postings.text, postings.date, members.fname, members.lname, members.userid FROM postings, members WHERE postings.wallid='$userid' AND postings.posterid=members.userid AND postings.type = 0 ORDER BY date desc";
								$result=mysql_query($sql);
								$count=mysql_num_rows($result);

								if($count>0){
									for ($i=0; $i<$count; $i++)
									{
									$row = mysql_fetch_assoc($result);
									$modtext = nl2br(bbcode_format($row["text"]));
									print ("<p><small><a href=memberpage.php?member=" . $row["userid"] . ">" . $row["fname"] . " " . $row["lname"] . "</a></small><br/>");
									print ("\"" . $modtext . "\"<br/>");
									print ("<small><a href=sendMessage.php?member=" . $row["userid"] . ">(Reply to " . $row["fname"] . ")</a></small>     <small><a href=deleteMessage.php?postid=" . $row["postid"] . ">(Delete this message)</a></small><br/>");
									print ("<small>" . $row["date"] . "</small></p><hr/>");
									}
								}
							?>

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
				
				</div>
			</div>
		</div>
	</div>		
	<div id="footer">
	
	</div>
	</body>
</html>