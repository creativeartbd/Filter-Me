<?php
/*
Filter me simple UploadFile class
*/
class UploadFile
{
	// Allosed extensions 
	protected $extensions = ['.png', '.gif', '.png', '.jpg', '.jpeg'];
	// Maximum  uploaded files size
	protected $maxSize = 9999999;
	// Upload directory
	protected $uploadTarget = 'Gallery/';
	// Uploaded file name
	protected $fileName = [];
	// Uploaded temporary file name
	protected $tmpName;
	// New filename
	protected $newFileName;
	// protectd 
	protected $connection;
	// no of gallery
	public $noOfFiles;

	public function __construct($connection)
	{
		$this->connection = $connection;
	}

	// Make an associative array file with numeric index
	public function reArrayFiles( &$files ) {

		$fileArray = [];
		$fileCount = count( $files['name'] );
		$fileKeys  = array_keys( $files );
	 
		for ( $i = 0; $i < $fileCount; $i++ ) {
		    foreach ( $fileKeys as $key ) {
			   $fileArray[$i][$key] = $files[$key][$i];
		    }
		}
	 
		return $fileArray;
	 }

	// Start validation and then upload
	public function startUpload( $files )
	{
		// Re formate the array		
		$newFileArray= $this->reArrayFiles( $files );

		// Loop through all the files and do the validation
		foreach( $newFileArray as $file ) {
			
			$fileName    = $file['name'];
			$fileType    = $file['type'];
			$fileTmpName = $file['tmp_name'];
			$fileError   = $file['error'];
			$fileSize    = $file['size'];

			// check the file size
			if( !$this->checkSize ( $fileTmpName ) ) {
				die('Your uploaded file is too large');
			}

			// Check file extension
			if ( !$this->checkExt( $fileName ) ) {
				die('Sorry, you can not upload this filetype!');
			}

			// Finally if the file is uploaded 
			if ( $this->uploadIt( $fileTmpName, $fileName ) ) {
				if ( $this->insertToGallery( $this->newFileName, $fileName)) {
					echo 'Your file has been uploaded!';
				}
			} else {
				die('Sorry, your file could not be uploaded for some unknown reason!');
			}
			
		}	
		
	}

	// Check file extension from the uploaded file
	public function checkExt( $fileName )
	{
		return ( in_array( $this->getExt( $fileName ), $this->extensions ) ? true : false);		
	}

	// Get the file extesion from the uploaded file
	public function getExt( $fileName )
	{
		return strtolower( substr( $fileName, strpos( $fileName, "." ), strlen( $fileName) - 1) );
	}

	// Check if the file size is greater than desire size
	public function checkSize( $fileTmpName )
	{
		return ( ( filesize( $fileTmpName ) > $this->maxSize ) ? false : true );
	}

	public function newFileName( $fileName )
	{
		$rand = rand(10000, 99999) . $this->getExt( $fileName );
		$this->newFileName = $rand;
		return $rand;
	}

	// Move the uploaded file to directory
	public function uploadIt( $fileTmpName, $fileName )
	{
		return (move_uploaded_file( $fileTmpName, $this->uploadTarget . $this->newFileName($fileName)) ? true : false);
	}	

	// Check if the directory is writtable
	public function isWritable()
	{
		return (is_writable($this->uploadTarget));
	}

	// Check if the file is already tehre 
	// public function fileExists()
	// {
	// 	return (file_exists($this->uploadTarget . $this->newFileName()));
	// }

	// Insert to gallery table
	public function insertToGallery($gname, $original_gname)
	{
		$id = $this->connection->Insert("Insert into `gallery` ( `gname`, `original_gname`, `created` ) values ( :gname, :original_gname, :created )", [
			'gname'          => $gname,
			'original_gname' => $original_gname,
			'created'        => date('Y-m-d h:i:s')
		]);
	}

	public function renderGallery()
	{
		$results = $this->connection->Select("SELECT gname, original_gname FROM gallery");
		$this->noOfFiles = count($results);
		$html = '';
		foreach ($results as $result) {
			$gname          = $result['gname'];
			$original_gname = $result['original_gname'];
			$html          .= "<div class = 'col-md-4'><div class = 'item' id = 'item'><a href = 'filter.php'><img src = 'Gallery/{$gname}' class = 'img-fluid filter-me'></a><span>$original_gname</span></div></div>";
		}
		return $html;
	}
}