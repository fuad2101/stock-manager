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
    // print_r($_POST);
        $barang->delete(input::get('id_barang'));
        header("Location: tampil_barang.php");
}

// Ambil file header
require 'header.php';

?>
<div class="container">
    <div class="container">
        <form action="" method="post">
        
        <!-- Modal -->
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin menghapus <strong><?php echo $barang->getItem('nama_barang'); ?> <strong></p> 
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="btn btn-danger" name="id_barang" value="<?php echo $barang->getItem('id_barang')?>
                        ">
                        <a href="tampil_barang.php" class="btn btn-secondary">Tidak</a>
                        <input type="submit" class="btn btn-danger" value="Hapus">
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
