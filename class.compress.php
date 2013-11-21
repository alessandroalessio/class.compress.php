<?php

/**
* class.compress.php
*/
class Compress{
	
	public $FileURL;
	public $FileContent;
	public $FileContentType;

	function __construct( $FileURL ) {
		$this->FileURL = $FileURL;
		$this->defineType( $this->FileURL );
		$this->openFile( $this->FileURL );
		$this->cleanFile( $this->FileContent );
		$this->outputFile();
	}

	public function defineType( $File ) {
		$Ext = pathinfo( $File, PATHINFO_EXTENSION );
		switch ( $Ext ) {
			case "css":
				$this->FileContentType = "Content-type: text/css";
			break;
 
			case "js":
				$this->FileContentType = "Content-type: text/javascript";
			break;
		}
	}

	public function openFile( $File ) {
		$FileHandle = fopen( $File, "r" );
		$this->FileContent = stream_get_contents( $FileHandle );
		fclose( $FileHandle );
	}

	public function cleanFile( $Content ) {
		$Search = array( "  ", "\n", "\r", "\t" );
		$Replace = array( "" );
		$Content = str_replace( $Search, $Replace, $Content );
		$this->FileContentType = $Content;
	}

	public function outputFile() {
		header( "Content-type: ".$this->FileContentType );
		header( "Cache-control: must-revalidate" );
		echo $this->FileContentType;
	}

}

?>