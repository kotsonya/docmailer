<?php
require_once '../dm_functions.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}

$conn = connect_db();
$query = "SELECT * FROM partners WHERE partners_id = '$id'";
$result = $conn->query($query);
while($partner = mysqli_fetch_array($result)) {
    echo '<p><input type="text" value="'.$partner['partners_name'].'" class="form-control" id="partner_name_edit"></p>';
    echo '<p><input type="text" value="'.$partner['partners_address'].'" class="form-control" id="partner_address_edit"></p>';
    echo '<p><input type="text" value="'.$partner['partners_contacts'].'" class="form-control" id="partner_contacts_edit"></p>';
    echo '<p><input type="hidden" value="'.$partner['partners_id'].'" class="form-control" id="partner_id_edit"></p>';
}