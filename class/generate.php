    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/all.css">
        <title>Ilkoom</title>
    </head>

    <body>
        <div class="container p-5 text-center">
            <p class="h4">Sedang Memproses Pembuatan Tabel</p>
            <div class="alert alert-success">
              <p>
              <?php
                mysqli_report(MYSQLI_REPORT_STRICT);
                try {
                    $message = [];
                    $mysqli = new mysqli('localhost','root','');
                    $query = "CREATE DATABASE IF NOT EXISTS ilkoom";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysqli->error,$mysqli->errno);
                    }else {
                        echo "<p><i class=\"fa fa-check-circle text-success\" style=\"margin-right:5px;\"></i>Pembuatan Database Berhasil</p>";
                    }
                    $mysqli->select_db("ilkoom");
                    if ($mysqli->error) {
                        throw new Exception($mysqli->error,$mysqli->errno);
                    }
                    $query = "DROP TABLE IF EXISTS barang";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysqli->error,$mysqli->errno);
                    }
                    $query = "CREATE TABLE barang(
                        id_barang INT PRIMARY KEY AUTO_INCREMENT,
                        nama_barang VARCHAR(55),
                        jumlah_barang INT, 
                        harga_barang DEC,
                        tanggal_update TIMESTAMP
                        )";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysqli->error,$mysqli->errno);
                    }else {
                        echo "<p><i class=\"fa fa-check-circle text-success\" style=\"margin-right:5px;\"></i>Pembuatan Tabel Barang Berhasil</p>";
                    }
                    $query = "DROP TABLE IF EXISTS user";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysqli->error,$mysqli->errno);
                    }
                    $query = "CREATE TABLE user(
                        username VARCHAR(255) PRIMARY KEY,
                        password VARCHAR(255),
                        email VARCHAR(100))";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysqli->error,$mysqli->errno);
                    }else {
                        echo "<p><i class=\"fa fa-check-circle text-success\" style=\"margin-right:5px;\"></i>Pembuatan Tabel User Berhasil</p>";
                    }
                } catch (Exception $e) {
                    Echo "Koneksi/Query bermasalah: ".$e->getMessage().$e->getCode();
                }finally{
                    if (isset($mysqli)) {
                        $mysqli->close();
                    }
                }
                ?>
              </p>
              <p class="mb-0"></p>
            </div>
                
            <p>Sudah punya akun? Silahkan <a href="../login.php">Login</a> atau <a href="../register_user.php">Daftar user baru</a></p>
        </div>
    </body>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/all.js"></script>

    </html>