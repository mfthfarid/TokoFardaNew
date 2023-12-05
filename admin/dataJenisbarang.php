<?php
require '../koneksi.php';
require '../controller/jenisbarangController.php';

$crud = new crudJenisBarang();
$result = $crud->index();

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $action = $_POST['action'];

    if ($action === 'add') {
        $jenisbarang = htmlspecialchars ($_POST['Jenis_Barang']);
        $crud->tambah($jenisbarang);
    } elseif ($action === 'edit') {
        $id = $_POST['id_JenisBarang'];
        $jenisbarang = htmlspecialchars ($_POST['Jenis_Barang']);
        $crud->edit($jenisbarang, $id);
    } elseif ($action === 'delete') {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars($_POST['id']);
            $crud->hapus($id);
        }
    }
endif;
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Data Jenis Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <button type="button" class="btn btn-primary btn-icon-split mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Jenis Barang</span>
                </button>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Jenis Barang</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php foreach ($result as $key => $data) : ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $data['Jenis_Barang']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-circle" data-bs-toggle="modal" data-bs-target="#editModal" onclick='edit(<?= json_encode($data); ?>)'>
                                        <i class="fas fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-circle" <?php echo "onclick='confirmDelete($data[id_JenisBarang])'" ?>>
                                    <!-- <span class="icon text-white-50"> -->
                                        <i class="fas fa-trash"></i>
                                    <!-- </span> -->
                                    <!-- <span class="text">Hapus</span> -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambah Jenis Barang -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jenis Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataJenisbarang" method="POST">
                    <div class="mb-3">
                        <label for="">Jenis Barang</label>
                        <input type="text" name="Jenis_Barang" class="form-control" placeholder="Masukan Jenis Barang" required>
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

<!-- EditJenisBarang -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jenis Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataJenisbarang" method="post" id="formEdit">
                    <div class="mb-3">
                    <div class="mb-3">
                        <label for="">Jenis Barang</label>
                        <input type="text" name="Jenis_Barang" id="jenisbarangEdit" class="form-control" placeholder="Masukan Jenis Barang" required>
                    </div>

                    <input type="hidden" name="id_JenisBarang" id="idEdit">
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

<form action="<?= $_SERVER['PHP_SELF']; ?>?page=dataJenisbarang" id="formDelete" method="POST">
    <input type="hidden" name="id" id="idDelete">
    <input type="hidden" name="action" value="delete">
</form>

<script>
    function edit(data) {  
        console.log(data);
        document.getElementById('jenisbarangEdit').value = data.Jenis_Barang
        document.getElementById('idEdit').value = data.id_JenisBarang
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