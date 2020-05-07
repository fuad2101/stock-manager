<?php
require ('init.php');
$login = new user();
$pesanError = [];
// var_dump($pesanError);
if (!empty($_POST)) {
    $pesanError = $login->validasiLogin($_POST);
    if (empty($pesanError)) {
        $login->login();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Login</title>
</head>

<body>
    <div class="container p-4">
        <div class="card w-50 mx-auto">
            <div class="card-body">
                <h4 class="card-title text-center">Account</h4>
                <?php
                if (!empty($pesanError)) {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">";
                    echo "<ul>";
                    foreach($pesanError as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                }
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control"
                            value="<?php echo $login->getItem('username') ;?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" value="">
                    </div>
                    <div class="form-group text-center">
                        <input class="btn btn-primary col-5 btn-sm my-4" type="submit" value="Login">
                        <p class="small">Belum punya akun ? Silahkan <a href="register_user.php">register</a> terlebih
                            dahulu</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>