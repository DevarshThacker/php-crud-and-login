function resetForm() {
    $('#form1')[0].reset();
}
// create ajax request
$(document).ready(function() {
    $('#myModal').on('hidden.bs.modal', resetForm);

    $('#form1').validate({
        rules: {
            sku: {
                required: true,
                maxlength: 15,
                minlength: 15,
                pattern: /^[0-9]{5}[A-Za-z0-9]{10}$/
            },
            product_title: {
                required: true
            },
            product_description: {
                required: true,
                minlength: 200
            },
            stoke: {
                required: true,
                min: 0
            },
            vander_name: {
                required: true
            },
            "image[]": {
                required: true,
                accept: "image/jpg,image/jpeg,image/png,image/gif",
                minlength: 3
            },
            check: {
                required: true
            }
        },
        messages: {
            sku: {
                required: "SKU is required",
                pattern: "SKU must be 5 digits followed by 10 alphanumeric characters"
            },
            product_title: {
                required: "Product title is required"
            },
            product_description: {
                required: "Product description is required"
            },
            stoke: {
                required: "Available stock is required",
                min: "Stock cannot be negative"
            },
            vander_name: {
                required: "Vendor name is required"
            },
            "image[]": {
                required: "At least three images are required",
                accept: "Only image files are allowed",
                minlength: "At least three images are required"
            },
            check: {
                required: "Please confirm that all details are correct"
            }
        },
        submitHandler: function(form1) {
            var formData = new FormData($('#form1')[0]);

            // Validate the number of selected files
            if ($('#image')[0].files.length < 3) {
                alert("Please upload at least 3 images.");
                return false;
            }

            $.ajax({
                url: '../e_php/product_add.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    swal(response, {
                        icon: 'success',
                    });
                    resetForm();
                    // Reload the data in the table after adding a new product
                    $.ajax({
                        type: 'POST',
                        url: '../e_php/product_list.php', 
                        dataType: 'json',
                        cache: false,
                        success: function(result) {
                            $('#example').DataTable().clear().rows.add(result.data).draw();
                        }
                    });
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
});

$(document).ready(function() {
    var table;

    // Fetch data from the server
    $.ajax({
        type: 'POST',
        url: '../e_php/product_list.php',
        dataType: 'json',
        cache: false,
        success: function(result) {
            console.log(result);
            table = $('#example').DataTable({
                data: result.data,
                columns: [
                    { data: 'sku' },
                    { data: 'product_title' },
                    { 
                        data: 'product_description',
                        render: function(data, type, row) {
                            return '<div class="" style="">' + data + '</div>';
                        },
                        width: '50px'
                    },
                    { data: 'stoke' },
                    { data: 'vander_name' },
                    {
                        data: 'product_images',
                        "render": function(data) {
                            console.log(data);
                            if (!data) return '';
                            var images = data.split(',');
                            return '<img src="../prodimg/' + images[0] + '" class="avatar" width="50" height="50"/>';
                        }
                    },
                    {
                        data: null,
                        className: 'dt-center del_btn',
                        defaultContent: '<button class="delete-btn btn btn-danger"><i class="fa fa-trash"/></button>',
                        orderable: false
                    }
                ]
            });

            // Inline editing functionality (update text columns or image columns)
            $('#example').on('click', 'tbody td:not(:first-child,:last-child)', function(e) {
                var cell = table.cell(this);
                var currentValue = cell.data();
                var columnIndex = cell.index().column;
                var columnName = table.column(columnIndex).dataSrc();

              
                if (columnName === 'product_images') {
                   
                    if ($(this).find('input[type="file"]').length > 0) {
                        return; 
                    }

                    var input = $('<input type="file" accept="image/*">');  

  input.on('change', function(e) {
                        var file = e.target.files[0];
                        if (file) {
                            var formData = new FormData();
                            formData.append('image', file);
                            formData.append('sku', table.row(cell.index().row).data().sku);  
                            formData.append('column', columnName);  

                        
                            $.ajax({
                                url: '../e_php/extra.php',
                                type: 'POST',
                                data: formData,
                                contentType: false,  
                                processData: false, 
                                success: function(response) {
                                    console.log(response);

                                   
                                    if (response) {
                                        var newImageSrc = response;

                                        // Find the <img> tag inside the cell and update the image source
                                        // var imgElement = cell.find('img');
                                        // if (imgElement.length > 0) {
                                        //     imgElement.attr('src', newImageSrc);  // Update the image source with the new full URL
                                        // } else {
                                        //     // If there is no img tag, add one with the new source
                                        //     cell.html('<img src="../prodimg/' + newImageSrc + '" alt="Image">');
                                        // }
                                        //cell.data('<img src="../prodimg/' + newImageSrc + '" alt="Image" width="50" height="50">').draw();  // Update the cell's data with the full URL
                                        $.ajax({
                                            type: 'POST',
                                            url: '../e_php/product_list.php', 
                                            dataType: 'json',
                                            cache: false,
                                            success: function(result) {
                                                $('#example').DataTable().clear().rows.add(result.data).draw();
                                            }
                                        });

                                        cell.data(newImageSrc).draw();  
                                    } else {
                                        alert('Failed to upload the image: ' + response); 
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('Error uploading image: ' + error);
                                }
                            });
                        }
                    });

                    $(this).html(input);

                    input[0].click();
                }else {
                    var input = $('<input type="text">')
                        .val(currentValue)
                        .on('blur', function() {
                            var newValue = $(this).val();
                            if (newValue !== currentValue) {
                                $.ajax({
                                    url: '../e_php/extra.php',
                                    type: 'POST',
                                    data: {
                                        sku: table.row(cell.index().row).data().sku,
                                        column: columnName,
                                        value: newValue
                                    },
                                    success: function(response) {
                                        cell.data(newValue).draw();
                                    },
                                    error: function() {
                                        alert('Failed to update');
                                    }
                                });
                            } else {
                                cell.data(currentValue).draw();
                            }

                            $(this).remove();
                            $(e.target).show();
                        });

                    $(this).html(input);
                    input.focus();
                }
            });
//         }
//     });
// });

            // delete ajax
            $('#example').on('click', '.delete-btn', function() {
                var row = table.row($(this).closest('tr'));
                var sku = row.data().sku;
                
                swal({
                    title: "Are you sure?",
                    text: "This product will deleted permently",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '../e_php/product_delete.php',
                            type: 'POST',
                            data: {
                                sku: sku
                            },
                            success: function(response) {
                                var result = JSON.parse(response);
                                if(result.status) {
                                    swal("Success!", "Product has been deleted!", "success");
                                    row.remove();
                                    $.ajax({
                                        type: 'POST',
                                        url: '../e_php/product_list.php', 
                                        dataType: 'json',
                                        cache: false,
                                        success: function(result) {
                                            $('#example').DataTable().clear().rows.add(result.data).draw();
                                        }
                                    });
                                } else {
                                    swal("Error!", "Failed to delete product", "error");
                                }
                            },
                            error: function() {
                                swal("Error!", "Failed to delete product", "error");
                            }
                        });
                    }
                });
            });
        }
    });
});

