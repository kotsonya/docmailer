<?php
require_once '../dm_functions.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}

$conn = connect_db();
$query = "SELECT * FROM partners WHERE partners_id = '$id'";
$result = $conn->query($query);
while($partner = mysqli_fetch_array($result)) {
    echo '<p>'.$partner['partners_name'].'</p>';
    echo '<p>'.$partner['partners_address'].'</p>';
    echo '<p>'.$partner['partners_contacts'].'</p>';
    echo '<p><input type="hidden" value="'.$partner['partners_id'].'" class="form-control" id="partner_id"></p>';
}