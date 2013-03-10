<?php
    $host="mysql.feednight.com"; // Host name 
    $username="gagar"; // Mysql username 
    $password="jasmine"; // Mysql password 
    $db_name="unkconn5"; // Database name 

    // Connect to server and select databse.
    mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
    mysql_select_db("$db_name")or die("cannot select DB");
?>