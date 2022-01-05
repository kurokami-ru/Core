<?php

namespace Core\HTTP;

interface UploadedFileStatusInterface
{
	const UPLOAD_ERR_OK = 0;
	const UPLOAD_ERR_INI_SIZE = 1;
	const UPLOAD_ERR_FORM_SIZE = 2;
	const UPLOAD_ERR_PARTIAL = 3;
	const UPLOAD_ERR_NO_FILE = 4;
	const UPLOAD_ERR_NO_TMP_DIR = 6;
	const UPLOAD_ERR_CANT_WRITE = 7;
	const UPLOAD_ERR_EXTENSION = 8;

	const REASONS = [
		self::UPLOAD_ERR_OK => 'There is no error, the file uploaded with success',
		self::UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
		self::UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
		self::UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
		self::UPLOAD_ERR_NO_FILE => 'No file was uploaded',
		self::UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
		self::UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
		self::UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
	];
}
?>