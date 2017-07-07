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

                }

		public function getConnect() {
			if (!is_resource($this->conn)){

				try{
					$this->conn = @new PDO($this->dsn,$this->username,$this->password,array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

				}catch(PDOException $e){
					//echo $e->getMessage();die;
					echo "Error: ".$e->getMessage();die;
				}
			}
			$NotOrm = new NotORM($this->conn);
			return $NotOrm;
		}
		public function close() {

			$this->conn = null;
		}
		public function ejecutarPreparado($query) {

			if (!is_resource($this->conn)){
				try{
					$this->conn = @new PDO($this->dsn,$this->username,$this->password,array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

				}catch(PDOException $e){
					//echo $e->getMessage();die;
					echo "Error: ".$e->getMessage();die;
				}

			}

			$q = $this->conn->query($query);
			return $q;
		}

	}
