<?php

class photo_model extends model_base
{
	public $business_id;
	public $image;
	public $caption;
	public $is_display;
	public $sort_order;
	public $spotlight_id;
	public $alt_tag;
	
	public function __construct($data='')
	{
		$table = 'photo';
		$id_name = 'id';
		$this->info = new model_meta($table,$id_name);
		$this->__populate($data);
		
		parent::__construct();
	}
}

class photo_table_model extends model_table_base
{
	static public function getPhotosByWebsiteId($id)
	{
		$q = new dbquery('SELECT * FROM photo WHERE spotlight_id=?',array($id));
		$results = $q->runQuery();
		
		foreach($results as $r) {
			$out[] = new photo_model($r);
		}
		
		return $out;
	}
}