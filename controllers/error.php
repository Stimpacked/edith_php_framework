<?php
/**
 * Error-page controller
 *
 * @Author: Stefan Sjönnebring
 * 
 */
class Error extends Controller {

	function __construct() {

		parent::__construct();
	}
	
	public function index() {
		$this->view->render('error/index');
	}
}
