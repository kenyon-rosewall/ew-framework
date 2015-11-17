<?php

class form
{
	public $model;
	
	public function bind($request)
	{
		$m = $this->getModel();
		
		foreach(get_class_vars(get_class($m)) as $field=>$val) {
			if (array_key_exists($field,$request->request))
				$m->{$field} = $request->request[$field];
		}
		
		$m->save();
	}
	
	public function getModel()
	{
		$model_name = model_base::loadModel($this->model);
		
		return new $model_name();
	}
}