<?php

class order_model extends model_base
{
	public $user_number;
	public $order_number;
	public $business_name;
	public $business_address;
	public $business_city;
	public $business_state;
	public $business_zip;
	public $business_phone;
	public $contact_phone;
	public $website_url;
	public $contact_email;
	public $billing_name;
	public $billing_contact_first;
	public $billing_contact_last;
	public $billing_address;
	public $billing_city;
	public $billing_state;
	public $billing_zip;
	public $web_spotlight;
	public $new_renewal;
	public $editing;
	public $cities;
	public $counties;
	public $categories;
	public $sub_categories;
	public $pictures;
	public $by_date;
	public $url_link;
	public $own_domain;
	public $number_years;
	public $domain_wanted;
	public $domain_email;
	public $copy_from_site;
	public $copy_provided;
	public $copy_by;
	public $keywords;
	public $sales_date;
	public $expiration_date;
	public $due_date;
	public $check_pay;
	public $check_by_date;
	public $credit_card;
	public $card_name;
	public $card_billing_address;
	public $card_city;
	public $card_state;
	public $card_zip;
	public $card_number;
	public $card_exp;
	public $selected_services;
	public $order_total;
	
	public function __construct($id='')
	{
		$table = 'order';
		$id_name = 'order_id';
		$this->info = new model_meta($table,$id_name,$id);
		parent::__construct();
	}
}

class order_table_model extends model_table_base
{
	static public function getRecords($table)
	{
		$results = parent::getRecords($table);
		$orders = array();
		
		foreach($results as $result) {
			$order = new order_model();
			foreach($result as $key=>$value) {
				$order->{$key} = $value;
			}
			$orders[] = $order;
		}
		
		return $orders;
	}
}