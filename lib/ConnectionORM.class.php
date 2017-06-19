<?php


	class ConnectionORM {
    private $conn   = NULL;          
                function __construct() 
                {
                    $this->dbname = "TuGrueroNew";
                    //$this->host = '34.208.124.125';
                    $this->host = 'localhost';
                    $this->port = "3306";
                    $this->charset = "utf8";
                    $this->dsn = "mysql:dbname=".$this->dbname.";host=".$this->host.";port=".$this->port.";charset=".$this->charset;  
                    $this->username = 'admin_tugruero';
                    $this->password = 'tugrua';
                return $this->open();
                    
                }            
		public function getConnect($connect = ''){
		
        $NotOrm = new NotORM($this->conn);
		return $NotOrm; 
           
		}
		
		public function open() {

			if (!is_resource($this->conn)){
				$this->conn = @new PDO($this->dsn,$this->username,$this->password,array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			}
			return $this;
		}		
		public function close() {

			$this->conn = null;
		}
		public function ejecutarPreparado($query) {

			if (!is_resource($this->conn)){
				$this->conn = new PDO($this->dsn,$this->username,$this->password,array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			}
			
			$q = $this->conn->query($query);
			return $q;
		}	
		
	}
