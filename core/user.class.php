<?php

class user
{
	public $db;
	public $id;
	public $username;
	public $last_login;
	
	public function __construct()
	{
		$this->db = new db();
		if ($_SESSION['user'] != '')
			$this->populate($_SESSION['user']);
	}
	
	public function populate($user)
	{
		if ($user != '') {
			$sql = 'SELECT * FROM `user` WHERE `user`=? LIMIT 1';
			$row = $this->db->query($sql,array($user));
			
			$this->id = $row[0]['id'];
			$this->username = $row[0]['user'];
			$this->last_login = $row[0]['last_login'];
		}
	}
	
	private function hashPassword($pass)
	{
		return md5($pass);
	}
	
	public function save($user,$pass)
	{
		$pass = $this->hashPassword($pass);
		$sql = 'INSERT INTO `user` (`user`, `pass`, last_login) VALUES (?,?,?)';
		$this->db->query($sql, array($user, $pass, date( 'Y-m-d H:i:s')));
	}
		
	public function authenticate($user, $pass) 
	{
		$sql = 'SELECT id FROM user WHERE user=? AND pass=?';
		$result = $this->db->query($sql, array( $user, $this->hashPassword($pass) ));

		if(count($result) > 0) {
			if ($result[0]['id'] > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function login($user, $pass)
	{
		if ($this->authenticate($user, $pass)) {
			$_SESSION['user'] = $user;
			$_SESSION['token'] = md5($user . SALT);
			
			header('Location: ' . $_SESSION['last_url']);
		} else {
			return false;
		}
	}
	
	public function logout()
	{
		$_SESSION['user'] = '';
		$_SESSION['token'] = '';
	}
	
	public function isLoggedIn()
	{
		$username = '';
		$token = '';
		
		if (isset($_SESSION['user']) && isset($_SESSION['token'])) {
			$username = $_SESSION['user'];
			$token = $_SESSION['token'];
		}
		
		if($username != '' && md5($username . SALT) == $token) {
			$this->username = $username;
			return true;
		} else {
			return false;
		}
	}
}