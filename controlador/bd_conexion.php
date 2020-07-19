<?php
include_once 'keys.php';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    echo $error->$conn->connect_error;
}

$conn->set_charset("utf8");
