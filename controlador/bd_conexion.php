<?php
 $conn = new mysqli('localhost', 'root', 'A9xkh8t2mn', 'untrmeventos');
 
 if ($conn->connect_error) {
     echo $error -> $conn->connect_error;
 }

 $conn->set_charset("utf8");
?>