<?php
include 'db_connect'; //establish connection to db

//creates database with specified name
$sql = "CREATE DATABASE school_db";

$conn->close(); //closes db connection
?>