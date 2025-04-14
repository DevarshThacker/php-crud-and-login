<?php
include 'nav.php';
include "../e_php/usprofile.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="icon" href="mumdblogo.png">
    <script src="../e_js/profile.js"></script>
    <style> 
    </style>
</head>

<body>
    <?php  // Include the navigation bar ?>

    <div class="container mt-5">
        <h2>User Profile</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profile Information</h5>
                <p class="card-text"><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal1" id="prof_update">
                Edit Profile</button>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" name="myform" method="post" enctype="multipart/form-data" id="form_profile">
                        <label for="username">USER:</label>
                        <input type="text" id="username" name="username"><br>

                        <label for="email">EMAIL:</label>
                        <input type="emali" id="email" name="email" disabled><br>

                        <label for="password">PASSWORD:</label>
                        <input type="password" id="password" name="password"><br>

                        <input type="submit" class="btn btn-success" value="update" id="editProfileForm" >
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancel_btn">Cancel</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>