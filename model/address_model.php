<?php

class address_model extends model_base
{
	public $business_id;
	public $address1;
	public $address2;
	public $city;
	public $state;
	public $zip;
	public $latitude;
	public $longitude;
	public $name;
	public $phone;
	public $email;
	public $email_image;
	public $fax;
	public $cell;
	public $toll_free;
	
	public function __construct($data='')
	{
		$table = 'address';
		$id_name = 'id';
		$this->info = new model_meta($table,$id_name);
		$this->__populate($data);
		
		parent::__construct();
	}
	
	public function save()
	{
		try {
			$font = FONT_PATH . '/arial.ttf';
			$filename = sha1($this->id . '-aemail' . microtime() . rand()) . '.png';
			$path = EMAIL_PATH . '/';
			ewUtils::create_email_image($this, array(57,57,57), $font, 12, $filename, $path, $this->email_image);
		} catch (Exception $e) {
			throw $e;
		}
	}
}

class address_table_model extends model_table_base
{
	static public function getAddressesByBusinessId($id)
	{
		$q = new dbquery('SELECT * FROM address WHERE business_id=?',array($id));
		$results = $q->runQuery('address');

		if(isset($results))
			return $results;
		else
			return null;
	}
}