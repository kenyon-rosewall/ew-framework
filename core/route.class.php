<?php

class route
{
	public $path;
	public $controller;
	public $action;
	public $argv;
	public $argc;
	
	public function __construct($path,$controller,$action,$argv,$argc)
	{
		$this->path = $path;
		$this->controller = $controller;
		$this->action = $action;
		$this->argv = $argv;
		$this->argc = $argc;
	}
	
	public function toArray()
	{
		$out['path'] = $this->path;
		$out['controller'] = $this->controller;
		$out['action'] = $this->action;
		$out['argv'] = $this->argv;
		$out['argc'] = $this->argc;
		
		return $out;
	}
}