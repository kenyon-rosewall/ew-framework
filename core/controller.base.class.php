<?php

class controller_base
{
	protected $data;
	protected $slots = array();
	
	public function __construct()
	{
		$_SESSION['slots'] = '';
		$this->export('user', new user());
	}
	
	public function login($request)
	{
		if($request->method() == 'POST') {
			if (isset($_POST['username']) && isset($_POST['password'])) {
				$user = new user();
				if(!$user->login($_POST['username'], $_POST['password'])) {
					$request->setFlash('Username and/or password are incorrect');
				}
			}
		}
	}
	
	public function logout($request)
	{
		$user = new user();
		$user->logout();
	}
	
	public function export($key,$val)
	{
		$this->data[$key] = $val;
	}
	
	public function getData($route)
	{
		return $this->data;
	}
	
	public function loadSlot($name, $value)
	{
		$this->slots[$name] = $value;
		$_SESSION['slots'] = $this->slots;
	}
	
	public function getModel($model,$id='')
	{
		$model_name = model_base::loadModel($model);
		
		return new $model_name($id);
	}
	
	public function getPartial($route,$args=null)
	{
		$route_info = explode('/',$route);
		
		if(count($args) > 0) {
			foreach($args as $key=>$value) {
				$$key = $value;
			}
		}
		
		$out = file_get_contents(BASE_PATH . '/view/' . $route_info[0] . '/_' . $route_info[1] . '.php');
		ob_start();
		eval("?>$out");
		$out = ob_get_clean();
		
		return $out;
	}
	
	public function redirect($route)
	{
		header('Location: ' . $route);
	}
	
	public function forward404()
	{
		header("HTTP/1.0 404 Not Found");
		echo "<h1>404 Not Found</h1>";
		echo "The page that you have requested could not be found.";
		exit();
	}
}