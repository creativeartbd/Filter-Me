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
	protected $fileName;
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

	// Start validation and then upload
	public function startUpload()
	{

		$this->fileName = $_FILES['files']['name'];
		$this->tmpName = $_FILES['files']['tmp_name'];

		// Check file extension
		if (!$this->checkExt()) {
			die("Sorry, you can not upload this filetype!");
		}

		// Check file size
		if (!$this->checkSize()) {
			die("Sorry, the file you have attempted to upload is too large!");
		}

		// Check file is exists already
		if ($this->fileExists()) {
			die("Sorry, this file already exists on our servers!");
		}

		// Finally if the file is uploaded 
		if ($this->uploadIt()) {
			if ($this->insertToGallery($this->newFileName, $this->fileName)) {
				echo "Your file has been uploaded!";
			}
		} else {
			echo "Sorry, your file could not be uploaded for some unknown reason!";
		}
	}

	public function newFileName()
	{
		$rand = rand(10000, 99999) . $this->getExt();
		$this->newFileName = $rand;
		return $rand;
	}

	// Move the uploaded file to directory
	public function uploadIt()
	{
		return (move_uploaded_file($this->tmpName, $this->uploadTarget . $this->newFileName()) ? true : false);
	}

	// Check if the file size is greater than desire size
	public function checkSize()
	{
		return ((filesize($this->tmpName) > $this->maxSize) ? false : true);
	}

	// Get the file extesion from the uploaded file
	public function getExt()
	{
		return strtolower(substr($this->fileName, strpos($this->fileName, "."), strlen($this->fileName) - 1));
	}

	// Check file extension from the uploaded file
	public function checkExt()
	{
		return (in_array($this->getExt(), $this->extensions) ? true : false);
	}

	// Check if the directory is writtable
	public function isWritable()
	{
		return (is_writable($this->uploadTarget));
	}

	// Check if the file is already tehre 
	public function fileExists()
	{
		return (file_exists($this->uploadTarget . $this->newFileName()));
	}

	// Insert to gallery table
	public function insertToGallery($gname, $original_gname)
	{
		$id = $this->connection->Insert("Insert into `gallery` ( `gname`, `original_gname`, `created` ) values ( :gname, :original_gname, :created )", [
			'gname'          => $gname,
			'original_gname' => $original_gname,
			'created'        => date('Y-m-d h: i: s')
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
			$html          .= "<div class = 'col-md-4'><div class = 'item' id = 'item'><a href = 'filter.php'><img src = 'assets/img/uploads/{$gname}' class = 'img-fluid filter-me'></a><span>$original_gname</span></div></div>";
		}
		return $html;
	}
}