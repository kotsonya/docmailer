<?php
require_once '../dm_functions.php';
session_start();
$conn = connect_db();

$userid = $_SESSION["user_id"];
$name = $conn->real_escape_string($_POST["partner_name"]);
$address = $conn->real_escape_string($_POST["partner_address"]);
$contact = $conn->real_escape_string($_POST["partner_contact"]);

$query = "INSERT INTO partners (user_id, partners_name, partners_address, partners_contacts) VALUES('$userid', '$name', '$address', '$contact')";
$conn->query($query);
echo $conn->error;
?>