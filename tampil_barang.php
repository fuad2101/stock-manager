<?php
require 'init.php';
$DB = DB::getInstance();
if (!empty($_GET)) {
    $tabelBarang = $DB->getLike('barang','nama_barang','%'.input::get('search').'%');
}else {
    $tabelBarang = $DB->get('barang');
}
include 'header.php';
?>
<div class="container">
    <div class="row p-4">
        <div class="col-6">
            <h2 class="text-primary">Tabel Barang</h2>
        </div>
        <div class="col-6">
            <form action="" method="get">
                <div class="form-inline">
                    <a href="tambah_barang.php" class="btn btn-primary">Tambah Barang</a>
                    <input type="text" name="search" id="" class="form-control form-inline ml-3" placeholder="Search">
                    <input type="submit" value="Cari" class="btn btn-secondary">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga (Rp.)</th>
                        <th>Tanggal Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($tabelBarang as $barang) {
                        echo "<tr>";
                        echo "<td>".$barang->id_barang."</td>";
                        echo "<td>".$barang->nama_barang."</td>";
                        echo "<td>".$barang->jumlah_barang."</td>";
                        echo "<td>".number_format($barang->harga_barang,'0',',','.')."</td>";
                        $update = new DateTime($barang->tanggal_update);
                        echo "<td>".$update->format('d M Y h:i:s')."</td>";
                        echo "<td>";
                        echo "<a href=\"edit_barang.php?id_barang=$barang->id_barang\" class=\"btn btn-primary btn-sm\">Edit</a>";
                        echo "<a href=\"hapus_barang.php?id_barang=$barang->id_barang\" class=\"btn btn-danger btn-sm ml-1 text-white\">Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php

?>


<?php
include'footer.php';
?>