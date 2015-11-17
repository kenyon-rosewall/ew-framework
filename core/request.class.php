<?php

class request
{
	public $request;
	public $route;
	
	public function __construct($r)
	{
		$this->request = $r;
	}
	
	public function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
	
	public function setFlash($msg)
	{
		$_SESSION['flash'] = $msg;
	}
	
	public function getArg($key)
	{
		if(isset($this->route->argv[$key]))
			return $this->route->argv[$key];
		else
			return '';
	}
	
	public function getArgs()
	{
		return $this->route->argv;
	}
	
	public function setRoute($path,$controller,$action,$argv,$argc)
	{
		$this->route = new route($path,$controller,$action,$argv,$argc);
	}
}