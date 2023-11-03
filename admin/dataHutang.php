<?php
    require '../koneksi.php';
    require '../controller/barangController.php';

    $crud = new crudBarang();
    $result = $crud->index();
    $hutang = $crud->hutang();
    $detail_transaksi_jual = $crud->detail_transaksi_jual();
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Modal</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button type="button" class="btn btn-primary btn-icon-split mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Hutang</span>
                </button>
                <thead>
                    <tr>
                        <th>ID Hutang</th>
                        <th>Nama Pelanggan</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Jumlah Hutang</th>
                        <th>Kode Transaksi Jual</th>
			            <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                     <th>ID Hutang</th>
                        <th>Nama Pelanggan</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Jumlah Hutang</th>
                        <th>Kode Transaksi Jual</th>
			            <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $data['Nama_Pelanggan']; ?></td>
                            <td><?= $data['No_Telp']; ?></td>
                            <td><?= $data['Alamat']; ?></td>
                            <td><?= $data['Jumlah_Hutang']; ?></td>
                            <td><?= $data['Kode_TransaksiJual']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-icon-split" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($data); ?>)'>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pen"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </button>
                                <button type="button" class="btn btn-danger btn-icon-split" onclick="confirmDelete(<?= $data['id_Hutang']; ?>)">
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
                <button type="button" class="btn-close" data-bs-dismiss="hutang" aria-label="Close"></button>
            </div>
            <div class="hutang-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataPelanggan" method="POST">
                    <div class="mb-3">
                        <label for="">ID Hutang</label>
                        <input type="text" name="id_Hutang" class="form-control" placeholder="Masukan Kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Nama Pelanggan</label>
                        <input type="text" name="Nama_Pelanggan" class="form-control" placeholder="Masukan Nama Pelanggan" required>
                    </div>
                    <div class="mb-3">
                        <label for="">No Telp</label>
                        <input type="number" name="No_Telp" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Alamat</label>
                        <input type="text" name="Alamat" class="form-control" placeholder="Masukan Jumlah Hutang" required>
                    </div>
                    <div class="mb-3">
                        <label for="">jumlah Hutang</label>
                        <input type="number" name="Jumlah_Hutang" class="form-control" placeholder="Masukan Kode Transaksi Jual" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Kode Transaksi Jual</label>
                        <input type="number" name="Kode_TransaksiJual" class="form-control" placeholder="Masukan Jumlah Stok" required>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Hutang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Nama Pelanggan</label>
                        <input type="text" name="Nama_Pelanggan" id="namaPelanggan" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="">Jumlah Hutang</label>
                        <select name="Jumlah_Hutang" class="form-select" id="jenisBarang" disabled>
                            <option selected disabled>Pilih Jenis Barang</option>
                            <?php foreach ($jenisBarang as $key => $value) {
                            ?>
                                <option value="<?= $value['id_JumlahHutang']; ?>"><?= $value['Jumlah_Hutang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
