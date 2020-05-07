<?php
include 'header.php';
require 'init.php';
$user = new user();
$userName = $user->generate($_SESSION['username']);
if (!empty($_POST)){
    $pesanError = $user->validasiUbahPassword($_SESSION['username']);
    if (empty($pesanError)) {
        $user->ubahPassword($_SESSION['username']);
    }
}
?>
<div class="container p-4">
    <?php
    if (!empty($pesanError)){
        echo "<div class=\"alert alert-danger\">";
        echo "<ul>";
        foreach ($pesanError as $pesan) {
         echo "<li>$pesan</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
    ?>
    <div>
        <h3 class="text-primary">User Profile</h3>
        <p>Username / email: <strong>
                <?php echo $user->getItem('username');?></strong>/<strong><?php echo $user->getItem('email');?></strong>
        </p>
        <input data-toggle="collapse" data-parent="#form" href="#form" class="btn btn-primary" type="submit"
            value="Ganti Password">
    </div>
    <div class="p-4">
        <form action="" method="post" id="form" class="collapse in <?php if (!empty($_POST)) {echo "show";}?>">
            <div class="form-group">
                <label for="pass1">Password Lama</label>
                <input class="form-control" type="text" name="pass1" id="" value="">
            </div>
            <div class="form-group">
                <label for="pass2">Password Baru</label>
                <input class="form-control" type="text" name="pass2" id="" value="">
            </div>
            <div class="form-group">
                <label for="pass3">Konfirmasi Password Baru</label>
                <input class="form-control" type="text" name="pass3" value="">
            </div>
            <input class="btn btn-danger btn-sm" type="submit" value="Update Password">
        </form>
    </div>
</div>
<?php
include 'footer.php';   