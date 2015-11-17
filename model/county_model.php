<?php

class county_model extends model_base
{
	public $name;
	
	public function __construct($data='')
	{
		$table = 'county';
		$id_name = 'id';
		$this->info = new model_meta($table,$id_name);
		$this->__populate($data);
		
		parent::__construct();
	}
}

class county_table_model extends model_table_base
{
	static public function getCountiesByBusinessId($id)
	{
		$q = new dbquery('SELECT * FROM county c LEFT JOIN business_county bc ON c.id=bc.county_id WHERE bc.business_id=?', array($id));
		$results = $q->runQuery('county');
		
		return $results;
	}
}