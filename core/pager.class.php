<?php

class pager
{
	public $q;
	public $limit;
	public $page;
	public $results_count;
	public $top_page;

	public function __construct($query,$limit)
	{
		$this->q = $query;
		$this->limit = $limit;

		$this->results_count = $this->q->getCount();
		$this->top_page = ceil($this->results_count / $limit);
	}
	
	public function setPage($page)
	{
		$this->page = $page;
	}
	
	public function needsPagination()
	{
		if ($this->results_count > $this->limit)
			return true;
		else
			return false;
	}
	
	public function getPreviousPage()
	{
		if (($this->page-1) < 1)
			return 1;
		else
			return ($this->page-1);
	}
	
	public function getNextPage()
	{
		if ($this->top_page == $this->page)
			return $this->page;
		else 
			return ($this->page+1);
	}
	
	public function getLastPage()
	{
		return $this->top_page;
	}
	
	public function getPages()
	{
		if (($this->page-2) >= 1) {
			$out[0] = $this->page - 2;
			$out[1] = $this->page - 1;
		} elseif(($this->page-1) == 1) {
			$out[0] = $this->page - 1;
		}
		$out[] = $this->page;
		for($i=count($out);$i<5;$i++) {
			if($this->top_page >= $this->page + (5-$i)) {
				$out[] = $this->page + (5-$i);
			}
		}
		sort($out);
			
		return $out;
	}
	
	public function getBatch($class)
	{
		$this->q->page($this->page,$this->limit);
		return $this->q->runQuery($class);
	}
}