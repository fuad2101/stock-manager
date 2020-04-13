<?php
require 'init.php';
require 'header.php';

if (!empty($_POST)) {
    $barang = new barang();
    $pesanError = $barang->validasi($_POST);
    if (empty($pesanError)) {
        $barang->insert();
        header('Location:tampil_barang.php');
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-6 py-4">
            <h1 class="h2 mr-auto"><a href="tambah_barang.php" class="text-info">Tambah barang</a></h1>
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
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" id="" placeholder="" value="<?php 
                    // $barang->getItem('nama_barang');?>" name="nama_barang">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="">Harga Barang</label>
                    <div class="input-group-append">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" class="form-control" id="" placeholder=""
                            value="<?php //$barang->getItem('harga_barang')?>" name="harga_barang">
                    </div>
                </div>
                <div class="col-3">
                    <label for="">Jumlah Barang</label>
                    <input type="text" class="form-control" id="" aria-describedby="helpId" name="jumlah_barang"
                        placeholder="" value="<?php //$barang->getItem('jumlah_barang')?>">
                </div>
                <div class="col-8">
                    <input type="submit" class="btn btn-primary mt-3" value="Input" name="submit">
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require('footer.php');
?>