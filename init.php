<?php
error_reporting(E_ALL);
// Start the filterme app engine by connecting to the mysql database
require_once('classes/database.php');
require_once('classes/upload.php');

$database     = new Database('localhost', 'filterme', 'root', '');
$uploadFile   = new UploadFile($database);
$allGalleries = $uploadFile->renderGallery();
$noOfItems    = $uploadFile->noOfFiles;
