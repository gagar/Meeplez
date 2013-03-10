<?php
session_start();
if(!isset( $_SESSION['userid'])) {
header("location:index.html");
}
include("db.php");
$userid = $_SESSION['userid'];
// filename: upload.processor.php

// first let's set some variables

// make a note of the current working directory, relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the directory that will recieve the uploaded file
$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'profilepics/';

// make a note of the location of the upload form in case we need it
$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'editprofile.php#tab2';

// make a note of the location of the success page
$uploadSuccess = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'editprofile.php?photo=true';

// fieldname used within the file <input> of the HTML form
$fieldname = 'file';

// Now let's deal with the upload

// possible PHP upload errors
$errors = array(1 => 'php.ini max file size exceeded',
                2 => 'html form max file size exceeded',
                3 => 'file upload was only partial',
                4 => 'no file was attached');

// check the upload form was actually submitted else print the form
isset($_POST['submit'])
    or error('the upload form is neaded', $uploadForm);

// check for PHP's built-in uploading errors
($_FILES[$fieldname]['error'] == 0)
    or error($errors[$_FILES[$fieldname]['error']], $uploadForm);
    
// check that the file we are working on really was the subject of an HTTP upload
@is_uploaded_file($_FILES[$fieldname]['tmp_name'])
    or error('not an HTTP upload', $uploadForm);
    
// validation... since this is an image upload script we should run a check  
// to make sure the uploaded file is in fact an image. Here is a simple check:
// getimagesize() returns false if the file tested is not an image.
@getimagesize($_FILES[$fieldname]['tmp_name'])
    or error('only image uploads are allowed', $uploadForm);
    
// make a unique filename for the uploaded file and check it is not already
// taken... if it is already taken keep trying until we find a vacant one
// sample filename: 1140732936-filename.jpg
//$now = time();
//while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name']))
//{
//    $now++;
//}
$now = time();
$ext = substr($_FILES[$fieldname]['name'], strrpos($_FILES[$fieldname]['name'], '.') + 1);
$uploadFilename = $uploadsDirectory.'member_upload'.$userid.'.'.$ext;
$dbFilename = 'member'.$userid. '_' . $now .'.jpg';

// now let's move the file to its final location and allocate the new filename to it
@move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename)
    or error('receiving directory insuffiecient permission', $uploadForm);
	
$cmd = 'convert -resize 200x200 ' . $uploadFilename .  ' ' . $uploadsDirectory.$dbFilename;
$tmp = exec ($cmd);
//die ($cmd);

$sql="UPDATE profiles SET photo='$dbFilename' WHERE userid='$userid'";	 
mysql_query($sql) or die("ERROR: Can't update profile.");

$fh = fopen($uploadFilename, 'w') or die("can't open file");
fclose($fh);
unlink($uploadFilename);
    
// If you got this far, everything has worked and the file has been successfully saved.
// We are now going to redirect the client to a success page.
header('Location: ' . $uploadSuccess);

// The following function is an error handler which is used
// to output an HTML error page if the file upload fails
function error($error, $location, $seconds = 5)
{
    header("Refresh: $seconds; URL=\"$location\"");
    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"'."\n".
    '"http://www.w3.org/TR/html4/strict.dtd">'."\n\n".
    '<html lang="en">'."\n".
    '    <head>'."\n".
    '        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">'."\n\n".
    '        <link rel="stylesheet" type="text/css" href="stylesheet.css">'."\n\n".
    '    <title>Upload error</title>'."\n\n".
    '    </head>'."\n\n".
    '    <body>'."\n\n".
    '    <div id="Upload">'."\n\n".
    '        <h1>Upload failure</h1>'."\n\n".
    '        <p>An error has occured: '."\n\n".
    '        <span class="red">' . $error . '...</span>'."\n\n".
    '         The upload form is reloading</p>'."\n\n".
    '     </div>'."\n\n".
    '</html>';
    exit;
} // end error handler

?> 