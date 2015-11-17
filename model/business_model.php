<?php

class business_model extends model_base
{
	public $name;
	public $subname;
	public $address;
	public $city;
	public $state;
	public $zip;
	public $phone;
	public $fax;
	public $email;
	public $account_number;
	public $logo;
	public $description;
	public $latitude;
	public $longitude;
	public $created_by;
	public $modified_by;
	public $is_active;
	public $created_at;
	public $updated_at;
	public $pin_id;
	public $email_image;
	public $toll_free_number;
	public $cell;
	
	public function __construct($data='')
	{
		$table = 'business';
		$id_name = 'id';
		$this->info = new model_meta($table,$id_name);
		$this->__populate($data);
		
		parent::__construct();
	}
	
	public function save()
	{
		if ($this->getName() != '') {
			try {
				$font = FONT_PATH . '/arial.ttf';
				$filename = sha1($this->id() . '-email' . microtime() . rand()) . '.png';
				$path = EMAIL_PATH . '/';
				ewUtils::create_email_image($this, array(57,57,57), $font, 12, $filename, $path, $this->email_image);

				parent::save();

				if (!$this->is_active)
					$this->inactivateSites();

				// Update lucene index
				if(in_array(str_replace('http://','',ewUtils::get_base_url()), array('www.explorewisconsin.com','dev.explorewisconsin.com','2.explorewisconsin.com')))
					$search_file = 'http://localhost:8080/solr/dataimport?command=full-import';
				else
					$search_file = 'files/search';
				
				$response = file_get_contents($search_file);
				business_table_model::writeCitiesDropdown();

			} catch (Exception $e) {
				throw $e;
				die($e);
			}
		}
	}
	
	public function getPrimaryWebsite()
	{
		return 'http://2.explorewisconsin.com/spotlight/test-site';
	}
	
	public function getSpotlight()
	{
		return '';
		//$sql = "select * from website w left join website_type t on t.id=w.websitetype_id where t.name in ('l','s','cs') and w.business_id = ? limit 1";
		//$params = array($this->id);
		//$result = $this->db->query($sql,$params);
	}
	
	public function getSite()
	{
		return '';
	}
	
	public function getSites()
	{
		$q = new dbquery();
		$q->from('website w');
		$q->join('website_type t ON w.websitetype_id=t.id');
		$q->whereIn('t.name',array('w','c','e'));
		$q->where('w.business_id=?',$this->id);
		$q->where('w.is_active=?',1);
		
		return $q->runQuery('website');
	}
	
	public function getAddresses()
	{
		model_base::loadModel('address_table');
		$addresses = address_table_model::getAddressesByBusinessId($this->id);
		
		return $addresses;
	}
	
	public function getCategories()
	{
		model_base::loadModel('category_table');
		$categories = category_table_model::getCategoriesByBusinessId($this->id);
		
		return $categories;
	}
	
	public function getCounties()
	{
		model_base::loadModel('county_table');
		$counties = county_table_model::getCountiesByBusinessId($this->id);
		
		return $counties;
	}
}

class business_table_model extends model_table_base
{
	var $top_categories = array(1,2,3,4);
  	public $f = '/var/tmp/cities';
  	
  	public function getBusinessByWebsiteId($id)
  	{
  		$q = new dbquery('SELECT * FROM business WHERE id=? LIMIT 1',array($id));
  		$results = $q->runQuery();
  		
  		return new business_model($results[0]);
  	}

  	public function getAllBusinesses()
  	{
  		$results = parent::getRecords('business','30');
		$businesses = array();
		
		foreach($results as $result) {
			$business = new business_model();
			foreach($result as $key=>$value) {
				$business->{$key} = $value;
			}
			$businesses[] = $business;
		}
		
		return $businesses;
  	}

  public function getBusinessById($id)
  {
    $q = $this->getBusinessQuery();
    $q->andWhere('id = ?', $id);

    return $q->fetchOne();
  }

  public function getBusinessByCategoryId($cat_id)
  {
    $q = $this->getBusinessQuery();
    $q->leftJoin('b.BusinessCategory bc')
      ->andWhere('bc.category_id = ?',$cat_id);

    return $q->execute();
  }

  public function getBusinessByCountyId($co_id)
  {
    $q = $this->getBusinessQuery();
    $q->leftJoin('b.BusinessCounty bc')
      ->andWhere('bc.county_id = ?', $co_id);

    return $q->execute();
  }

  public function getBusinessByName($name)
  {
    $q = $this->getBusinessQuery();
    $q->andWhere('name = ?', $name);

    return $q->fetchOne();
  }

  public function getCitiesDropdown()
  {
    $choices = unserialize(file_get_contents($this->f));

    return $choices;
  }
  
  public function writeCitiesDropdown()
  {
  	$choices = array('-' => 'City');
  	$q = new dbquery();
  	$q->select('DISTINCT city');
  	$q->from('Business b');
  	$q->where('city != ?','');
  	$q->orderBy('city ASC');
  	$cities = $q->runQuery('business');
  	
    foreach ($cities as $city) {
		$choices[ewUtils::slugify($city->city)] = $city->city;
    }
    
    file_put_contents(BASE_PATH . $this->f,serialize($choices));
  }

  public function getForLuceneQuery($query, $request)
  {
  	if(in_array(str_replace('http://','',ewUtils::get_base_url()), array('www.explorewisconsin.com','dev.explorewisconsin.com','2.explorewisconsin.com')))
  		$search_file = 'http://localhost:8080/solr/select?q='.urlencode($query).'&wt=php&version=2.2&start=0&rows=100&spellcheck=true&fl=*,score';
  	else
  		$search_file = 'files/search';
  	
    $code = file_get_contents($search_file);
    eval("\$result = " . $code . ";");
    return $result;
  }

	public function getBusinessesQuery($county, $city, $category)
	{
		$q = new dbquery();
		$q->select('DISTINCT b.id, b.name, b.city, b.phone, b.description, b.logo');
		$q->from('business b');
		$q->join('business_county bc ON bc.business_id=b.id');
		$q->join('county c ON c.id=bc.county_id');
		$q->join('business_category bcc ON bcc.business_id=b.id');
		$q->join('category cc ON cc.id=bcc.category_id');

		if (!ewUtils::is_blank($county))
			$q->where('c.name LIKE ?',$county);

		if (!ewUtils::is_blank($city))
			$q->where('b.city LIKE ?',$city);

		if (!ewUtils::is_blank($category)) {
			model_base::loadModel('category');
			$main_cat = category_table_model::getCategoryBySlug($category);
			$parent_category = $main_cat->parent_id;
			if ($parent_category == 'None' || $parent_category==0) {
				$top_cats_q = new dbquery();
				$top_cats_q->from('category c');
				$top_cats_q->where('parent_id = ?', $main_cat->id);
				$top_cats = $top_cats_q->runQuery('category');
				//$top_cats[] = $cat;
			} else {
				$top_cats = array($main_cat);
			}

			foreach($top_cats as $cat) {
				$cat_ids[] = $cat->id;
			}

			//echo '<h1>Cat Ids</h1><br />';
			//print_r($cat_ids);
			//echo '<br /><br />';

			$subcats_q = new dbquery();
			$subcats_q->from('category c');
			$subcats_q->whereIn('c.parent_id',$cat_ids);
			$subcats = $subcats_q->runQuery('category');

			foreach($subcats as $i => $subcat) {
				$subids[] = $subcat->id;
			}

			if (empty($subids))
				$subids[] = $main_cat->id;

			if (count($subids) != 1) {
				foreach ($cat_ids as $cat_id) {
					$subids[] = $cat_id;
				}
			}

			if ($parent_category == 'None' || $parent_category == 0)
				$subids[] = $main_cat->id;

			//echo '<h1>Sub category ids</h1><br />';
			//print_r($subids);
			//die();

			$q->whereIn('cc.id',$subids);
		}

		$q->where('b.is_active = ?', 1);
		$q->orderBy('b.name');
		return $q;
	}
	
	public function getBusinessForMap($id)
	{
		$q = new dbquery('SELECT id, name, address, city, state, zip, phone, latitude, longitude FROM business WHERE id = ?',array($id));
		$result = $q->runQuery();
		$result = $result[0];
		
		return new business_model($result);
	}

  public function addOrderByBusinesses(Doctrine_Query $q = null)
  {
    if (is_null($q))
      {
	$q = Doctrine_Query::create()
	  ->from('Business b');
      }

    $alias = $q->getRootAlias();

    $q->orderBy('b.name');

    return $q;
  }

  public function addActiveBusinesses(Doctrine_Query $q = null)
  {
    if (is_null($q))
      {
	$q = Doctrine_Query::create()
	  ->from('Business b');
      }

    $alias = $q->getRootAlias();

    $q->andWhere($alias.'.is_active = ?',true);

    return $q;
  }

  public function getBusinessesByCategories($cat_ids,$latlo,$lathi,$lonlo,$lonhi)
  {
    foreach ($cat_ids as $i => $catid)
      {
	if ($catid == 'on')
	  $cat_ids[$i] = null;
      }

    if (count($cat_ids) > 0)
      {
	$q = Doctrine_Query::create()
	  ->select('c.id')
	  ->distinct()
	  ->from('Category c')
	  ->whereIn('c.parent_id',$cat_ids);
	$subcatResult = $q->execute();

	foreach($subcatResult as $i => $subcat)
	  {
	    $subcats[] = $subcat->getId();
	  }
	foreach ($cat_ids as $i => $catid)
	  {
	    if ($catid != null)
	      $subcats[] = $catid;
	  }

	$q = Doctrine_Query::create()
	  ->from('Business b')
	  ->leftJoin('b.BusinessCategory bc')
	  ->leftJoin('bc.Category c')
	  ->whereIn('c.id',$subcats)
	  ->andWhere('b.latitude > ?',$latlo)
	  ->andWhere('b.latitude < ?',$lathi)
	  ->andWhere('b.longitude > ?',$lonlo)
	  ->andWhere('b.longitude < ?',$lonhi);

	$q = $this->addActiveBusinesses($q);

	return $q->execute();
      }
    return Doctrine_Query::create()
      ->from('Business b')
      ->where('name = ?', 'Kenyon and Sons')
      ->execute();
  }

  public function getBusinessesByIds($ids)
  {
    $q = $this->getBusinessQuery();
    $q->andWhereIn('b.id',$ids);

    return $q->execute();
  }
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