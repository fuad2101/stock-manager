<?php
mysqli_report(MYSQLI_REPORT_STRICT);
try {
    $mysqli = new mysqli("localhost","root","");
    $mysqli->select_db("ilkoom");
    if ($mysqli->error) {
        throw new Exception();
    }
    $query = "SELECT 1 from user";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception();
    }
    $query = "SELECT 1 from barang";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception();
    }
    if (isset($mysqli)) {
        $mysqli->close();
    }
   
    header('Location:login.php');

} catch (Exception $th) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Ilkoom</title>
</head>

<body>
    <div class="container p-5 text-center">
        <div class="row">
            <div class="col">
                <p>Selamat datang di aplikasi</p>
                <p class="h4 font-weight-bold">Ilkoom Stock Manager</p>
                <p class="h5">Sistem kami mendeteksi anda belum memiliki tabel/data apapun. Anda ingin membuatnya sekerang?</p>
                <div class="form group my-4">
                    <a class="btn btn-primary" href="class/generate.php">Ya, Buat Sekarang</a>
                    <a class="btn btn-secondary" href="">Tidak</a>
                </div>
            </div>
        </div>
    </div>
</body>







</html>
<?php
}
include 'footer.php';
?>