<?php
/**
 * The base model
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Model
{
	function __construct()
	{
		$this->db = new Database();
	}
	
}
