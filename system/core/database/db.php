<?php
	if(!defined('APPS')) exit ('No direct access allowed');
/**
* database acccess 
*/
class db extends dbAccess{

		private $instance;
		public $host, $username, $password, $database;
		
		private $conf = array();

		
		/*
		* db_array - all database support drivers
		*/
		private $db_array = array( 'mysqli','pdo_mysql');

		public function __construct(){
				$a = new config;
				$db = $a->_app."config".DS.'database'.EXT;
					if (file_exists($db)) {
						require_once($db);
							if (in_array($config['database_type'], $this->db_array)) {

								require_once(SYSLIBS."database".DS."drivers".DS.$config['database_type'].EXT);
								//	echo $this->database;
									$dbase = ($this->database!="") ? $this->database : $config['database_name'];
									$host = ($this->host!="") ? $this->host : $config['host'];
									$password = ($this->password!="") ? $this->password : $config['password'];
									$username = ($this->username!="") ? $this->username : $config['username'];

								$database = array('database_name' => $dbase,'host' =>$host,'username'=>$username,'password'=>$password);
								// print_r($database);
								$this->instance = new $config['database_type']($database);
								$this->instance->dbConnection();
							}else{
								 throw new Exception("Unsupported database type: {$config['database_type']}", E_USER_WARNING ); 
								return false;
							}
					}else{

					throw new Exception("File no found", 1);
					}
						
		}


		public function query($query){
			return $this->instance->_query($query);
		}
		
		public function prepare($query){
			//echo $this->queryError();
			return $this->instance->_prepare($query);
		}
		
		public function lastInsertId(){
			return $this->instance->_lastInsertId();
		}
		
		public function error(){
			return $this->instance->errorMessage();
		}
		
		public function dbClose(){
			return $this->instance->db_close();
		}

		public function fetchNum($statement,$vals){
			return $this->instance->_fetchNum($statement,$vals);
		}

		public function fetchObj($statement,$vals){
			return $this->instance->_fetchObj($statement,$vals);
		}

		public function fetchAll($statement,$vals){
			//echo $this->queryError();
			return $this->instance->_fetchBoth($statement,$vals);
		}

		public function fetchAssoc($statement,$vals){
			return $this->instance->_fetchAssoc($statement,$vals);
		}

		public function queryError(){
			return $this->instance->err();
		}

		public function getCount(){
			return $this->instance->count();
		}


		protected function dbConnection(){}
		protected function db_close(){}
		protected function err(){}
		protected function count(){}
		protected function _query($query){}
		protected function _prepare($query){}
		protected function _fetchNum($query,$vals){}
		protected function _fetchObj($query,$vals){}
		protected function _fetchBoth($query,$vals){}
		protected function _fetchAssoc($query,$vals){}
		protected function errorMessage(){}
		protected function _lastInsertId(){}
	
	}
	abstract class dbAccess{

	abstract protected function dbConnection();
	abstract protected function _query($query);
	abstract protected function _prepare($query);
	abstract protected function db_close();
	abstract protected function err();
	abstract protected function count();
	abstract protected function errorMessage();
	abstract protected function _lastInsertId();
	abstract protected function _fetchNum($query,$vals);
	abstract protected function _fetchObj($query,$vals);
	abstract protected function _fetchBoth($query,$vals);
	abstract protected function _fetchAssoc($query,$vals);
}


