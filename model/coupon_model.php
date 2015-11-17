<?php

class coupon_model extends model_base
{
	public $business_id;
	public $title;
	public $description;
	public $image;
	public $start_date;
	public $end_date;
	public $is_active;
	public $show_date;
	public $spotlight_id;
	public $seo_title;
	
	public function __construct($data='')
	{
		$table = 'coupon';
		$id_name = 'id';
		$this->info = new model_meta($table,$id_name);
		$this->__populate($data);
		
		parent::__construct();
	}
}

class coupon_table_model extends model_table_base
{
	static public function getCouponsByWebsiteId($id)
	{
		$q = new dbquery('SELECT * FROM coupon WHERE spotlight_id=?',array($id));
		$results = $q->runQuery('coupon');
		
		if (count($results) > 0)
			return $results;
		else
			return null;
	}
}