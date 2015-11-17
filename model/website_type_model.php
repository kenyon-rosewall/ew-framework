<?php

class website_type_model extends model_base
{
	public $name;
	public $human_name;
	public $display_name;
	
	public function __construct($data='')
	{
		$table = 'website_type';
		$id_name = 'id';
		$this->info = new model_meta($table,$id_name);
		$this->__populate($data);
		
		parent::__construct();
	}
}

class website_type_table_model extends model_table_base
{
	static public function getWebsiteTypeById($id)
	{
		$q = new dbquery('SELECT * FROM website_type WHERE id=? LIMIT 1',array($id));
		$result = $q->runQuery();
		
		return new website_type_model($result[0]);
	}
}