<?php
include "nav.php"
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <script src="../e_js/order.js"></script>
    <link rel="stylesheet" href="../e_css/orderpage.css">


</head>

<body>
    <div class="container  mt-4">
        <div class="d-flex justify-content-center  mb-3">
            <h2 class="head1">Order</h2><br>
        </div>
        <div class="d-flex flex-row-reverse mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="ord_btn">
                <i class="fa-solid fa-plus orderbtn"></i></button>
            </button>
        </div>
        <div class="table-responsive">
            <table id="order_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>sr.no.</th>
                        <th>Order_ID</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- order model -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Order</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" name="myform" method="post" enctype="multipart/form-data" id="ord_form">

                        <label for="products">Product:</label>
                        <select id="product_dropdown" name="product_title">

                            <option value="">Select a product</option>
                        </select><br>
                        <input type="hidden" id="product_id" name="product_id" data-sku="">

                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1"><br>

                        <h5>Delivery Address</h5>
                        <label for="flat_office_no">Flat/Office No.:</label>
                        <input type="text" id="flat_office_no" name="flat_office_no"><br>

                        <label for="landmark">Landmark:</label>
                        <input type="text" id="landmark" name="landmark"><br>

                        <label for="pin_code">Pin Code:</label>
                        <input type="tel" id="pin_code" name="pin_code"><br>

                        <label for="city">City:</label>
                        <input type="text" id="city" name="city"><br>

                        <label for="state">State:</label>
                        <input type="text" id="state" name="state"><br>

                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country"><br>

                        <input type="checkbox" id="same_address" name="same_address" value="yes">
                        <label for="same_address">Is delivery and shipping address the same?</label><br>

                        <h4>Shipping Address</h4>
                        <label for="shipping_flat_office_no">Flat/Office No.:</label>
                        <input type="text" id="shipping_flat_office_no" name="shipping_flat_office_no"><br>

                        <label for="shipping_landmark">Landmark:</label>
                        <input type="text" id="shipping_landmark" name="shipping_landmark"><br>

                        <label for="shipping_pin_code">Pin Code:</label>
                        <input type="tel" id="shipping_pin_code" name="shipping_pin_code"><br>

                        <label for="shipping_city">City:</label>
                        <input type="text" id="shipping_city" name="shipping_city"><br>

                        <label for="shipping_state">State:</label>
                        <input type="text" id="shipping_state" name="shipping_state"><br>

                        <label for="shipping_country">Country:</label>
                        <input type="text" id="shipping_country" name="shipping_country"><br>

                        <input type="checkbox" id="enable_submit" name="same_address" value="yes">
                        <label for="enable_submit">I agree to the terms and conditions</label><br>

                        <input type="submit" class="btn btn-success" value="Make Order" id="make_order_btn" disabled>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- veiw model -->
<div class="modal" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">View Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="order_details">
                    <p><strong>Order ID:</strong> <span id="order_id_view"></span></p>
                    <p><strong>Product Title:</strong> <span id="product_title_view"></span></p>
                    <p><strong>Product ID:</strong> <span id="product_id_view"></span></p>
                    <p><strong>Quantity:</strong> <span id="quantity_view"></span></p>
                    
                    <p><strong>Shipping Address:</strong></p>
                    <p><strong>Flat/Office No.:</strong> <span id="shipping_flat_office_no_view"></span></p>
                    <p><strong>Landmark:</strong> <span id="shipping_landmark_view"></span></p>
                    <p><strong>Pin Code:</strong> <span id="shipping_pin_code_view"></span></p>
                    <p><strong>City:</strong> <span id="shipping_city_view"></span></p>
                    <p><strong>State:</strong> <span id="shipping_state_view"></span></p>
                    <p><strong>Country:</strong> <span id="shipping_country_view"></span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- edit model -->
<div class="modal" id="myModaledit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Order Edit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" name="myform" method="post" enctype="multipart/form-data" id="ord_form_edit">
                    <input type="hidden" id="id_edit" name="id" value="">
                       
                        <label for="products">Product:</label>
                        <select id="product_dropdown_edit" name="product_title">

                            <option value="">Select a product</option>
                        </select><br>
                        <input type="hidden" id="product_id_edit" name="product_id_edit" data-sku="">

                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity_edit" name="quantity" min="1"><br>

                        <h5>Delivery Address</h5>
                        <label for="flat_office_no_edit">Flat/Office No.:</label>
                        <input type="text" id="flat_office_no_edit" name="flat_office_no_edit"><br>

                        <label for="landmark_edit">Landmark:</label>
                        <input type="text" id="landmark_edit" name="landmark_edit"><br>

                        <label for="pin_code_edit">Pin Code:</label>
                        <input type="tel" id="pin_code_edit" name="pin_code_edit"><br>

                        <label for="city_edit">City:</label>
                        <input type="text" id="city_edit" name="city_edit"><br>

                        <label for="state_edit">State:</label>
                        <input type="text" id="state_edit" name="state_edit"><br>

                        <label for="country_edit">Country:</label>
                        <input type="text" id="country_edit" name="country_edit"><br>

                        <input type="checkbox" id="same_address_edit" name="same_address_edit" value="yes">
                        <label for="same_address_edit">Is delivery and shipping address the same?</label><br>

                        <h4>Shipping Address</h4>
                        <label for="shipping_flat_office_no_edit">Flat/Office No.:</label>
                        <input type="text" id="shipping_flat_office_no_edit" name="shipping_flat_office_no_edit"><br>

                        <label for="shipping_landmark_edit">Landmark:</label>
                        <input type="text" id="shipping_landmark_edit" name="shipping_landmark_edit"><br>

                        <label for="shipping_pin_code_edit">Pin Code:</label>
                        <input type="tel" id="shipping_pin_code_edit" name="shipping_pin_code_edit"><br>

                        <label for="shipping_city_edit">City:</label>
                        <input type="text" id="shipping_city_edit" name="shipping_city_edit"><br>

                        <label for="shipping_state_edit">State:</label>
                        <input type="text" id="shipping_state_edit" name="shipping_state_edit"><br>

                        <label for="shipping_country_edit">Country:</label>
                        <input type="text" id="shipping_country_edit" name="shipping_country_edit"><br>

                        <input type="checkbox" id="enable_submit_edit" name="same_address_edit" value="yes">
                        <label for="enable_submit_edit">I agree to the terms and conditions</label><br>

                        <input type="submit" class="btn btn-success" value="Update Order" id="update_order_btn">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancel_btn_edit">Cancel</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
 


</body>

</html>