<?php
require '../koneksi.php';
require '../controller/supplierController.php';

$crud = new crudSupplier();
$result = $crud->index();

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $action = $_POST['action'];

    if ($action === 'add') {
        $namaSupplier = htmlspecialchars ($_POST['Nama_Supplier']);
        $noTelp = htmlspecialchars ($_POST['No_Telp']);
        $alamat = htmlspecialchars ($_POST['Alamat']);
        $crud->tambah($namaSupplier, $noTelp, $alamat);
    } elseif ($action === 'edit') {
        $id = $_POST['id_Supplier'];
        $namaSupplier = htmlspecialchars($_POST['Nama_Supplier']);
        $noTelp = htmlspecialchars($_POST['No_Telp']);
        $alamat = htmlspecialchars($_POST['Alamat']);
        $crud->edit($namaSupplier, $noTelp, $alamat, $id);
    } elseif ($action === 'delete') {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars($_POST['id']);
            $crud->hapus($id);
        }
    }
endif;
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Supplier</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button type="button" class="btn btn-primary btn-icon-split mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Supplier</span>
                </button>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $data['Nama_Supplier']; ?></td>
                            <td><?= $data['No_Telp']; ?></td>
                            <td><?= $data['Alamat']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-circle" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($data); ?>)'>
                                    <!--<span class="icon text-white-50"> -->
                                        <i class="fas fa-pen"></i>
                                    <!-- </span> -->
                                    <!-- <span class="text" >Edit</span> -->
                                </button>
                                <button type="button" class="btn btn-danger btn-circle" <?php echo "onclick='confirmDelete($data[id_Supplier])'" ?>>
                                    <!-- <span class="icon text-white-50"> -->
                                        <i class="fas fa-trash"></i>
                                    <!-- </span> -->
                                    <!-- <span class="text">Hapus</span> -->
                                </button>
                            </td>
                            <script>
                            </script>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TambahSupplier -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Supplier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataSupplier" method="POST">
                    <div class="mb-3">
                        <label for="">Nama Supplier</label>
                        <input type="text" name="Nama_Supplier" class="form-control" placeholder="Masukan Nama Supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="">No Telp</label>
                        <input type="text" name="No_Telp" class="form-control" placeholder="Masukan No Telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Alamat</label>
                        <input type="text" name="Alamat" class="form-control" placeholder="Masukan Alamat" required>
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

<!-- EditSupplier -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Supplier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataSupplier" method="post" id="formEdit">
                    <div class="mb-3">
                        <label for="">Nama Supplier</label>
                        <input type="text" name="Nama_Supplier" id="namaSupplierEdit" class="form-control" placeholder="Masukan Nama Supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="">No Telp</label>
                        <input type="text" name="No_Telp" id="noTelpEdit" class="form-control" placeholder="Masukan No Telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Alamat</label>
                        <input type="text" name="Alamat" id="alamatEdit" class="form-control" placeholder="Masukan Alamat" required>
                    </div>

                    <input type="hidden" name="id_Supplier" id="idEdit">
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

<form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataSupplier" id="formDelete" method="POST">
    <input type="hidden" name="id" id="idDelete">
    <input type="hidden" name="action" value="delete">
</form>

<script>
    function edit(data) {
        console.log(data);
        document.getElementById('namaSupplierEdit').value = data.Nama_Supplier
        document.getElementById('noTelpEdit').value = data.No_Telp
        document.getElementById('alamatEdit').value = data.Alamat
        document.getElementById('idEdit').value = data.id_Supplier
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
    }
</script>