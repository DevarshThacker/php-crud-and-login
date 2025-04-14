<?php
include "config.php";
$id = $_POST['id'];


// $data_query = "SELECT `order`.*, `ord_address`.`s_flat_no`, `ord_address`.`s_landmark`,
// `ord_address`.`s_pincode`, `ord_address`.`s_city`, `ord_address`.`s_state`, `ord_address`.`s_country`
// FROM `order` 
// LEFT JOIN `ord_address` ON `order`.`id` = `ord_address`.`ord_id` 
// WHERE `order`.`id` = '$id'";
$data_query = "SELECT `order`.*, `ord_address`.*
FROM `order` 
LEFT JOIN `ord_address` ON `order`.`id` = `ord_address`.`ord_id` 
WHERE `order`.`id` = '$id'";
$result = $conn->query($data_query);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} 
// echo json_encode(['data' => $data]);
echo json_encode($data);
?>
