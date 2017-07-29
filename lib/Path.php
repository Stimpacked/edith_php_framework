<?php
/**
 * Pathways
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Path
{

	public function __construct(){	
	}

	public function stylesheets()
	{


		$dir = 'public/css';

		$files = scandir($dir);

		unset($files[0]);
		unset($files[1]);
		return $files;
	}

}
