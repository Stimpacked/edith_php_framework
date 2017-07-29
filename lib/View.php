<?php
/**
 * The base view
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class View {

	public function __construct()
	{
		$this->path = new Path(); 
	}
	
	/**
     * Render the correct view
     *
     * @param $view String containing controller name
     */
	public function render($view) 
	{
		require_once('views/' . $view . '.php');
		require_once(EDITH_THEME_PATH);

	}
}