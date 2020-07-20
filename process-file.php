<?php 
require_once('classes/upload.php');
require_once('classes/database.php');

$database = new Database( 'localhost', 'filterme', 'root', '' );
$uploadFile = new UploadFile( $database );

if( $_FILES['files'] ) {
	$gname = $uploadFile->startUpload();
}
