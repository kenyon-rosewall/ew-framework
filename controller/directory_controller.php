<?php

class directory_controller extends controller_base
{
	private function set_directory_slots()
	{
		if($this->data['route']['path'] == '/browse/eat') {
			$this->loadSlot('__title','Wisconsin Restaurants | Bars and Grills | Delicatessens | Dairy and Cheese | Gourmet Food | Bakeries | Organic Food | Banquet Halls | Supper Clubs | Taverns');
			$this->loadSlot('__description',"If you are looking for some of Wisconsin’s best Eating opportunities, we hope you will find it here as you Explore Wisconsin’s many restaurants, delis, supper clubs, diners, bars and grills.");
			$this->loadSlot('__keywords','explore wisconsin, restaurants, fine dining, family restaurants, fish fry, steak houses, burgers, bars and grills, delicatessens, Wisconsin cheese, gourmet food, banquet halls, organic food, taverns, supper clubs, diners, party trays');
		}
		if($this->data['route']['path'] == '/browse/sleep') {
			$this->loadSlot('__title','Wisconsin lodging | Cabins | Cottages | Bed and Breakfasts | Camping and Campgrounds | Hotels | Motels | Resorts | Vacation Rentals | Private House Rentals | Lodge | Villa | Family Vacations');
			$this->loadSlot('__description','Whether booking a family vacation, business stay or romantic getaway, book your stay at a Wisconsin hotel, motel, resort, villa, lodge, cabin, cottage, bed and breakfast, private house rental or campground.');
			$this->loadSlot('__keywords','explore wisconsin lodging, cabin rental, cottage rental, bed and breakfasts, vacation rentals, door county campgrounds, wisconsin hotels, motels, resorts, private house rentals, camping, wisconsin family vacation, lodge, villa');
		}
		if($this->data['route']['path'] == '/browse/shop') {
			$this->loadSlot('__title','Wisconsin Shopping | Hunting and Fishing Supplies | Boats and ATVs | Cars | Trucks | Sports and Recreation | Arts and Crafts | Home Decor | Clothing | Furniture | Gifts | Wineries | Orchards');
			$this->loadSlot('__description',"If you are looking for some of Wisconsin’s best shopping opportunities we hope you will find it here as you Explore Wisconsin.");
			$this->loadSlot('__keywords','explore wisconsin, hunting equipment supplies, wisconsin fishing supplies, boats, atvs, cars and trucks, sports and recreation, arts and crafts,  home decor, clothing, furniture, lawn and garden supplies, equipment, home improvement supplies, sporting goods, snowmobiles, gifts, online shopping');
		}
		if($this->data['route']['path'] == '/browse/play') {
			$this->loadSlot('__title','Wisconsin Tourism | Boating | Hiking and Biking | Horseback Riding | Canoeing | Sports Bars | Museums | Tours | Festivals | Water Parks | Snowmobiling | Fishing | Climbing');
			$this->loadSlot('__description',"If you are looking for some of Wisconsin’s best recreational opportunities and activities, we hope you will find it here as you Explore Wisconsin’s waterways, countryside, trails, museums, festivals and much more.");
			$this->loadSlot('__keywords','explore wisconsin tourism attractions, events, boating, hiking, biking, bike trails, horseback riding, canoeing, kayaking, sports bars, museums, tours, festivals, water parks, snowmobiling, fishing, climbing');
		}
		if($this->data['route']['path'] == '/browse/services') {
			$this->loadSlot('__title','Wisconsin Home Improvement | Catering | Cleaning and Restoration | Real Estate | Printing | Animal Care | Repair | Classes | Auto Service | Plumbing | Appraisals | Accounting | Heating and Air Conditioning');
			$this->loadSlot('__description',"If you are looking for some of Wisconsin’s best services we hope you will find it here as you Explore Wisconsin with our wide range of services and repairs including catering, home improvement, accounting, heating and air conditioning, auto service, real estate, animal care, plumbing, appraisals, printing and much more.");
			$this->loadSlot('__keywords','explore wisconsin home improvement, catering, cleaning and restoration, real estate, homes for sale, property for sale, printing services, animal care, home repair, auto repair, plumbers, building contractors, well drilling, classes, heating and air conditioning repair, accounting, appraisals, wisconsin');
		}
	}
	
	public function browse($request)
	{
		$county = $request->getArg('county');
		$city = $request->getArg('city');
		$category = ewUtils::deslugify($request->getArg('category'));
		
		$this->set_directory_slots();
		$bm = $this->getModel('business_table');
		$businesses_q = $bm->getBusinessesQuery($county,$city,$category);

		$page = $request->getArg('var1');
		if($page=='')
			$page = 1;
		$pager = new pager($businesses_q, EW_PAGE_LIMIT);
		$pager->setPage($page);
		
		$this->export('businesses',$pager->getBatch('business'));
		$this->export('pager',$pager);
		$this->export('path',$request->route->path . ':');
	}
	
	public function map($request)
	{
		$bm = $this->getModel('business_table');
		$business = $bm->getBusinessForMap($request->getArg('id'));
		
		$this->export('business',$business);
	}
	
	public function search($request)
	{
		echo $request->getArg('query');
	}
}