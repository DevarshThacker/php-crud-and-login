<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $id = $_POST['id_edit'];
    $id=isset($_POST['id'])? $_POST['id']:'';
   
    // echo "<pre></pre>"; print_r($_POST['city_edit']);exit;
   
    $ord_id = isset($_POST['ord_id']) ? $_POST['ord_id'] : '';
    $product_id = isset($_POST['product_id_edit']) ? $_POST['product_id_edit'] : '';
    // $product_title = $_POST['product_title_edit'];
    // $quantity = $_POST['quantity_edit']; 
    // $flat_office_no = $_POST['flat_office_no_edit']; 
    // $landmark = $_POST['landmark_edit'];
    // $pin_code = $_POST['pin_code_edit'];
    // $city = $_POST['city_edit'];
    // $state = $_POST['state_edit'];
 //   $country = $_POST['country_edit'];


    $product_title = isset($_POST['product_title']) ? $_POST['product_title'] : '';
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
$flat_office_no = isset($_POST['flat_office_no_edit']) ? $_POST['flat_office_no_edit'] : '';
$landmark = isset($_POST['landmark_edit']) ? $_POST['landmark_edit'] : '';
$pin_code = isset($_POST['pin_code_edit']) ? $_POST['pin_code_edit'] : '';
$city = isset($_POST['city_edit']) ? $_POST['city_edit'] : '';
$state = isset($_POST['state_edit']) ? $_POST['state_edit'] : '';
$country = isset($_POST['country_edit']) ? $_POST['country_edit'] : '';

$same_address = isset($_POST['same_address_edit']) ? $_POST['same_address_edit'] : 'no'; 
$shipping_flat_office_no = $same_address === 'yes' ? $flat_office_no : $_POST['shipping_flat_office_no_edit']; 
$shipping_landmark = $same_address === 'yes' ? $landmark : $_POST['shipping_landmark_edit'];
$shipping_pin_code = $same_address === 'yes' ? $pin_code : $_POST['shipping_pin_code_edit'];
$shipping_city = $same_address === 'yes' ? $city : $_POST['shipping_city_edit'];
$shipping_state = $same_address === 'yes' ? $state : $_POST['shipping_state_edit'];
$shipping_country = $same_address === 'yes' ? $country : $_POST['shipping_country_edit'];



//  $shipping_flat_office_no = isset($_POST['shipping_flat_office_no_edit']) ? $_POST['shipping_flat_office_no_edit'] : '';
// $shipping_landmark = isset($_POST['shipping_landmark_edit']) ? $_POST['shipping_landmark_edit'] : '';
// $shipping_pin_code = isset($_POST['shipping_pin_code_edit']) ? $_POST['shipping_pin_code_edit'] : '';
// $shipping_city = isset($_POST['shipping_city_edit']) ? $_POST['shipping_city_edit'] : '';
// $shipping_state = isset($_POST['shipping_state_edit']) ? $_POST['shipping_state_edit'] : '';
// $shipping_country = isset($_POST['shipping_country_edit']) ? $_POST['shipping_country_edit'] : '';

    // Insert into the order table
  
    $query = "UPDATE `order` SET `product_title`='$product_title',`ord_quantity`='$quantity',
            `prod_id`='$product_id' WHERE id='$id'";
            echo $query;
   
            

    if (mysqli_query($conn, $query)) {
      //  $order_id = mysqli_insert_id($conn); 
      

        $address_query = "UPDATE ord_address 
        SET o_flat_no = '$flat_office_no', 
            o_landmark = '$landmark', 
            o_pincode = '$pin_code', 
            o_city = '$city', 
            o_state = '$state', 
            o_country = '$country', 
            s_flat_no = '$shipping_flat_office_no', 
            s_landmark = '$shipping_landmark', 
            s_pincode = '$shipping_pin_code', 
            s_city = '$shipping_city', 
            s_state = '$shipping_state', 
            s_country = '$shipping_country' 
        WHERE ord_id = '$id'";
        echo $address_query;

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
