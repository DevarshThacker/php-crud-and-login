<?php

// include '../e_php/config.php';
// if (!isset($_SESSION['email'])){
//     header("Location: index.php");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">
        <!-- Essential CSS and JS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/editor/2.0.0/css/editor.dataTables.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://editor.datatables.net/css/editor.dataTables.css"> -->
  

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/editor/2.0.0/js/dataTables.editor.min.js"></script>
    <!-- <script src="http://editor.datatables.net/js/dataTables.editor.js"></script>
    <script src="https://editor.datatables.net/js/editor.dataTables.js"></script> -->
    
  
    <link rel="icon" href="mumdblogo.png">
    <style>
        .nav-link.active {
            color: white !important;
        }
        body {
            background-color: transparent;
        }
        .navbar {
            background-color: rgba(34, 34, 35, 0.94);
        }
      
        
    </style>
</head>

<body>
    <?php
    session_start(); // Start the session to access session variables
include '../e_php/config.php';
if (!isset($_SESSION['email'])){
    header("Location: index.php");
}
    $current_page = basename($_SERVER['PHP_SELF']);
  
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; // Get username or default to Guest
    ?>
      
    <nav class="navbar navbar-dark navbar-expand-lg">
        <a class="navbar-brand" href="index.html" id="movielogo"><img src=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
            aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor04">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'home.php' ? 'active' : ''; ?>"
                        href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'product.php' ? 'active' : ''; ?>"
                        href="product.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page == 'order.php' ? 'active' : ''; ?>"
                        href="order.php">Order</a>
                </li>
            </ul>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $username; ?> <!-- Display username -->
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="../e_php/logout.php">Logout</a></li> <!-- Logout link -->
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>