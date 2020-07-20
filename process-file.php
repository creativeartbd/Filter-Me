<?php 
require_once('init.php');

if( $_FILES['files'] ) {
	$uploadFile->startUpload();
}
