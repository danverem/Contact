<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/2/15
 * Time: 6:48 PM
 */

class HomeController extends BaseController {


	public function index( ){
		$this->viewBag->welcomeMessage = "Welcome to the Contact Manager application";
		return $this->view();
	}
}