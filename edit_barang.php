<?php
// Jalankan file init
require 'init.php';

// Deteksi pengaksesan halaman. JIka halaman diakses langsung maka tampilkan error
if (empty(input::get('id_barang'))) {
    die ("Maaf Halaman ini tidak dapat diakses langsung");
}

// ambil semua data barang dengan id_barang yang dikirim dengan method generate
$barang = new barang();
$barang->generate(input::get('id_barang'));

if (!empty($_POST)) {
    $pesanError = $barang->validasi($_POST);
    if (empty($pesanError)) {
        $update = $barang->update($barang->getItem('id_barang'));
        header("Location:tampil_barang.php");
    }
}

// Ambil file header
require 'header.php';

?>
<div class="container">
    <div class="row">
        <div class="col-6 py-4">
            <h1 class="h2 mr-auto"><a href="tambah_barang.php" class="text-info">Edit barang</a></h1>
            <?php
            if (!empty($pesanError)) :
            ?>
            <div id="pesanError">
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php
                        foreach ($pesanError as $pesan) {
                            echo "<li>$pesan</li>";
                        }
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <form action="" method="post">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">ID Barang</label>
                        <input type="text" class="form-control" id="" placeholder="" value="<?php 
                       echo $barang->getItem('id_barang');?>" name="id_barang" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" id="" placeholder="" value="<?php 
                   echo $barang->getItem('nama_barang');?>" name="nama_barang">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="">Harga Barang</label>
                    <div class="input-group-append">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" class="form-control" id="" placeholder=""
                            value="<?php echo $barang->getItem('harga_barang')?>" name="harga_barang">
                    </div>
                </div>
                <div class="col-3">
                    <label for="">Jumlah Barang</label>
                    <input type="text" class="form-control" id="" aria-describedby="helpId" name="jumlah_barang"
                        placeholder="" value="<?php echo $barang->getItem('jumlah_barang')?>">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary mt-3" value="Update" name="submit">
                <input type="submit" class="btn btn-secondary mt-3" value="Cancel" name="submit">
            </div>
        </form>
    </div>
</div>

<?php
require ('footer.php');
?>