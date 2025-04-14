<?php
include "config.php";

// $limit = isset($_GET['item']) ? (int)$_GET['item'] : 5;


// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $offset = ($page - 1) * $limit;

// $query1="SELECT count(*) as total_data FROM users where deleted= 0";
// $result = $conn->query($query1);
// $row = $result->fetch_assoc();
// $total_data=$row['total_data'];
// $total_pages = ceil($total_data/$limit);
// if ($page > $total_pages) {
//     $page = $total_pages;
// } else if ($page < 1) {
//     $page = 1;
// }

// $data_query = "SELECT * FROM product WHERE ORDER BY id DESC LIMIT $limit OFFSET $offset";
$data_query = "SELECT * FROM product";
$result = $conn->query($data_query);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} 

// else {
//    echo json_encode(0);
//     //echo json_encode(array("message" => "No results found"));
//     exit;
// }

// $conn->close();

//  $response = array(
//     'data' => $data,
//     'total_data' => $total_data
// );
// echo json_encode($response); 
echo json_encode(['data' => $data]);
// echo json_encode($total_pages);
?>

