<?php
    class Database {
        private $host;
        private $user;
        private $password;
        private $database;

        function __construct($host, $user, $password, $database) {
            $this->host = $host;
            $this->user = $user;
            $this->password = $password;
            $this->database = $database;
        }

        public function connect() {
            $db = new PDO("sqlsrv:Server=$this->host;Database=$this->database", $this->user, $this->password) or die("Cannot connect to SQL server");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        }
    }
?>