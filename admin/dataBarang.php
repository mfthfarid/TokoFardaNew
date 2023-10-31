<!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->
<?php
    require '../koneksi.php';
    require '../controller/barangController.php';

    $crud = new crudBarang();
    $result = $crud->index();
    $jenisBarang = $crud->jenisBarang();
    $supplier = $crud->supplier();
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
                            <td><?= $data['Harga_Jual']; ?></td>
                            <td><?= $data['Stok']; ?></td>
                            <td>
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
                                <button type="button" class="btn btn-info btn-icon-split" data-bs-toggle="modal" data-bs-target="#detailModal" onclick='detail(<?= json_encode($data); ?>)'>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="text">Detail</span>
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
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Harga Beli</label>
                        <input type="text" name="Harga_Beli" id="hargaBeli" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="">Jenis Barang</label>
                        <select name="Jenis_Barang" class="form-select" id="jenisBarang" disabled>
                            <option selected disabled>Pilih Jenis Barang</option>
                            <?php foreach ($jenisBarang as $key => $value) {
                            ?>
                                <option value="<?= $value['id_JenisBarang']; ?>"><?= $value['Jenis_Barang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Supplier</label>
                        <select name="Nama_Supplier" class="form-select" id="namaSupplier" disabled>
                            <option selected disabled>Pilih Supplier</option>
                            <?php foreach ($supplier as $key => $value) {
                            ?>
                                <option value="<?= $value['id_Supplier']; ?>"><?= $value['Nama_Supplier']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function edit(data) {
        // console.log(data);
        document.getElementById('usernameEdit').value = data.Username
        document.getElementById('nameEdit').value = data.Nama_User
        document.getElementById('emailEdit').value = data.Email
        document.getElementById('levelEdit').value = data.Level
        document.getElementById('idEdit').value = data.Id_User
    };

    function detail(data) {
        // console.log(data);
        document.getElementById('hargaBeli').value = data.Harga_Beli
        document.getElementById('jenisBarang').value = data.id_jenisBarang
        document.getElementById('namaSupplier').value = data.id_Supplier
        document.getElementById('jenisBarang').value = data.id_JenisBarang
    };

    function confirmDelete(userId) {
        console.log(userId);
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Anda yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('idDelete').value = userId;
                document.getElementById('formDelete').submit();
            }
        });
    };
</script>