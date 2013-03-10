<?php
include 'func/album.func.php';
include 'func/imaage.func.php';
include 'db.php';
session_start();
if(!session_is_registered(userid)){
header("location:index.html");
}
?>