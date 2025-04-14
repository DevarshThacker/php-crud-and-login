$(document).ready(function() {
    // Fetch user data when the modal is opened
    $('#myModal1').on('show.bs.modal', function() {
        $.ajax({
            type: 'GET',
            url: '../e_php/profile_get.php', 
            success: function(data) {
                const userData = JSON.parse(data);
                $('#username').val(userData.username); 
                $('#email').val(userData.email);
                $('#password').val(userData.password); 
                $('#userId').val(userData.id); 
            },
            error: function() {
                $('#response').html('<div class="alert alert-danger">An error occurred while fetching user data.</div>');
            }
        });
    });


    // Handle form submission
    $('#form_profile').on('submit', function(e) {

     
        const formData = {
          
            user: $('#username').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };

        $.ajax({
            type: 'POST',
            url: '../e_php/profile_update.php', 
            data: formData,
        
            success: function(response) {
                console.log(response);
                
               
            }
        });

    
    });
});