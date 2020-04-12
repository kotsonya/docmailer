<?php
require_once '../dm_functions.php';
session_start();

$conn = connect_db();
$sql_partners = "SELECT * FROM partners WHERE user_id=" . $_SESSION["user_id"] . " ORDER BY partners_name ";
$result_partners_list = $conn->query($sql_partners);
while ($row = mysqli_fetch_array($result_partners_list)) {
     echo '
          <tr>  
               <td>' . $row["partners_name"] . '</td>  
               <td>' . $row["partners_address"] . '</td>  
               <td>' . $row["partners_contacts"] . '</td>
               <td style="white-space:nowrap;">
               <td><a href="#" class="edit_partner btn btn-sm" data-id="' . $row['partners_id'] . '" data-toggle="modal" data-target="#modal_edit_partner"><i class="fa fa-edit"></i></a></td>
               <td><a href="#" class="delete_partner btn btn-sm" data-id="' . $row['partners_id'] . '" data-toggle="modal" data-target="#modal_delete_partner"><i class="fa fa-trash"></i></a></td>
          </tr>';
}
?>