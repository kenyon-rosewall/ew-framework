<?php

class spotlight_template_model extends model_base
{
	public $name;
	public $template;
	public $created_at;
	public $updated_at;
	
	public function __construct($data='')
	{
		$table = 'spotlight_template';
		$id_name = 'id';
		$this->info = new model_meta($table,$id_name);
		$this->__populate($data);
		
		parent::__construct();
	}
}

class spotlight_template_table_model extends model_table_base
{
	static public function getTemplateById($id)
	{
		$q = new dbquery('SELECT * FROM spotlight_template WHERE id=?',array($id));
		$result = $q->runQuery();
		
		return new spotlight_template_model($result[0]);
	}
}