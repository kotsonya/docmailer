<?php
require_once '../dm_functions.php';
session_start();

$conn = connect_db();

$sql_categories = "SELECT * FROM categories WHERE user_id=" . $_SESSION["user_id"] . " ORDER BY category ";
$result_categories_list = $conn->query($sql_categories);

while ($row = mysqli_fetch_array($result_categories_list)) {
    echo '
                               <tr>  
                                    <td>' . $row["category"] . '</td>  
                                    <td style="white-space:nowrap;">
                                    <td><a href="#" class="edit_categories btn btn-sm" data-id="' . $row['category_id'] . '" data-toggle="modal" data-target="#modal_edit_categories"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="#" class="delete_categories btn btn-sm" data-id="' . $row['category_id'] . '" data-toggle="modal" data-target="#modal_delete_categories"><i class="fa fa-trash"></i></a></td>
                               </tr>';
}
?>