<?php 
require_once('init.php');

if( isset( $_FILES['files'] ) ) {
	// Start file upload and save to database
	$files = $_FILES['files'];
	$uploadFile->startUpload( $files );
}
