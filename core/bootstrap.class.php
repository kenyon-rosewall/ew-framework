<?php

class bootstrap 
{
	public $request;
	public $templates = array();
	public $routes = array();
	public $template = 'main';
	public $view;
	
	public function __construct()
	{
		//do nothing
	}
	
	public function startSession()
	{
		session_start();
		$_SESSION['flash'] = '';
	}
	
	public function includeLibraries()
	{
		require_once(dirname(__FILE__).'/../etc/config.php');
		require_once(BASE_PATH . '/core/error.class.php');
		require_once(BASE_PATH . '/core/db.class.php');
		require_once(BASE_PATH . '/core/dbquery.class.php');
		require_once(BASE_PATH . '/core/pager.class.php');
		require_once(BASE_PATH . '/core/route.class.php');
		require_once(BASE_PATH . '/core/request.class.php');
		require_once(BASE_PATH . '/core/form.class.php');
		require_once(BASE_PATH . '/core/controller.base.class.php');
		require_once(BASE_PATH . '/core/model.base.class.php');
		require_once(BASE_PATH . '/core/user.class.php');
		require_once(BASE_PATH . '/core/ewutils.class.php');
		require_once(BASE_PATH . '/core/functions.php');
		
		/*  REQUIRE 3RD-PARTY  */
		require_once(BASE_PATH . '/core/lib/htmlpurifier/HTMLPurifier.auto.php');
	}
	
	public function loadConfig()
	{
		if(file_exists(BASE_PATH . '/etc/routes.json')) {
			$this->routes = json_decode(file_get_contents(BASE_PATH . '/etc/routes.json'));
		}
		
		if(is_null($this->routes))
			throw new Exception('There is an error in the /etc/routes.json file');
		
		if(file_exists(BASE_PATH . '/etc/templates.json')) {
			$this->templates = json_decode(file_get_contents(BASE_PATH . '/etc/templates.json',true));
		}
		
		if(is_null($this->templates))
			throw new Exception('There is an error in the /etc/templates.json file');
	}
	
	public function loadRequest($request,$files,$session)
	{
		$this->request = new Request($request);
	}
	
	public function readRoute($url)
	{
		$url_parts = parse_url($url);
		$route = $url_parts['path'];
		$route_array = explode(':',$route);
		$route = $route_array[0];
		
		
		foreach($this->routes as $r) {
			$cont = '';
			$action = '';
			$rtmp = '';
			$argc = 0;
			$argv = null;
			$params = null;
			
			if(isset($r->params)) {
				$base_path = str_replace('/?','',$r->path);
				$params = explode('/',$r->params);
				$paramc = count($params);
				if(isset($r->args))
					$routeargs = explode('/',$r->args);
				$argstr = str_replace($base_path . '/','',$route);
				$argarr = explode('/',$argstr);
				foreach($params as $i=>$p) {
					if(isset($argarr[$i]))
						$argv[$params[$i]] = $argarr[$i];
					elseif(isset($routeargs))
						$argv[$params[$i]] = $routeargs[$i-count($argarr)];
				}
				
				if(($paramc == count($argv)) && ($route == $base_path . '/' . str_replace('/-','',join('/',$argv)))) {
					$cont = $r->controller;
					$action = $r->action;
					
					break;
				}
				
			} else {
				if($route == $r->path || $route . '/' == $r->path) {
					$cont = $r->controller;
					$action = $r->action;
					
					break;
				}
			}
		}
		
		if(isset($route_array[1])) {
			foreach(explode('!',$route_array[1]) as $i=>$as) {
				$arg_split = explode('=',$as);
				if(isset($arg_split[1]))
					$argv[$arg_split[0]] = $arg_split[1];
				else
					$argv['var'.($argc+1)] = $as;
				$argc++;
			}
		}
		
		if ($cont == '' && $action == '') {
			$route_info = explode('/',$route);
			$cont = $route_info[1];
			if(isset($route_info[2]))
				$action = $route_info[2];
			else
				$action = 'index';
		}
		
		if(DEBUG) {
			echo 'ROUTE INFO:<br />';
			print_r(array($cont,$action,$argv));
		}
		
		$this->request->setRoute($route,$cont,$action,$argv,count($argv));
		
		return $this->request->route;
	}
	
	public function loadController($route)
	{
		if(file_exists(BASE_PATH . '/controller/' . $route->controller . '_controller.php')) {
			require_once(BASE_PATH . '/controller/' . $route->controller . '_controller.php');
			$controller_name = $route->controller . '_controller';
			$controller = new $controller_name();
			$controller->data['route'] = $route->toArray();
			if(method_exists($controller,$route->action)) {
				$template = call_user_func(array($controller,$route->action),$this->request);
				if ($template != '')
					$this->template = $template;
				$this->view = $route->controller . '/' . $route->action;
			} else {
				throw new Exception('Action "' . $route->action . '" does not exist');
			}
		} else {
			throw new Exception('Controller "' . $route->controller . '" does not exist');
		}
		
		return $controller->getData($route);
	}
	
	public function displayView($data)
	{
		foreach($data as $name=>$d) {
			$$name = $d;
		}
		
		foreach($this->templates->{$this->template} as $t) {
			if ($t == 'view') {
				if(file_exists(BASE_PATH . '/view/' . $this->view . '.php'))
					include(BASE_PATH . '/view/' . $this->view . '.php');
				else
					throw new Exception('View "' . $this->view . '" does not exist');
			} else {
				if(file_exists(BASE_PATH . '/view/common/' . $t . '.php'))
					include(BASE_PATH . '/view/common/' . $t . '.php');
				else
					throw new Exception('Common View "' . $t . '" does not exist');
			}
		}
	}
}

?>