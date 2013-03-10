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
							<h1>Posting Instructions</h1>
							<p>Here on Meeplez, you can enhance your wall posts by adding some text formatting and some color.  The codes work just like BBCode that many forums use.</p>
							<br/>			
							<p>You place the following codes around text you want to modify:</p>
							<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=ROWS FRAME=HSIDES>
								<tr height=25px;>
									<th width=250px;>BBCode</th>
									<th width=500px;>Sample Text</th>
								</tr>
								<tr height=25px;>
									<td>[br]</td>
									<td>inserts a line break (like hitting enter)</td>
								</tr>
								<tr height=25px;>
									<td>[b]bold text[/b]</td>
									<td><strong>bold text</strong></td>
								</tr>
								<tr height=25px;>
									<td>[i]italic text[/i]</td>
									<td><em>italic text</em></td>
								</tr>
								<tr height=25px;>
									<td>[u]underline text[/u]</td>
									<td><u>underline text</u></td>
								</tr>

								<tr height=25px;>
									<td>[color=purple]stuff[/color]</td>
									<td><span style=color:purple;>stuff will be purple</span></td>
								</tr>								
							</table>
							<p>For a complete listing of colors, <a href="http://www.w3schools.com/html/html_colornames.asp">[CLICK HERE]</a></p>
							<p>You can also combine codes.  Like [b][i][u] stuff [/u][/i][/b].  Just make sure to end the tags in the opposite order you open them, like the example.</p>
							<hr/>
							<p>There are also several smileys that the site will display.</p>
							<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLUMNS FRAME=BOX style="font-size:small;">
								<tr><td width=75px;>Smiley</td>
									<td width=35px;>:)</td>
									<td width=35px;>:d</td>
									<td width=35px;>:(</td>
									<td width=35px;>:p</td>
									<td width=35px;>;)</td>
									<td width=35px;>:'(</td>
									<td width=35px;>(turtle)</td>
									<td width=35px;>(heart)</td>
									<td width=35px;>(pizza)</td>
									<td width=35px;>(moon)</td>
									<td width=35px;>(idea)</td>
								</tr>
								<tr><td>Graphic</td>
									<td><img src="./images/msn_smiley.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_laugh.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_sad.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_tongue.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_wink.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_cry.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_turtle.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_heart.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_pizza.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_sleep.gif" alt="Smiley" align=middle /></td>
									<td><img src="./images/msn_idea.gif" alt="Smiley" align=middle /></td>
								</tr>
							</table>
							<hr/>
							<br/>
							<p><strong>Limited Time Harry Potter icons</strong></p>
							<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLUMNS FRAME=BOX style="font-size:small;">
								<tr><td>Text</td>
									<td>(hpglasses)</td>
								    <td>(hpsnitch)</td>
									<td>(hphogwarts)</td>
									<td>(hpletter)</td>
									<td>(hpmail)</td></tr>
								<tr><td>Graphic</td>
									<td><img src="./images/HarryPotter/Glasses.png" alt="Potter" height=40px /></td>
									<td><img src="./images/HarryPotter/GoldenSnitch.png" alt="Potter" height=40px /></td>
									<td><img src="./images/HarryPotter/Home.png" alt="Potter" height=40px /></td>
									<td><img src="./images/HarryPotter/Letter.png" alt="Potter" height=40px /></td>
									<td><img src="./images/HarryPotter/Mail.png" alt="Potter" height=40px /></td></tr>
								<tr><td>Text</td>
									<td>(hpnimbus)</td>
								    <td>(hpstone1)</td>
									<td>(hpstone2)</td>
									<td>(hptail)</td>
									<td>(hphat)</td></tr>
								<tr><td>Graphic</td>
									<td><img src="./images/HarryPotter/Nimbus2000.png" alt="Potter" height=40px /></td>
								    <td><img src="./images/HarryPotter/PhilosophersStone.png" alt="Potter" height=40px /></td>
									<td><img src="./images/HarryPotter/PhilosophersStone2.png" alt="Potter" height=40px /></td>
									<td><img src="./images/HarryPotter/PigsTail.png" alt="Potter" height=40px /></td>
									<td><img src="./images/HarryPotter/SortingHat.png" alt="Potter" height=40px /></td></tr>
							</table>
							
							<hr/>
							<br/>
							<p><strong>Holiday icons</strong></p>
							<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLUMNS FRAME=BOX style="font-size:small;">
								<tr><td>Text</td>
								    <td>:bells:</td>
									<td>:snowflake1:</td>
									<td>:candycane:</td>
									<td>:bells2:</td>
									<td>:xmastree:</td>
									<td>:wreath:</td>
									<td>:gift1:</td></tr>
								<tr><td>Graphic</td>
								    <td><img src="./images/xmas/Bell-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/blue-snow-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/candy-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/christmas-bells-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/christmas-tree-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/christmas-wreath-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/giftbox-blue-icon.png" alt="Holiday Icon" /></td></tr>
								<tr><td>Text</td>
								    <td>:gift2:</td>
									<td>:santa1:</td>
									<td>:santa2:</td>
									<td>:santahat:</td>
									<td>:snowballs:</td>
									<td>:snowflake2:</td>
									<td></td></tr> 	
								<tr><td>Graphic</td>
								    <td><img src="./images/xmas/giftbox-purple-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/santa-gifts-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/Santa-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/santas-hat-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/snowballz-icon.png" alt="Holiday Icon" /></td>
									<td><img src="./images/xmas/white-snow-icon.png" alt="Holiday Icon" /></td>
									<td></td></tr>
							</table>
							
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
					<p><a href="inbox.php">Inbox</a></p>
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

