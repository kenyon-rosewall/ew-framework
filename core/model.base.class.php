<?php

class model_base
{
	public $info;
	public $db;
	public $system_props = array();

	public function __construct() 
	{
		$this->system_props = array('info','db','system_props');
	}
	
	public function __destruct() 
	{
		if($this->db)
			$this->db->close();
	}
	
	public function __populate($data)
	{
		if($data != '') {
			foreach($data as $key=>$value) {
				$this->{$key} = $value;
			}
		}
	}
	
	public function setId($id)
	{
		$this->info->id = $id;
	}
	
	public function getId()
	{
		return $this->info->id;
	}
	
	static public function loadModel($model)
	{
		$model_table = str_replace('_table', '', $model);
	
		if(file_exists(BASE_PATH . '/model/' . $model . '_model.php')) {
			require_once(BASE_PATH . '/model/' . $model . '_model.php');
			$model_name = $model . '_model';
		} elseif($model_table != $model) {
			require_once(BASE_PATH . '/model/' . $model_table . '_model.php');
			$model_name = $model . '_model';
		} else {
			throw new Exception('Model "' . $model . '" does not exist');
		}
		
		return $model_name;
	}
	
	public function load()
	{
		if($this->info->id != '') {
			$sql = 'SELECT * FROM `' . $this->info->table . '` WHERE ' . $this->info->id_name . '=' . $this->info->id . ' LIMIT 1';
			$result = $this->db->query($sql);
			if(count($result) == 0) {
				throw new Exception('Object (' . $this->info->table . ') does not have a record with id (' . $this->info->id . ').');
			}
			foreach ($result[0] as $key=>$value) {
				$this->{$key} = $value;
			}
		} else {
			throw new Exception('Object (' . $this->info->table . ') does not have id (' . $this->info->id_name . ') set.');
		}
	}
	
	public function save()
	{
		$params = array();
		
		if ($this->info->id == '') {
			$sql = 'INSERT INTO `' . $this->info->table . '` (';
			$sql_args = '(';
			foreach(get_class_vars(get_class($this)) as $field=>$val) {
				if(!in_array($field,$this->system_props)) {
					$sql .= $field . ', ';
					$sql_args .= '?,';
					$params[] = $this->{$field};
				}
			}
			$sql_args = rtrim($sql_args,',') . ')';
			$sql = rtrim($sql, ', ') . ') VALUES ' . $sql_args;
		} else {
			$sql = 'UPDATE ' . $this->info->table . ' SET ';
			foreach(get_class_vars(get_class($this)) as $field=>$val) {
				if(!in_array($field,$this->system_props)) {
					$sql .= $field . '=?, ';
					$params[] = $this->{$field};
				}
			}
			$sql = rtrim($sql, ', ') . ' WHERE ' . $this->info->id_name . '=' . $this->info->id;
		}

		if(DEBUG) {
			echo $sql;
			print_r($params);
			die();
		}
		
		$db = new db();
		$result = $db->query($sql,$params);

		if ($this->info->id == '')
			$this->info->id = mysqli_insert_id($db->link);
		$db->close();
			
		return $this->info->id;
	}
}

class model_meta
{
	public $id_name;
	public $table;
	public $id;
	
	public function __construct($table,$name,$id='')
	{
		$this->id_name = $name;
		$this->table = $table;
		$this->id = $id;
	}
}

class model_table_base
{
	public $db;
	
	public function __construct($id='')
	{
		$this->db = new db();
	}
	
	static public function getRecords($table,$limit='all')
	{
		$db = new db();
		$sql = 'SELECT * FROM `' . $table . '` LIMIT ' . $limit;
		$result = $db->query($sql);
		
		return $result;
	}
}