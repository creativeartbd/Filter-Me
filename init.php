<?php
// Start the filterme app engine by connecting to the mysql database
require_once( 'classes/database.php' );
require_once( 'classes/upload.php' );
$db = new Database( 'localhost',  'filterme',  'root',  '' );