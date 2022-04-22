<?php
    class Database {
        //BD params
        private $host = 'localhost';
        private $db_name = 'api_5hds_gestion_stock';
        private $username = 'root';
        private $password = '';
        private $conn;

        //DB Connect
        public function connect() {
            $this->conn = null;

            try {
                $this-> conn = new PDO('mysql:host=' . $this->host . ';dbname=' .$this->db_name, 
                $this->username . $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        }
    }