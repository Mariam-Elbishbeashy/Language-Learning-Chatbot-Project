<?php
require_once __DIR__ . '/../db/dbh.inc.php';

abstract class Model2 {
    protected $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }
}
?>
