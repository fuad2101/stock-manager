<?php
require 'init.php';
$user = new user();
$user->logout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Logout</title>
</head>
<body>
    <div class="py-5 container text-center">
        <img class="img-fluid w-25" src="img/illustration.png" alt="">
        <h3 class="h2 font-weight-bold text-primary my-4">Logout Berhasil</h3>
        <a class="btn btn-primary" href="login.php">Back To Login</a>
    </div>
</body>
<script>
alert("Logout Berhasil");
</script>
</html> 