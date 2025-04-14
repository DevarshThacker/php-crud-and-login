$(document).ready(function() {
    $('#same_address').on('click', function() {
        if ($(this).is(':checked')) {
            $('#shipping_flat_office_no').val($('#flat_office_no').val()).prop('disabled', true);
            $('#shipping_landmark').val($('#landmark').val()).prop('disabled', true);
            $('#shipping_pin_code').val($('#pin_code').val()).prop('disabled', true);
            $('#shipping_city').val($('#city').val()).prop('disabled', true);
            $('#shipping_state').val($('#state').val()).prop('disabled', true);
            $('#shipping_country').val($('#country').val()).prop('disabled', true);
        } else {
            $('#shipping_flat_office_no').val('').prop('disabled', false);
            $('#shipping_landmark').val('').prop('disabled', false);
            $('#shipping_pin_code').val('').prop('disabled', false);
            $('#shipping_city').val('').prop('disabled', false);
            $('#shipping_state').val('').prop('disabled', false);
            $('#shipping_country').val('').prop('disabled', false);
        }
    });
   
   
});
$(document).ready(function() {
    $('#enable_submit').on('change', function() {
        if ($(this).is(':checked')) {
            $("#make_order_btn").prop('disabled', false);
        } else {
            $("#make_order_btn").prop('disabled', true);
        }
    });
});
$(document).on('click', '#ord_btn', function() {
  
    $.ajax({
        url: '../e_php/product_get.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data) {
                 $('#product_dropdown').empty();
                 $('#product_dropdown').append($('<option>', {
                    text: "select product",
                    value: "",
                    
                }));
                $.each(data, function(index, product) {
                   // var productSku = product.sku; 
                    $('#product_dropdown').append($('<option>', {
                        text: product.product_title,
                        value: product.product_title,
                        'data-sku': product.sku
                    }));
                });
                $('#product_dropdown').on('change', function() {
                    var selectedProduct = $(this).find('option:selected');
                    $('#product_id').val(selectedProduct.data('sku'));
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching product data: ", error);
        }
    });
});




function resetForm() {
    $('#ord_form')[0].reset();
    $('#make_order_btn').prop('disabled', true);
}

$(document).ready(function() {
    $('#myModal').on('hidden.bs.modal', resetForm);

    $('#ord_form').validate({
        rules: {
            product_title: {
                required: true
            },
            quantity: {
                required: true,
                min: 1
            },
            flat_office_no: {
                required: true
            },
            landmark: {
                required: true
            },
            pin_code: {
                required: true,
                digits: true,
                minlength: 7,
                maxlength: 7
            },
            city: {
                required: true
            },
            state: {
                required: true
            },
            country: {
                required: true
            },
            shipping_flat_office_no: {
                required: true
            },
            shipping_landmark: {    
                required: true
            },
            shipping_pin_code: {
                required: true,
            },
            Shipping_city: {
                required: true
            },
            Shipping_state: {
                required: true
            },
        },
        messages: {
            // product_title: {
            //     required: "Please select a product."
            // },
            // quantity: {
            //     required: "Please enter a quantity.",
            //     min: "Quantity must be at least 1."
            // },
            // flat_office_no: {
            //     required: "Please enter your flat/office number."
            // },
            // landmark: {
            //     required: "Please enter a landmark."
            // },
            // pin_code: {
            //     required: "Please enter a pin code.",
            //     digits: "Please enter a valid pin code."
            // },
            // city: {
            //     required: "Please enter your city."
            // },
            // state: {
            //     required: "Please enter your state."
            // },
            // country: {
            //     required: "Please enter your country."
            // },
             // shipping_flat_office_no: {
            //     required: "Please enter your flat/office number."
            // },
            // shipping_landmark: {
            //     required: "Please enter a landmark."
            // },
            // shipping_pin_code: {
            //     required: "Please enter a pin code.",
            //     digits: "Please enter a valid pin code."
            // },
            // shipping_city: {
            //     required: "Please enter your city."
            // },
            // shipping_state: {
            //     required: "Please enter your state."
            // },
            // shipping_country: {
            //     required: "Please enter your country."
            // }
        },
        submitHandler: function(ord_form) {
            var formData = new FormData(ord_form);

            $.ajax({
                url: '../e_php/order_add.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    swal(response, {
                        icon: 'success',
                    });
                    $("#make_order_btn").on('click', function() {
                        $("#make_order_btn").prop('disabled', true);
                    });
                    resetForm();
                    // $.ajax({
                    //     type: 'POST',
                    //     url: '../e_php/order_list.php', 
                    //     dataType: 'json',
                    //     cache: false,
                    //     success: function(result) {
                    //         $('#order_table').DataTable().clear().rows.add(result.data).draw();
                    //     }
                    // });
                    listings();
                    $('#myModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Form has not been submitted.');
                    $('#myModal').modal('show');
                }
            });
        }
    });
    listings();
    function listings() {
        // $("#reset").click(function (e) {
        //     location.reload();
        // });
        if ($.fn.dataTable.isDataTable('#order_table')) {
            // If DataTable is already initialized, destroy it first
            $('#order_table').DataTable().clear().destroy();
        }
        $('#order_table').DataTable({
            ajax: {
                url: '../e_php/order_list.php'
                // dataSrc: "roomsData"
            },
                     columns: [
                        { data: null, render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }, title: 'Sr. No.' },
                        { data: 'id' },
                        {
                            data: null,
                            className: 'dt-center action_btns',
                            render: function (data, type, row) {
                                return `
                                    <button class="view-btn btn btn-primary" id="view_btn" title="View" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#myModal2"><i class="fa fa-eye"></i></button>
                                    <button class="edit-btn btn btn-warning" id="edit-btn" title="Edit" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#myModaledit"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="delete-btn btn btn-danger" id="remove-btn" title="Delete" data-id="${row.id}"><i class="fas fa-trash"></i></button>
                                `;
                            },
                            orderable: false
                        }
                    ]
            
        });
    };
    
    var table = $('#order_table').DataTable({
        // Your DataTable options here
        
    });
    $('#order_table').on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                 var row = table.row($(this).closest('tr'));
                 var row = $(this).closest('tr'); // Get the closest row to the delete button
            
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this order!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            url: '../e_php/order_remove.php', 
                            data: { id: id },
                            success: function(response) {
                                var result = JSON.parse(response);
                                if (result.status) {
                                    // Remove the row from the table
                                    // row.remove();
                                    swal("Your order has been deleted!", {
                                        icon: "success",
                                    });
                                    row.remove();
                                    listings();
                                } else {
                                    console.log(response);
                                    swal("Error deleting order: " + result.status, {
                                        icon: "error",
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                swal("An error occurred: " + error, {
                                    icon: "error",
                                });
                            }
                        });
                    } else {
                        swal("Your order is safe!");
                    }
                });
            });
    
});

// listing ajax


// $(document).ready(function() {
//     var table; 

//     $.ajax({
//         type: 'POST',
//         url: '../e_php/order_list.php',
//         dataType: 'json', 
//         cache: false,
//         success: function(result) {
//             console.log(result);
//             table = $('#order_table').DataTable({
//                 data: result.data,
//                 columns: [
//                     { data: null, render: function(data, type, row, meta) {
//                         return meta.row + 1;
//                     }, title: 'Sr. No.' },
//                     { data: 'id' },
//                     {
//                         data: null,
//                         className: 'dt-center action_btns',
//                         render: function (data, type, row) {
//                             return `
//                                 <button class="view-btn btn btn-primary" id="view_btn" title="View" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#myModal2"><i class="fa fa-eye"></i></button>
//                                 <button class="edit-btn btn btn-warning" id="edit-btn" title="Edit" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#myModaledit"><i class="fas fa-pencil-alt"></i></button>
//                                 <button class="delete-btn btn btn-danger" id="remove-btn" title="Delete" data-id="${row.id}"><i class="fas fa-trash"></i></button>
//                             `;
//                         },
//                         orderable: false
//                     }
//                 ]
//             });        
//         }
//     });

//     $('#order_table').on('click', '.delete-btn', function() {
//         var id = $(this).data('id');
//         // var row = table.row($(this).closest('tr'));
//          var row = $(this).closest('tr'); // Get the closest row to the delete button
    
//         swal({
//             title: "Are you sure?",
//             text: "You will not be able to recover this order!",
//             icon: "warning",
//             buttons: true,
//             dangerMode: true,
//         })
//         .then((willDelete) => {
//             if (willDelete) {
//                 $.ajax({
//                     type: 'POST',
//                     url: '../e_php/order_remove.php', 
//                     data: { id: id },
//                     success: function(response) {
//                         var result = JSON.parse(response);
//                         if (result.status) {
//                             // Remove the row from the table
//                             // row.remove();
//                             swal("Your order has been deleted!", {
//                                 icon: "success",
//                             });
//                             row.remove().draw();
//                         } else {
//                             console.log(response);
//                             swal("Error deleting order: " + result.status, {
//                                 icon: "error",
//                             });
//                         }
//                     },
//                     error: function(xhr, status, error) {
//                         swal("An error occurred: " + error, {
//                             icon: "error",
//                         });
//                     }
//                 });
//             } else {
//                 swal("Your order is safe!");
//             }
//         });
//     });});

$(document).on('click', '#view_btn', function() {
    let id = $(this).data('id');
    $.ajax({
        url: '../e_php/order_view.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            console.log(response);  
           
            if (response) {
                $('#order_id_view').text(response[0].id);
                $('#product_title_view').text(response[0].product_title);
                $('#product_id_view').text(response[0].prod_id);
                $('#quantity_view').text(response[0].ord_quantity);
                $('#shipping_flat_office_no_view').text(response[0].s_flat_no);
                $('#shipping_landmark_view').text(response[0].s_landmark);
                $('#shipping_pin_code_view').text(response[0].s_pincode);
                $('#shipping_city_view').text(response[0].s_city);
                $('#shipping_state_view').text(response[0].s_state);
                $('#shipping_country_view').text(response[0].s_country);
                $('#myModal2').modal('show'); 
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching order details: ", error);
            alert('Could not retrieve order details.');
        }
    });
});

// edit ajax order

$(document).on('click', '#edit-btn', function() {
  
    $.ajax({
        url: '../e_php/product_get.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data) {
                 $('#product_dropdown_edit').empty();
                 $('#product_dropdown_edit').append($('<option>', {
                    text: "select product",
                    value: "",
                    
                }));
                $.each(data, function(index, product) {
                   // var productSku = product.sku; 
                    $('#product_dropdown_edit').append($('<option>', {
                        text: product.product_title,
                        value: product.product_title,
                        'data-sku': product.sku
                    }));
                });
                $('#product_dropdown_edit').on('change', function() {
                    var selectedProduct = $(this).find('option:selected');
                    $('#product_id_edit').val(selectedProduct.data('sku'));
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching product data: ", error);
        }
    });
});
$(document).on('click', '#edit-btn', function() {
    let id = $(this).data('id');
    $.ajax({
        url: '../e_php/order_view.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            console.log(response);  
           
            if (response) {
                $('#id_edit').val(response[0].ord_id);
                console.log(response[0].ord_id)
                $('#product_dropdown_edit').val(response[0].product_title);
                $('#product_id_edit').val(response[0].prod_id);
                //$('#product_id_edit').attr('data-sku', skuValue);
                var skuValue = response[0].prod_id;



// Set the custom data attribute 'data-sku'
$('#product_id_edit').attr('data-sku', skuValue);



                $('#quantity_edit').val(response[0].ord_quantity);
                $('#flat_office_no_edit').val(response[0].o_flat_no);
                $('#landmark_edit').val(response[0].o_landmark);
                $('#pin_code_edit').val(response[0].o_pincode);
                $('#city_edit').val(response[0].o_city);
                $('#state_edit').val(response[0].o_state);
                $('#country_edit').val(response[0].o_country);
                $('#shipping_flat_office_no_edit').val(response[0].s_flat_no);
                $('#shipping_landmark_edit').val(response[0].s_landmark);
                $('#shipping_pin_code_edit').val(response[0].s_pincode);
                $('#shipping_city_edit').val(response[0].s_city);
                $('#shipping_state_edit').val(response[0].s_state);
                $('#shipping_country_edit').val(response[0].s_country);
                   $('#myModaledit').modal('show'); 
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching order details: ", error);
            alert('Could not retrieve order details.');
        }
    });
});
$(document).ready(function() {
    $('#same_address_edit').on('click', function() {
        if ($(this).is(':checked')) {
            $('#shipping_flat_office_no_edit').val($('#flat_office_no_edit').val()).prop('disabled', true);
            $('#shipping_landmark_edit').val($('#landmark_edit').val()).prop('disabled', true);
            $('#shipping_pin_code_edit').val($('#pin_code_edit').val()).prop('disabled', true);
            $('#shipping_city_edit').val($('#city_edit').val()).prop('disabled', true);
            $('#shipping_state_edit').val($('#state_edit').val()).prop('disabled', true);
            $('#shipping_country_edit').val($('#country_edit').val()).prop('disabled', true);
        } else {
            $('#shipping_flat_office_no_edit').val('').prop('disabled', false);
            $('#shipping_landmark_edit').val('').prop('disabled', false);
            $('#shipping_pin_code_edit').val('').prop('disabled', false);
            $('#shipping_city_edit').val('').prop('disabled', false);
            $('#shipping_state_edit').val('').prop('disabled', false);
            $('#shipping_country_edit').val('').prop('disabled', false);
        }
    });
   
   
});
// update order details

function resetEditForm() {
    $('#ord_form_edit')[0].reset();
    // $('#make_order_btn').prop('disabled', true);
}

$(document).ready(function() {
    $('#myModaledit').on('hidden.bs.modal', resetForm);

    $('#ord_form_edit').validate({
        rules: {
            product_title: {
                required: true
            },
            quantity: {
                required: true,
                min: 1
            },
            flat_office_no: {
                required: true
            },
            landmark: {
                required: true
            },
            pin_code: {
                required: true,
                digits: true,
                minlength: 7,
                maxlength: 7
            },
            city: {
                required: true
            },
            state: {
                required: true
            },
            country: {
                required: true
            },
            shipping_flat_office_no: {
                required: true
            },
            shipping_landmark: {    
                required: true
            },
            shipping_pin_code: {
                required: true,
            },
            Shipping_city: {
                required: true
            },
            Shipping_state: {
                required: true
            },
        },
        messages: {
            // product_title: {
            //     required: "Please select a product."
            // },
            // quantity: {
            //     required: "Please enter a quantity.",
            //     min: "Quantity must be at least 1."
            // },
            // flat_office_no: {
            //     required: "Please enter your flat/office number."
            // },
            // landmark: {
            //     required: "Please enter a landmark."
            // },
            // pin_code: {
            //     required: "Please enter a pin code.",
            //     digits: "Please enter a valid pin code."
            // },
            // city: {
            //     required: "Please enter your city."
            // },
            // state: {
            //     required: "Please enter your state."
            // },
            // country: {
            //     required: "Please enter your country."
            // },
             // shipping_flat_office_no: {
            //     required: "Please enter your flat/office number."
            // },
            // shipping_landmark: {
            //     required: "Please enter a landmark."
            // },
            // shipping_pin_code: {
            //     required: "Please enter a pin code.",
            //     digits: "Please enter a valid pin code."
            // },
            // shipping_city: {
            //     required: "Please enter your city."
            // },
            // shipping_state: {
            //     required: "Please enter your state."
            // },
            // shipping_country: {
            //     required: "Please enter your country."
            // }
        },
        submitHandler: function(ord_form_edit) {
            var formData = new FormData(ord_form_edit);

            $.ajax({
                url: '../e_php/order_edit.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    swal(response, {
                        icon: 'success',
                    });
                    // $("#update_order_btn").on('click', function() {
                    //     $("#update_order_btn").prop('disabled', true);
                    // });
                    resetEditForm();
                    $('#myModaledit').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Form has not been submitted.');
                    $('#myModaledit').modal('show');
                }
            });
        }
    });
});


// // //remove order details
// // $(document).ready(function(){
   
// // $('#order_table').on('click', '#remove-btn', function() {
// //     var row = table.row($(this).closest('tr'));
// //     var sku = row.data().sku;
    
// //     swal({
// //         title: "Are you sure?",
// //         text: "This product will deleted permently",
// //         icon: "warning",
// //         buttons: true,
// //         dangerMode: true,
// //     })
// //     .then((willDelete) => {
// //         if (willDelete) {
// //             $.ajax({
// //                 url: '../e_php/order_remove.php',
// //                 type: 'POST',
// //                 data: {
// //                     sku: sku
// //                 },
// //                 success: function(response) {
// //                     var result = JSON.parse(response);
// //                     if(result.status) {
// //                         swal("Success!", "Product has been deleted!", "success");
// //                         row.remove().draw();
// //                     } else {
// //                         swal("Error!", "Failed to delete product", "error");
// //                     }
// //                 },
// //                 error: function() {
// //                     swal("Error!", "Failed to delete product", "error");
// //                 }
// //             });
// //         }
// //     });
// // });
// // });
// // $(document).ready(function() {
// //     $('#order_table').on('click', '#remove-btn', function() {
// //         var row = $(this).closest('tr');
// //         var sku = row.find('.sku').text();

// //         swal({
// //             title: "Are you sure?",
// //             text: "This product will be deleted permanently",
// //             icon: "warning",
// //             buttons: true,
// //             dangerMode: true,
// //         })
// //         .then((willDelete) => {
// //             if (willDelete) {
// //                 $.ajax({
// //                     url: '../e_php/order_remove.php',
// //                     type: 'POST',
// //                     data: {
// //                         sku: sku
// //                     },
// //                     success: function(response) {
// //                         var result = JSON.parse(response);
// //                         if (result.status) {
// //                             swal("Success!", "Product has been deleted!", "success");
// //                             row.remove();
// //                         } else {
// //                             swal("Error!", "Failed to delete product", "error");
// //                         }
// //                     },
// //                     error: function() {
// //                         swal("Error!", "Failed to delete product", "error");
// //                     }
// //                 });
// //             }
// //         });
// //     });
// // });