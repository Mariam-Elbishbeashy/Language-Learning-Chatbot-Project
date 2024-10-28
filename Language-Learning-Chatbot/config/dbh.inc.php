<?php
$servername = "localhost";
$username = "root";
$password = "";
$DB = "LLchatbot_db";

$conn = mysqli_connect($servername,$username,$password,$DB);


if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}