<?php
require_once '../dm_functions.php';
$conn = connect_db();

$id = $_POST['id'];
$name = $conn->real_escape_string($_POST['partner_name']);
$address = $conn->real_escape_string($_POST['partner_address']);
$contact = $conn->real_escape_string($_POST['partner_contact']);

$query = "UPDATE partners SET partners_name = '$name', partners_address = '$address', partners_contacts = '$contact' WHERE partners_id = '$id'";
$conn->query($query);