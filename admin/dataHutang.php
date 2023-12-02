<?php
    require '../koneksi.php';
    require '../controller/hutangController.php';

    $crud = new hutang();
    $result = $crud->index();
    $transaksiJual = $crud->transaksiJual();

    if ($['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];
        if($act_SERVERion === 'edit') {
            $idHutang = $_POST['id_Hutang'];
            $namaPelanggan = htmlspecialchars($_POST['Nama_Pelanggan']);
            $noTelp = htmlspecialchars($_POST['No_Telp']);
            $alamat = htmlspecialchars($_POST['Alamat']);
            // $jumlahHutang = htmlspecialchars($_POST['Jumlah_Hutang']);
            // $jumlahHutang1 = str_replace(',','', $jumlahHutang);
            // $sisa = $_POST['Sisa1'];
            $crud->editData($idHutang, $noTelp, $alamat);
        // } elseif($action === 'delete') {
        //     if (isset($_POST['id_Hutang'])) {
        //         $idHutang = htmlspecialchars($_POST['id_Hutang']);
        //         $crud->hapus($idHutang, $status, $kodeTransaksi);
        //     }
        }

        $status = $_POST['Status'];
        if ($status == 'Lunas') {
            $kodeTransaksi = $_POST['Kode_TransaksiJual'];
            $status = $_POST['Status'];
            $idHutang = $_POST['id_Hutang'];
            $crud->hapus($status, $kodeTransaksi, $idHutang);
        } elseif ($status == 'Hutang') {
            $sisa = $_POST['Sisa1'];
            $idHutang = $_POST['id_Hutang'];
            // var_dump($sisa);
            $crud->editBayar($sisa, $idHutang);
        }
    }
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Hutang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Jumlah Hutang</th>
                        <th>Kode Transaksi Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>ID Hutang</th>
                        <th>Nama Pelanggan</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Jumlah Hutang</th>
                        <th>Kode Transaksi Jual</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $data['Nama_Pelanggan']; ?></td>
                            <td><?= $data['No_Telp']; ?></td>
                            <td><?= $data['Alamat']; ?></td>
                            <td><?= $data['Kode_TransaksiJual']; ?></td>
                            <td>Rp. <?= number_format($data['Jumlah_Hutang']); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-icon-split" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($data); ?>)'>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pen"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                <!-- </button>
                                <button type="button" class="btn btn-info btn-icon-split" data-bs-toggle="modal" data-bs-target="#detailModal" onclick='detail(<?= json_encode($data); ?>)'>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="text">Detail</span>
                                </button> -->
                                <button type="button" class="btn btn-success btn-icon-split" data-bs-toggle="modal" data-bs-target="#bayarModal" onclick='bayar(<?= json_encode($data); ?>)'>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-money-bill-wave fa-spin"></i>
                                    </span>
                                    <span class="text">Bayar</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- EditModal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataHutang" method="post" id="formEdit">
                    <div class="mb-3">
                        <label for="">Nama Pelanggan</label>
                        <input type="text" name="Nama_Pelanggan" id="namaEdit" class="form-control" placeholder="Masukan nama pelanggan" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="">No Telepon</label>
                        <input type="text" name="No_Telp" id="telpEdit" class="form-control" placeholder="Masukan nomor telepon" required oninput="formatAngka(this)">
                    </div>
                    <div class="mb-3">
                        <label for="">Alamat</label>
                        <textarea cols="30" rows="8" type="text" name="Alamat" id="alamatEdit" class="form-control" placeholder="Masukan alamat pelanggan" required></textarea>
                    </div>
                    
                    <input type="hidden" name="id_Hutang" id="idEdit">
                    <input type="hidden" name="action" value="edit">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- BayarModal -->
<div class="modal fade" id="bayarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar Hutang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataHutang" method="POST" id="formEdit">
                    <div class="mb-3">
                        <label for="">Jumlah Hutang</label>
                        <input type="text" name="Jumlah_Hutang" id="jumlahHutang" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="">Bayar</label>
                        <input type="text" name="Bayar" id="Bayar" class="form-control" oninput="if (this.value !== '') funcBayar(); validateInput(this)" required>
                    </div>

                    <div class="mb-3">
                        <label for="">Sisa</label>
                        <input type="text" name="Sisa" id="Sisa" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="">Status</label>
                        <input type="text" name="Status" id="Status" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="">Kembalian</label>
                        <input type="text" name="Kembalian" id="Kembalian" class="form-control" readonly>
                    </div>

                    <input type="hidden" name="Jumlah_Hutang1" id="jumlahHutang1">
                    <input type="hidden" name="Sisa1" id="Sisa1">
                    <input type="hidden" name="id_Hutang" id="idHutang">
                    <input type="hidden" name="Kode_TransaksiJual" id="kodeTransaksi">

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
                                <option value="<?= $value['id_JumlahHutang']; ?>"><?= $value['Ju']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">transaksi_jual</label>
                        <select name="Kode_TransaksiJual" class="form-select" id="namaPelanggan" disabled>
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

<script>
    function edit(data) {
        document.getElementById('namaEdit').value = data.Nama_Pelanggan
        document.getElementById('telpEdit').value = data.No_Telp
        document.getElementById('alamatEdit').value = data.Alamat
        document.getElementById('idEdit').value = data.id_Hutang
    }

    function bayar(data) {
        // console.log(data);
        const jumlahHutang = document.getElementById('jumlahHutang');
        const jumlahHutang1 = document.getElementById('jumlahHutang1');
        const idHutang = document.getElementById('idHutang');
        const kodeTransaksi = document.getElementById('kodeTransaksi');

        jumlahHutang.value = formatAngkaBayar(data.Jumlah_Hutang);
        jumlahHutang1.value = data.Jumlah_Hutang;
        idHutang.value = data.id_Hutang;
        kodeTransaksi.value = data.Kode_TransaksiJual;
        // console.log(kodeTransaksi);
    }

    function formatRibu(input) {
        var value = input.value.replace(/[^0-9]/g, '');
        if (value) {
            value = parseInt(value, 10).toLocaleString('en-US');
        }
        input.value = value;
    }

    function formatAngka(input) {
        var value = input.value.replace(/[^0-9]/g, '');
        input.value = value;
    }

    function formatAngkaBayar(data) {
        var angka = parseInt(data);
        var format = angka.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        return format;
    }

    function validateInput(input) {
        // input.value = input.value.replace(/\D/g, "");
        var value = input.value.replace(/[^0-9]/g, '');

        if (value) {
            value = parseInt(value, 10).toLocaleString('en-US');
        }

        input.value = value;
    }

    // function cekJumlahBayar() {
    //     // Pemeriksaan jika jumlah bayar dan jumlah hutang sama
    //     var bayar = document.getElementById('bayarEdit').value;

    //     // Memeriksa apakah bayar tidak kosong dan bukan null/undefined
    //     if (bayar == null || bayar == "") {
    //         editHutang($idHutang, $namaPelanggan, $noTelp, $alamat);
    //         // window.location.href='?page=dataHutang';
    //     } else {
    //         var bayar = parseFloat(document.getElementById('bayarEdit').value.replace(/,/g, ''));
    //         var jumlahHutang = parseFloat(document.getElementById('jumlahHutangEdit').value.replace(/,/g, ''));
    //             if (jumlahHutang === bayar) {
    //                 // Panggil fungsi atau AJAX request untuk menghapus data
    //                 hapus($idHutang, $status, $kodeTransaksi);
    //             } else if (bayar > jumlahHutang) {
    //                 var kembalian = bayar - jumlahHutang;
    //                 alert('Pembayaran berhasil. Kembalian: ' + kembalian.toLocaleString('en-US'));
    //                 hapus($idHutang, $status, $kodeTransaksi);
    //                 // <a href="" id = "idDelete" name="action" value="delete" > </a>
    //             } else if (bayar < jumlahHutang) {
    //                 $sisaHutang = jumlahHutang - bayar;
    //                 alert('Pembayaran berhasil. Sisa hutang: ' + $sisaHutang.toLocaleString('en-US'));
    //                 // Update data di database (misalnya, menggunakan AJAX)
    //                 editHutang();
    //             } else {
    //                 alert('Jumlah bayar tidak valid.');
    //             }
    //     }
    // }

    function funcBayar() {
        const jumlahHutang = parseInt(document.getElementById('jumlahHutang1').value);
        const bayar = document.getElementById('Bayar').value;
        const uang = parseInt(bayar.replace(/,/g, ''), 10);
        const sisa = document.getElementById('Sisa');
        const sisa1 = document.getElementById('Sisa1');
        const kembalian = document.getElementById('Kembalian');
        const status = document.getElementById('Status');
        const hasil = jumlahHutang - uang;

        if (hasil > 0) {
            sisa.value = formatAngkaBayar(hasil);
            sisa1.value = hasil;
            status.value = 'Hutang';
            kembalian.value = 0;
        } else {
            sisa.value = 0;
            sisa1.value = 0;
            status.value = 'Lunas';
            kembalian.value = formatAngkaBayar(uang - jumlahHutang);
        }
    }
    
</script>