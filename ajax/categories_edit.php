<?php
require_once '../dm_functions.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}
$conn = connect_db();
$query = "SELECT * FROM categories WHERE category_id = '$id'";
$result = $conn->query($query);
while($categories = mysqli_fetch_array($result)) {

    echo '<p><input type="text" value="'.$categories['category'].'" class="form-control" id="categories_data_edit"></p>';
    echo '<p><input type="hidden" value="'.$categories['category_id'].'" class="form-control" id="categories_id_edit"></p>';
}