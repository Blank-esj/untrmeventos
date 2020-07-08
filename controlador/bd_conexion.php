<?php
 $conn = new mysqli('localhost', 'root', '1234', 'untrmeventos');
 
 if ($conn->connect_error) {
     echo $error -> $conn->connect_error;
 }

 $conn->set_charset("utf8");
