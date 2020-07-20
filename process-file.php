<?php require_once('init.php');

if( $_FILES['files'] ) {
	$gname = $uploadFile->startUpload();
}
