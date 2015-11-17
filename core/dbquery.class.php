<?php 

class dbquery
{
	protected $s = 'SELECT * ';
	protected $f;
	protected $j = '';
	protected $w;
	protected $o;
	protected $l;
	public $params;
	protected $fullQuery;
	public $db;
	
	public function __construct($query='',$params=null)
	{
		$this->fullQuery = $query;
		$this->params = $params;
		$this->db = new db();
	}
	
	public function select($q)
	{
		$this->s = 'SELECT ' . $q . ' ';
	}
	
	public function from($q)
	{
		$this->f = 'FROM ' . $q . ' ';
	}
	
	private function whereClause()
	{
		if(substr($this->w,0,5) == 'WHERE')
			$this->w .= 'AND ';
		else
			$this->w = 'WHERE ';
	}
	
	public function where($q,$p)
	{
		$this->whereClause();
		$this->w .= $q . ' ';
		
		$this->params[] = $p;
	}
	
	public function whereIn($q,$p)
	{
		$this->whereClause();
		$this->w .= $q . ' IN ';
		foreach($p as $i=>$el) {
			if($i==0)
				$this->w .= "(?";
			else
				$this->w .= ",?";
				
			$this->params[] = $el;
		}
		$this->w .= ") ";
	}
	
	public function limit($q)
	{
		$this->l = 'LIMIT ' . $q;
	}
	
	public function join($q)
	{
		$this->j .= 'LEFT JOIN ' . $q . ' ';
	}
	
	public function orderBy($q)
	{
		$this->o = 'ORDER BY ' . $q . ' ';
	}
	
	public function page($q,$limit)
	{
		$this->l = 'LIMIT ' . ($q-1)*$limit . ',' . $limit;
	}
	
	public function getCount()
	{
		$query = 'SELECT COUNT(*) ' . $this->f . $this->j . $this->w . $this->o;
		
		if (count($this->params) > 0)
			$results = $this->db->query($query,$this->params);
		else
			$results = $this->db->query($query);
		
		return $results[0]['COUNT(*)'];
	}
	
	public function runQuery($class='')
	{
		$out = null;
		if ($this->fullQuery != '')
			$query = $this->fullQuery;
		else
			$query = $this->s . $this->f . $this->j . $this->w . $this->o . $this->l;
		
		$results = $this->db->query($query,$this->params);
		$this->db->close();
			
		if($class != '') {
			$class .= '_model';
			foreach($results as $r) {
				$out[] = new $class($r);
			}
			
			if(count($out) > 0)
				return $out;
			else
				return null;
		} else {
			return $results;
		}
	}
	
	public function getQuery()
	{
		return $this->s . $this->f . $this->j . $this->w . $this->o . $this->l;
	}
	
	public function getParams()
	{
		foreach ($this->params as $p)
			echo $p . ', ';
	}
}