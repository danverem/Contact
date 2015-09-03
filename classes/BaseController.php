<?php

/**
 * Created by PhpStorm.
 * User: andela
 * Date: 9/2/15
 * Time: 1:26 PM
 */
abstract class BaseController
{

	/*
	 * @property fullActionPath
	 */
	public $fullActonPath;
	/*
	 * @property viewBag.
	 * Tha parameter bag that contains the data to be passed to the view
	 */
	public $viewBag;

	/*
		* @property $identifiers.
		* The identifiers that come after the path action
		*/
	public $identifiers;

	/*
		* @property view.
		* The view file to be displayed
		*/
	public $view;

	/*
		* @property method
		* The Http request method sent from the view
		*/
	public $method;


	public $smarty;


	public $sharedSmarty;

	/*
		* @constructor
		* @param controllerName, the name of the controllers.
		*
		* @param urlParts, the parts of the url parts that
		* are left after the action controllers has been
		* retrieved.
		*
		* @param data, the json or request data.
		*/

	public function __construct($controllerName, $urlParts, $data)
	{
		$this->fullActonPath = implode("/", $urlParts);
		$this->method = $_SERVER['REQUEST_METHOD'];

		//Assuming data is a json string
		if ($data == '') {
			$data = '{}';
		}

		$this->viewBag = json_decode($data);

		//the action controllers would be the first part of the url
		$action = $urlParts[0];

		if (count($urlParts) > 1 && $urlParts[1] != '') {
			//find the action identifiers
			array_shift($urlParts);
			foreach ($urlParts as $id) {
				if ($id != '') {
					$this->identifiers[] = $id;
				}
			}
		}
		if (!isset($action) || $action == '') {
			//if there is no action, start the default view
			$action = "index";
		}
		//display the view
		$this->view = strtolower($action) . ".html";

		try {
			//call_user_func gives a fatal error, which we cannot catch.
			// So we cannot handle asking for an unknown action.
			//This is why we'll use the ReflectionClass's getMethod which will
			// throw an exception.
			$reflector = new ReflectionClass($this);
			$method = $reflector->getMethod($action);
			//if all works,start the action. If it doesn't I didn't do it.

			switch (sizeof($this->identifiers)) {
				//I'll support 5 keys. There is a better way to do this.
				case 0:
					call_user_func($controllerName . "::" . $action);
					break;
				case 1:
					call_user_func($controllerName . "::" . $action, $this->identifiers[0]);
					break;
				case 2:
					call_user_func($controllerName . "::" . $action, $this->identifiers[0], $this->identifiers[1]);
					break;
				case 3:
					call_user_func($controllerName . "::" . $action, $this->identifiers[0], $this->identifiers[1], $this->identifiers[2]);
					break;
				case 4:
					call_user_func($controllerName . "::" . $action, $this->identifiers[0], $this->identifiers[1], $this->identifiers[2], $this->identifiers[3]);
					break;
				case 5:
					call_user_func($controllerName . "::" . $action, $this->identifiers[0], $this->identifiers[1], $this->identifiers[2], $this->identifiers[3], $this->identifiers[4]);
					break;
			}
		} catch (Exception $ex) {
			//if the view doesnt exist start the default view.
			call_user_func($controllerName . "::index");
		}
	}

	/*
		* @method view
		* @description Combines the view with the viewBag data.
		*/

	public function view()
	{
		//Determine the full path to the view
		$viewPath = $GLOBALS['config']['settings']['current_view_path'] . $this->view;
		$sharedView = $GLOBALS['config']['settings']['view_path'] . "shared.html";

		if (file_exists($viewPath)) {
			//if the file exists, use the templating engine.
			$this->smarty = new Smarty();
			$this->smarty->assign("baseURL", $GLOBALS['config']['settings']['baseURL']);

			foreach ($this->viewBag as $key => $value) {
				$this->smarty->assign($key, $value);
			}

			$contents = $this->smarty->fetch($viewPath);

			$this->sharedSmarty = new Smarty();
			$this->sharedSmarty->assign("baseURL", $GLOBALS['config']['settings']['baseURL']);
			$this->sharedSmarty->assign("contents", $contents);
			$this->sharedSmarty->display($sharedView);
		} else {
			header('HTTP/1.0 404 Not Found');
			echo "<h1>404 Not Found</h1>";
			echo "The page you requested for could not be found";
		}
	}


	//@method PartialView
	//@description Combines the view with the viewBag data.

	public function partialView()
	{
		//determine the full path to the view file
		$viewPath = $GLOBALS['config']['settings']['view_path'] . $this->view;

		if (file_exists($viewPath)) {
			$this->smarty = new Smarty();
			$this->smarty->assign("baseURL", $GLOBALS['config']['settings']['baseURL']);

			foreach ($this->viewBag as $key => $value) {
				$this->smarty->assign($key, $value);
			}

			$this->smarty->display($viewPath);
		} else {
			header('HTTP/1.0 404 Not Found');
			echo "<h1>404 Not Found</h1>";
			echo "The page you requested for could not be found";
		}
	}

	/*@method JSONView
	 *@description A view which is just a JSON object
	 *@param object Het object
	 */

	public function JSONView($object)
	{
		header("content-type: application/json");

		echo json_encode($object);
	}


	public function unknownView() {
		$this->view();
	}


}