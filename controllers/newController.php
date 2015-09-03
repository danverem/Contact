<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/2/15
 * Time: 5:41 PM
 */

class NewController extends BaseController {

	/*
	 * @method index
	 */


	public function index( ) {
		//test the template
		$this->viewBag->helloMessage = "Hello, World";
		return $this->view();
	}

	public function create( ) {
		$this->viewBag->helloMessage = "Hello, World";
		return $this->view();
	}
}