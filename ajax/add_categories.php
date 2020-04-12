<?php
require_once '../dm_functions.php';
session_start();
$conn = connect_db();

$user_id = $_SESSION["user_id"];
$category = $conn->real_escape_string($_POST["category_post"]);
var_dump($category);

$query = "INSERT INTO categories (user_id, category) VALUES('$user_id', '$category')";
$conn->query($query);
echo $conn->error;