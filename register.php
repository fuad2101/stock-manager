<?php
require 'init.php';

$user = new user();

if (!empty($_POST)) {
    $pesanError = $user->validasiInsert($_POST);
    var_dump($pesanError);
    if (empty($pesanError)) {
        echo '<br>Insert Berhasil';
        // $user->insert();
        // header("Location:register_berhasil.php");
    }else {
        echo "Insert Gagal";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Register</title>
</head>

<body>
    <div class="container pt-4">
        <h1 class="h2 text-primary ">Register User</h1>
        <?php
        if (isset($pesanError)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">";
            echo "<ul>";
            foreach($pesanError as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>
        <div class="row">
            <div class="col-6">
                <form class="form-control-sm" action="" method="post">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php 
                        echo $user->getItem('username');?>">
                        <small class="form-text text-muted">(Minimal 4 karakter angka atau huruf)</small>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" value="<?php echo $user->getItem('password');?>">
                        <small id="helpId" class="form-text text-muted">Minimal 6 karakter kombinasi angka dan
                            huruf</small>
                    </div>
                    <div class="form-group">
                        <label for="">Ulangi Password</label>
                        <input type="password" class="form-control" name="repeat_pass" value="<?php echo $user->getItem('repeat_pass');?>">
                        <small id="helpId" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $user->getItem('email');?>">
                        <small id="helpId" class="form-text text-muted"></small>
                    </div>
                    <input class="btn btn-danger" type="submit" value="Sign Up">
                    <a href="login.php" class="btn btn secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>