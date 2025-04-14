<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $ord_id = isset($_POST['ord_id']) ? $_POST['ord_id'] : '';
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $product_title = $_POST['product_title'];
    $quantity = $_POST['quantity']; 
    $flat_office_no = $_POST['flat_office_no']; 
    $landmark = $_POST['landmark'];
    $pin_code = $_POST['pin_code'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $same_address = isset($_POST['same_address']) ? $_POST['same_address'] : 'no'; 
    $shipping_flat_office_no = $same_address === 'yes' ? $flat_office_no : $_POST['shipping_flat_office_no']; 
    $shipping_landmark = $same_address === 'yes' ? $landmark : $_POST['shipping_landmark'];
    $shipping_pin_code = $same_address === 'yes' ? $pin_code : $_POST['shipping_pin_code'];
    $shipping_city = $same_address === 'yes' ? $city : $_POST['shipping_city'];
    $shipping_state = $same_address === 'yes' ? $state : $_POST['shipping_state'];
    $shipping_country = $same_address === 'yes' ? $country : $_POST['shipping_country'];

    // Insert into the order table
    $query = "INSERT INTO `order` (product_title, ord_quantity, prod_id) 
              VALUES ('$product_title', '$quantity', '$product_id');";
    
    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn); 
        echo $order_id;

        // Insert into the ord_address table
        $address_query = "INSERT INTO ord_address (ord_id, o_flat_no, o_landmark, o_pincode, o_city, o_state, o_country, 
                        s_flat_no, s_landmark, s_pincode, s_city, s_state, s_country) 
                        VALUES ('$order_id', '$flat_office_no', '$landmark', '$pin_code', '$city', '$state', '$country', 
                        '$shipping_flat_office_no', '$shipping_landmark', '$shipping_pin_code', '$shipping_city', '$shipping_state', '$shipping_country')";
        
        if (mysqli_query($conn, $address_query)) {
            echo "New order created successfully";
        } else {
            echo "Error: " . $address_query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>
