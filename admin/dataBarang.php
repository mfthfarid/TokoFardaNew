<!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->
<?php
    require '../koneksi.php';
    require '../controller/barangController.php';

    $crud = new crudBarang();
    $result = $crud->index();

    
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button type="button" class="btn btn-primary btn-icon-split mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Barang</span>
                </button>
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Expired</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Expired</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $data['Kode_Barang']; ?></td>
                            <td><?= $data['Nama_Barang']; ?></td>
                            <td><?= $data['Tgl_Expired']; ?></td>
                            <td><?= $data['Harga_Beli']; ?></td>
                            <td><?= $data['Harga_Jual']; ?></td>
                            <td><?= $data['Stok']; ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-icon-split" data-bs-toggle="modal" data-bs-target="#detailModal" onclick='detail(<?= json_encode($data); ?>)'>
                                    <span class="text">Detail</span>
                                </button>
                                <button type="button" class="btn btn-warning btn-icon-split" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($data); ?>)'>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pen"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </button>
                                <button type="button" class="btn btn-danger btn-icon-split" onclick="confirmDelete(<?= $data['Kode_Barang']; ?>)">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Hapus</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TambahModal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataBarang" method="POST">
                    <div class="mb-3">
                        <label for="">Kode Barang</label>
                        <input type="text" name="Kode_Barang" class="form-control" placeholder="Masukan Kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Nama Barang</label>
                        <input type="text" name="Nama_Barang" class="form-control" placeholder="Masukan Nama Barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Tanggal Expired</label>
                        <input type="date" name="Tgl_Expired" class="form-control" placeholder="Masukan Tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Harga Beli</label>
                        <input type="integer" name="Harga_Beli" class="form-control" placeholder="Masukan Harga Beli" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Harga Jual</label>
                        <input type="text" name="Harga_Jual" class="form-control" placeholder="Masukan Harga Jual" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Stok</label>
                        <input type="text" name="Stok" class="form-control" placeholder="Masukan Jumlah Stok" required>
                    </div>

                    <input type="hidden" name="action" value="add">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DetailModal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataUser" method="post" id="formEdit">
                    <div class="mb-3">
                        <label for="">Jenis Barang</label>
                        <input name="JenisBarang" id="jenisbarangDetail" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="">Supplier</label>
                        <input type="text" name="id_Supplier" id="id_supplierDetail" class="form-control" readonly>
                    </div>

                    <input type="hidden" name="Id_User" id="idEdit">
                    <input type="hidden" name="action" value="edit">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function detail(data) {
        console.log(data);
        // document.getElementById('jenisbarangDetail').value = data.JenisBarang
        // document.getElementById('id_supplierDetail').value = data.id_Supplier
        <?php  
        $id_barang = $_POST['id_barang']; // Gantilah sesuai dengan cara Anda mendapatkan ID barang

        $sql = "SELECT barang.id_barang, barang.nama_barang, jenis_barang.nama_jenis FROM barangINNER JOIN jenis_barang ON barang.id_jenis_barang = jenis_barang.id_jenis_barang WHERE barang.id_barang = $id_barang";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            // Ambil hasil query
            $row = $result->fetch_assoc();

            $nama_barang = $row['nama_barang'];
            $nama_jenis = $row['nama_jenis'];

            // Gunakan $nama_barang dan $nama_jenis sesuai kebutuhan Anda
            // Misalnya, mengisi elemen-elemen HTML dengan data tersebut
        } else {
            echo "Barang tidak ditemukan.";
        }
        ?>
    };
</script>