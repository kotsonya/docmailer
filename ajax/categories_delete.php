<?php
require_once '../dm_functions.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}

$conn = connect_db();
$query = "DELETE FROM categories WHERE category_id = '$id'";
$conn->query($query);