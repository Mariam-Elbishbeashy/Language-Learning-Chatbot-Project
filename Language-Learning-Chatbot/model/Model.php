<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../db/dbh.inc.php';

abstract class Model{
    protected $db;
    protected $conn;

    public function connect(){
        return $this->db;
    }
}


?>