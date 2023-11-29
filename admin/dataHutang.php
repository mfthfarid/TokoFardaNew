<?php
    require '../koneksi.php';
    require '../controller/hutangController.php';

    $crud = new editHutang();
    $result = $crud->index();
   
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Hutang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                
                   
                   
                </button>
                <thead>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>ID Hutang</th>
                        <th>Alamat</th>
                        <th>Jumlah Hutang</th>
                        <th>Kode Transaksi Jual</th>
			<th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                     <th>Nama Pelanggan</th>
                        <th>ID Hutang</th>
                        <th>Alamat</th>
                        <th>Jumlah hutang</th>
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
                                <button type="button" class="btn btn-warning btn-icon-split" data-bs-toggle="modal" data-bs-target="#editModal" onclick='editHutang(<?= json_encode($data); ?>)'>
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
                        <label for="">Jumlah Hutang</label>
                        <input type="text" name="Jumlah_Hutang" id="jumlahHutang" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="">Jenis Barang</label>
                        <select name="Jenis_Barang" class="form-select" id="jenisBarang" disabled>
                            <option selected disabled>Pilih Jenis Barang</option>
                            <?php foreach ($jenisBarang as $key => $value) {
                            ?>
                                <option value="<?= $value['id_Jenis_Barang']; ?>"><?= $value['Ju']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Supplier</label>
                        <select name="Supplier" class="form-select" id="namaSupplier" disabled>
                            <option selected disabled>Pilih Supplier</option>
                            <?php foreach ($supplier as $key => $value) {
                            ?>
                                <option value="<?= $value['id_Supplier']; ?>"><?= $value['Kode_TransaksiJual']; ?></option>
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
