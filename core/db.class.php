<?php

class db
{
	public $host = MYSQL_HOST;
	public $user = MYSQL_USERNAME;
	private $pass = MYSQL_PASSWORD;
	public $db = MYSQL_DATABASE;
	public $link;
	public $q;
	
	public function __construct($c_host = '',$c_user = '',$c_pass = '',$c_db = '') 
	{
		if ($c_host == '' && $c_user == '' && $c_pass == '' && $c_db == '')
			$this->link = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
		else
			$this->link = mysqli_connect($c_host, $c_user, $c_pass, $c_db);
		
		if(isset($this->link->connect_error) || mysqli_connect_error()) {
			echo "Connection Failed " . mysqli_connect_errno() . ": " . mysqli_connect_error();
			die();
		}
	}
	
	public function __destruct()
	{
		$this->close();
	}
	
	public function close()
	{
		$this->link = null;
	}
	
	public function query($sql, $bindParams = null) 
	{
		if(DEBUG)
			echo $sql . '<br />';
		
		$this->q = filter_var($sql, FILTER_SANITIZE_STRING);
		$stmt = $this->prepareQuery();
		
		if (is_array($bindParams) === true) {
			$params = array('');
			foreach ($bindParams as $prop => $val) {
				$params[0] .= $this->determineType($val);
				array_push($params, $bindParams[$prop]);
			}

			call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));
		}
		
		$stmt->execute();
		$this->q = null;
		
		if(mysqli_errno($this->link))
			trigger_error(mysqli_error($this->link));
		
		return $this->dynamicBindResults($stmt);
	}
	
	protected function prepareQuery()
    {
        if (!$stmt = mysqli_prepare($this->link,$this->q)) {
            trigger_error("Problem preparing query ($this->q) " . $this->link->error, E_USER_ERROR);
        }
        return $stmt;
    }
	
	protected function determineType($item)
    {
        switch (gettype($item)) {
            case 'NULL':
            case 'string':
                return 's';
                break;

            case 'integer':
                return 'i';
                break;

            case 'blob':
                return 'b';
                break;

            case 'double':
                return 'd';
                break;
        }
        return '';
    }
	
	protected function refValues($arr)
    {
		$refs = array();
		foreach ($arr as $key => $value) {
			$refs[$key] = & $arr[$key];
		}
		return $refs;
    }
	
	protected function dynamicBindResults(mysqli_stmt $stmt)
    {
        $parameters = array();
        $results = array();

        $meta = $stmt->result_metadata();

        // if $meta is false yet sqlstate is true, there's no sql error but the query is
        // most likely an update/insert/delete which doesn't produce any results
        if(!$meta && $stmt->sqlstate) { 
            return array();
        }

        $row = array();
        while ($field = $meta->fetch_field()) {
            $row[$field->name] = null;
            $parameters[] = & $row[$field->name];
        }

        call_user_func_array(array($stmt, 'bind_result'), $parameters);

        while ($stmt->fetch()) {
            $x = array();
            foreach ($row as $key => $val) {
                $x[$key] = $val;
            }
            array_push($results, $x);
        }
        return $results;
    }
}
?>