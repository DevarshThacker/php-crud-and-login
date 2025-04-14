

$(document).ready(function() {
    let id = "";

    $.ajax({
        url: '../e_php/home_latest.php', 
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            console.log(response);  

            if (response && response.length > 0) {  
                var images = response[0].product_images.split(','); // Split images by comma
                console.log(images);

                // Prepend path to images and set the first image
                var imagePath = '../prodimg/';
                var firstImage = imagePath + images[0].trim();  // Take the first image and add path
                console.log(firstImage);
                // Set the first image as the src
                $('#newprod').attr('src', firstImage); 

                // Set product description
                $('#dispro').text(response[0].product_description);
            } else {
                console.log("No image data found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching data: ", error);
            alert('Could not retrieve details.');
        }
    });
});

