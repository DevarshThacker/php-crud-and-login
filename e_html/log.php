<?php
include "nav.php"
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="script/validation.min.js"></script> -->

<script src="../e_js/log.js"></script>

<!-- <link rel="stylesheet" href="../e_css/logpage.css"> -->
    </head>
    <body>
    <form class="form-login" method="post" id="login-form">
<h2 class="form-login-heading">User Log In Form</h2><hr />
<div id="error">
</div>
<div class="form-group">
<input type="email" class="form-control" placeholder="Email address" 
name="user_email" id="user_email" />
<span id="check-e"></span>
</div>
<div class="form-group">
<input type="password" class="form-control" placeholder="Password" name="password" id="password" />
</div>
<hr />
<div class="form-group">
<button type="submit" class="btn btn-default" name="login_button" id="login_button">
<span class="glyphicon glyphicon-log-in"></span>   Sign In
</button>
</div>
</form>
        <script src="" async defer></script>
    </body>
</html>