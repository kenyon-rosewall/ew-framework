<?php

class category_model extends model_base
{
	public $parent_id;
	public $name;
	public $created_at;
	public $updated_at;
	public $slug;
	
	public function __construct($data='')
	{
		$table = 'category';
		$id_name = 'id';
		$this->info = new model_meta($table,$id_name);
		$this->__populate($data);
		
		parent::__construct();
	}
}

class category_table_model extends model_table_base
{
	static public function getCategoryBySlug($slug)
	{
		$q = new dbquery('SELECT * FROM category WHERE slug=?',array($slug));
		$results = $q->runQuery('category');

		return $results[0];
	}
	
	static public function getCategoriesByBusinessId($id)
	{
		$q = new dbquery('SELECT * FROM category c LEFT JOIN business_category bc ON c.id=bc.category_id WHERE bc.business_id=?', array($id));
		$results = $q->runQuery('category');
		
		return $results;
	}
}