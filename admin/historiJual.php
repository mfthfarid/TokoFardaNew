<?php
require '../koneksi.php';
require '../controller/historiController.php';

$histori = new histori();
$result = $histori->showTransaksiJual();

?>

<!-- Datales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Histori Transaksi Jual</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>User</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $data['Kode_TransaksiJual'] ?></td>
                            <td><?= $data['Status_Pembayaran']; ?></td>
                            <td><?= $data['Tanggal']; ?></td>
                            <td>Rp. <?= number_format($data['Total']); ?></td>
                            <td>Rp. <?= number_format($data['Bayar']); ?></td>
                            <!-- <td><?= $data['Nama_User']; ?></td> -->
                            <td>
                                <button type="button" class="btn btn-info btn-circle" data-bs-toggle="modal" data-bs-target="#detailModal" onclick='detail(<?= json_encode($data); ?>)'>
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DetailModal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Nama Barang</label>
                        <input type="text" name="Kode_Barang" id="namaBarang" class="form-control" readonly required>
                        <?php foreach ($supplier as $key => $value) { ?>
                            <option value="<?= $value['Kode_Barang']; ?>"><?= $value['Nama_Barang']; ?></option>
                        </input>
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="">Jumlah Barang</label>
                        <input type="text" name="Harga_Jual" id="hargaJual" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="">Subtotal</label>
                        <select name="id_Supplier" class="form-select" id="namaSupplier" disabled>
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