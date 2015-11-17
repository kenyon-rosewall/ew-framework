<?php

class website_model extends model_base
{
	public $url;
	public $temp_url;
	public $websitetype_id;
	public $business_id;
	public $ga_id;
	public $is_active;
	public $is_pending;
	public $is_primary;
	public $is_editable;
	public $edit_link;
	public $folder;
	public $title;
	public $description;
	public $keywords;
	public $css;
	public $created_by;
	public $modified_by;
	public $created_at;
	public $update_at;
	public $spotlighttemplate_id;
	public $html1;
	public $html2;
	public $html3;
	public $background_color;
	public $show_title;
	public $background_image;
	
	public function __construct($data='')
	{
		$table = 'website';
		$id_name = 'id';
		$this->info = new model_meta($table,$id_name);
		$this->__populate($data);
		
		parent::__construct();
	}
	
	public function getBusiness()
	{
		model_base::loadModel('business');
		$business = business_table_model::getBusinessByWebsiteId($this->id);
		
		return $business;
	}
	
	public function getCoupons()
	{
		model_base::loadModel('coupon');
		$coupons = coupon_table_model::getCouponsByWebsiteId($this->id);
		
		return $coupons;
	}
	
	public function getPhotos()
	{
		model_base::loadModel('photo');
		$photos = photo_table_model::getPhotosByWebsiteId($this->id);
		
		return $photos;
	}
}

class website_table_model extends model_table_base
{
	public function getWebsiteBySlug($slug)
  	{
  		$q = new dbquery('SELECT * FROM website WHERE url=? LIMIT 1',array($slug));
  		$result = $q->runQuery();
  		
  		if(isset($result[0]))
	  		return new website_model($result[0]);
	  	else
	  		return null;
  	}
}