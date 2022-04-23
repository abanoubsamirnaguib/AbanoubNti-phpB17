<?php

namespace App\Database\Config;

use mysqli;

class Connection
{
    protected $DB_hostName = 'localhost';
    protected $DB_username = 'root';
    protected $DB_password = '';
    protected $DB_database = 'task4';
    protected $DB_port = 3306;
    public mysqli $con;
    public function __construct()
    {
        $this->con = new mysqli(
            $this->DB_hostName,
            $this->DB_username,
            $this->DB_password,
            $this->DB_database,
            $this->DB_port
        );
        // Check connection
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
        // echo "Connected successfully";
    }
    
    public function __destruct () {
        $this->con->close();
    }
}
