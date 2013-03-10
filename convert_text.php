<?php  
  
function bbcode_format ($str) {  
    $str = htmlentities($str);  
  
    $simple_search = array( 
		'/\[YOUTUBE\](.*?)\[\/YOUTUBE\]/is',			// YOUTUBE VIDEO
		'/\[br\]/is',  								// line break
		'/\[b\](.*?)\[\/b\]/is',  					// bold
		'/\[i\](.*?)\[\/i\]/is',  					// italics
		'/\[u\](.*?)\[\/u\]/is',  					// underline
		'/\[url\=(.*?)\](.*?)\[\/url\]/is',  		// URL
		'/\[url\](.*?)\[\/url\]/is',  				// URL
		//'/\[img\](.*?)\[\/img\]/is',  				// IMG
		'/\[LIST\=1\](.*?)\[\/LIST\]/is',			// Ordered List
		'/\[LIST\](.*?)\[\/LIST\]/is',				// Un-Ordered List
		'/\[\*\]/is',								// List Item
		'/\[font\=(.*?)\](.*?)\[\/font\]/is',  		// font
		'/\[size\=(.*?)\](.*?)\[\/size\]/is',  		// font size
		'/\[color\=(.*?)\](.*?)\[\/color\]/is',  	// font color
		'/:\)/is',									// smiley
		'/:d/is',									// laugh smiley
		'/:\(|:-\(/is',								// sad face
		'/:p/is',									// tongue
		'/;-\)|;\)/is',								// wink
		'/:\'\(/is',								// cry
		'/\(turtle\)/is',							// turtle
		'/\(heart\)/is',							// heart
		'/\(pizza\)/is',							// pizza
		'/\(moon\)/is',								// moon
		'/\(tuxedo\)/is',							// penguin
		'/\(idea\)/is',								// idea
		'/\(peanut\)/is',							// peanut
		'/\(hpglasses\)/is', 						// Harry Potter Glasses
		'/\(hpsnitch\)/is', 						// Harry Potter Golden Snitch
		'/\(hphogwarts\)/is',						// Harry Potter Hogwarts
		'/\(hpletter\)/is',							// Harry Potter Letter
		'/\(hpmail\)/is',							// Harry Potter Mail
		'/\(hpnimbus\)/is',							// Harry Potter Nimbus 2000
		'/\(hpstone1\)/is',							// Harry Potter Philosophers Stone 1
		'/\(hpstone2\)/is',							// Harry Potter Philosophers Stone 2
		'/\(hptail\)/is',							// Harry Potter Pig's Tail
		'/\(hphat\)/is',							// Harry Potter Sorting Hat
		'/\:bells\:/is',									// Holiday Bells
		'/\:snowflake1\:/is',								// Holiday Snowflake 1
		'/\:candycane\:/is', 								// Holiday Candy Cane
		'/\:bells2\:/is',									// Holiday Bells
		'/\:xmastree\:/is',								// Holiday Xmas Tree
		'/\:wreath\:/is',									// Holiday Wreath
		'/\:gift1\:/is',									// Holiday Gift 1
		'/\:gift2\:/is',									// Holiday Gift 2
		'/\:santa1\:/is', 								// Holiday Santa 1
		'/\:santa2\:/is', 								// Holiday Santa 2
		'/\:santahat\:/is', 								// Holiday Santa Hat
		'/\:snowballs\:/is', 								// Holiday Snowballs
		'/\:snowflake2\:/is',								// Holiday Snowflake 2
		'/\:wow\:/is'								// World of Warcraft
	);  
  
    $simple_replace = array(  
		'<br/><iframe width="384" height="225" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe><br/>',
		'<br />',  
		'<strong>$1</strong>',  
		'<em>$1</em>',  
		'<u>$1</u>',  
		'<a href="$1" rel="nofollow" title="$2 - $1">$2</a>',  
		'<a href="$1" rel="nofollow" title="$1">$1</a>',  
		//'<img src="$1" alt="" />',
		'<ol>$1</ol>',
		'<ul>$1</ul>',
		'<li>',
		'<span style="font-family: $1;">$2</span>',  
		'<span style="font-size: $1;">$2</span>',  
		'<span style="color: $1;">$2</span>',
		'<img src="./images/msn_smiley.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_laugh.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_sad.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_tongue.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_wink.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_cry.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_turtle.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_heart.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_pizza.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_sleep.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/tux1.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/msn_idea.gif" alt="Smiley" class="textbottom" />',
		'<img src="./images/peanut.gif" alt="Peanut" height=20px class="textbottom" />',
		'<img src="./images/HarryPotter/Glasses.png" alt="Potter" height=40px class="textbottom" />',
		'<img src="./images/HarryPotter/GoldenSnitch.png" alt="Potter" height=40px class="textbottom" />',
		'<img src="./images/HarryPotter/Home.png" alt="Potter" height=40px class="textbottom" />',
		'<img src="./images/HarryPotter/Letter.png" alt="Potter" height=40px class="textbottom" />',
		'<img src="./images/HarryPotter/Mail.png" alt="Potter" height=40px class="textbottom" />',
		'<img src="./images/HarryPotter/Nimbus2000.png" alt="Potter" height=40px class="textbottom" />',
		'<img src="./images/HarryPotter/PhilosphersStone.png" alt="Potter" height=40px class="textbottom" />',
		'<img src="./images/HarryPotter/PhilosphersStone2.png" alt="Potter" height=40px class="textbottom" />',
		'<img src="./images/HarryPotter/PigsTail.png" alt="Potter" height=40px class="textbottom" />',
		'<img sec="./images/HarryPotter/SortingHat.png" alt="Potter" height=40px class="textbottom" />',
		'<img src="./images/xmas/Bell-icon.png" alt="Holiday Icon" class="textbottom"  />',
		'<img src="./images/xmas/blue-snow-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/candy-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/christmas-bells-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/christmas-tree-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/christmas-wreath-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/giftbox-blue-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/giftbox-purple-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/santa-gifts-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/Santa-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/santas-hat-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/snowballz-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/xmas/white-snow-icon.png" alt="Holiday Icon" class="textbottom" />',
		'<img src="./images/WoW/WoW.png" alt="WoW" class="textbottom" />'
	);  
  
    // Do simple BBCode's  
    $str = preg_replace ($simple_search, $simple_replace, $str);  
  
    // Do <blockquote> BBCode  
    //$str = bbcode_quote ($str);  
  
    return $str;  
}  