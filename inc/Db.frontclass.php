<?php

class DBfront
{
	private $pdo;

	private $sQuery;

	private $settings;

	private $bConnected = false;

	private $log;

	private $parameters;
		

		public function __construct()
		{ 			
			$this->Connect();
			$this->parameters = array();
		}

		private function Connect()
		{

			$this->settings["dbname"]=DBNAME;
			$this->settings["host"]=SERVIDOR;
			$this->settings["user"]=DBUSER;
			$this->settings["password"]=DBPASS;
			

			$dsn = 'mysql:dbname='.$this->settings["dbname"].';host='.$this->settings["host"].'';
			try 
			{
				$this->pdo = new PDO($dsn, $this->settings["user"], $this->settings["password"], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				
				$this->bConnected = true;
			}
			catch (PDOException $e) 
			{
				echo $this->ExceptionLog($e->getMessage());
				die();
			}
		}

	 	public function CloseConnection()
	 	{

	 		$this->pdo = null;
	 	}
		

		private function Init($query,$parameters = "")
		{
		if(!$this->bConnected) { $this->Connect(); }
		try {
				$this->sQuery = $this->pdo->prepare($query);
				
				$this->bindMore($parameters);

				if(!empty($this->parameters)) {
					foreach($this->parameters as $param)
					{
						$parameters = explode("\x7F",$param);
						$this->sQuery->bindParam($parameters[0],$parameters[1]);
					}		
				}

				$this->succes 	= $this->sQuery->execute();		
			}
			catch(PDOException $e)
			{
					echo $this->ExceptionLog($e->getMessage(), $query );
					die();
			}

			$this->parameters = array();
		}
		

		public function bind($para, $value)
		{	
			$this->parameters[sizeof($this->parameters)] = ":" . $para . "\x7F" . ($value);
		}

		public function bindMore($parray)
		{
			if(empty($this->parameters) && is_array($parray)) {
				$columns = array_keys($parray);
				foreach($columns as $i => &$column)	{
					$this->bind($column, $parray[$column]);
				}
			}
		}
		
		public function query($query,$params = null, $fetchmode = PDO::FETCH_ASSOC)
		{
			$query = trim($query);

			$this->Init($query,$params);

			$rawStatement = explode(" ", $query);
			
			$statement = strtolower($rawStatement[0]);
			
			if ($statement === 'select' || $statement === 'show') {
				return $this->sQuery->fetchAll($fetchmode);
			}
			elseif ( $statement === 'insert' ||  $statement === 'update' || $statement === 'delete' ) {
				return $this->sQuery->rowCount();	
			}	
			else {
				return NULL;
			}
		}

		public function select($query,$params = null)
		{
			$query = trim($query);

			$this->Init($query,$params);

			$rawStatement = explode(" ", $query);
			
			$statement = strtolower($rawStatement[0]);
			
			if ($statement === 'select' || $statement === 'show') {
				return $this->sQuery->fetchAll(PDO::FETCH_OBJ);
			}
			elseif ( $statement === 'insert' ||  $statement === 'update' || $statement === 'delete' ) {
				return $this->sQuery->rowCount();	
			}	
			else {
				return NULL;
			}
		}
		public function describe($tablename){
			$q = $this->pdo->prepare("DESCRIBE $tablename");
			$q->execute();
			$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
			return $table_fields;
		}
		

		public function lastInsertId() {
			return $this->pdo->lastInsertId();
		}	
		
	
		public function column($query,$params = null)
		{
			$this->Init($query,$params);
			$Columns = $this->sQuery->fetchAll(PDO::FETCH_NUM);		
			
			$column = null;

			foreach($Columns as $cells) {
				$column[] = $cells[0];
			}

			return $column;
			
		}	
	
		public function row($query,$params = null,$fetchmode = PDO::FETCH_ASSOC)
		{				
			$this->Init($query,$params);
			return $this->sQuery->fetch($fetchmode);			
		}
	
		public function single($query,$params = null)
		{
			$this->Init($query,$params);
			return $this->sQuery->fetchColumn();
		}

		public function total($query){
			$query=str_replace(" FROM ", " from ", $query);
			$newquery=substr($query,strpos($query, " from "));
			$count=$this->single("SELECT count(*) ".$newquery);
			return intval($count);
		}

	private function ExceptionLog($message , $sql = "")
	{
		$exception  = 'Unhandled Exception. <br />';
		$exception .= $message;
		$exception .= "<br /> You can find the error back in the log.";

		if(!empty($sql)) {
			$message .= "\r\nRaw SQL : "  . $sql;
		}

		return $exception;
	}

	public function insert($table,$params) { 
		$bindings   	= $params;

		if(!empty($bindings)) {
			$fields     =  array_keys($bindings);
			$fieldsvals =  array(implode(",",$fields),":" . implode(",:",$fields));
			$sql 		= "INSERT INTO ".$table." (".$fieldsvals[0].") VALUES (".$fieldsvals[1].")";
		}
		else {
			$sql 		= "INSERT INTO ".$table." () VALUES ()";
		}

		if( $this->query($sql,$bindings))
			return $this->lastInsertId();
		else 
			return 0;
	}
	public function update($table,$params,$where){

		$fieldsvals = '';
		$wherevals = '';
		$columns = array_keys($params);
		$conditions = array_keys($where);

		foreach($columns as $column)
		{
			$fieldsvals .= $column . " = :". $column . ",";
		}
		foreach($conditions as $key=>$condition)
		{
			$wherevals .= (($key>0)?" AND ":"").$condition . " = :". $condition;
		}
		foreach ($where as $key => $value) {
			$params[$key]=$value;
		}

		$fieldsvals = substr_replace($fieldsvals , '', -1);

		if(count($columns) > 0 ) {
			$sql = "UPDATE " . $table .  " SET " . $fieldsvals . " WHERE " . $wherevals;  
			return $this->query($sql,$params);
		}
	}

	public function delete($table,$where){
		$wherevals = '';
		$params=array();
		$conditions = array_keys($where);


		foreach($conditions as $condition)
		{
			$wherevals .= $condition . " = :". $condition . ",";
		}
		foreach ($where as $key => $value) {
			$params[$key]=$value;
		}

		$wherevals = substr_replace($wherevals , '', -1); 

		if(count($wherevals) > 0 ) {
			$sql = "DELETE FROM " . $table .  "  WHERE " . $wherevals;
			return $this->query($sql,$params);
		}
	}

	public function encrypt($action, $string) {
	    $output = false;

	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'This is my secret key';
	    $secret_iv = 'This is my secret iv';

	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}			
}
?>
