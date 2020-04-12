<?php
require_once '../dm_functions.php';
$conn = connect_db();

$id = $_POST['id'];
$category = $conn->real_escape_string($_POST['category_data']);

$query = "UPDATE categories SET category = '$category' WHERE category_id = '$id'";
$conn->query($query);
