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

    <!-- Essential CSS and JS
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/editor/2.0.0/css/editor.dataTables.min.css">
    <link rel="stylesheet" href="../e_css/productpage.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/editor/2.0.0/js/dataTables.editor.min.js"></script>
    <script src="../e_js/product.js"></script> -->
    <script src="../e_js/product.js"></script>
    <link rel="stylesheet" href="../e_css/productpage.css">

    <script>
       
    </script>   
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-center mb-3">
            <h2 class="head1">Product</h2><br>
        </div>
        <div class="d-flex flex-row-reverse mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="btn1">
                <i class="fa-solid fa-plus addbtn"></i>
            </button>
        </div>
        <div class="table-responsive">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Product Title</th>
                        <th style="word-wrap: break-word;width: 50%;">Product Description</th>
                        <th>Available Stock</th>
                        <th>Vendor Name</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" name="myform" method="post" enctype="multipart/form-data" id="form1">
                        <label for="sku">SKU:</label>
                        <input type="text" id="sku" name="sku"><br>

                        <label for="product_title">Product Title:</label>
                        <input type="text" id="product_title" name="product_title"><br>

                        <label for="product_description">Product Description:</label>
                        <textarea id="product_description" name="product_description"></textarea><br>

                        <label for="stoke">Available Stock:</label>
                        <input type="number" id="stoke" name="stoke" min="0"><br>

                        <label for="vander_name">Vendor Name:</label>
                        <input type="text" id="vander_name" name="vander_name"><br>

                        <label for="image">Upload Images:</label>
                        <input type="file" id="image" name="image[]" accept="image/*" multiple><br>

                        <input type="checkbox" id="check" name="check" value="check">
                        <label for="check">You have entered all the details correctly.</label><br>

                        <input type="submit" class="btn btn-success" value="Create User">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>