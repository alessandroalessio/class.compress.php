<?php

/**
* class.compress.php
*/
class Compress{
	
	public $FileURL;
	public $FileContent;

	function __construct( $FileURL ) {
		$this->FileURL = $FileURL;
	}

	public function openFile() {
		$FileHandle = fopen( $this->FileURL, "r" );
		$FileContent = stream_get_contents( $FileHandle );
		fclose( $FileHandle );
	}

}

?>