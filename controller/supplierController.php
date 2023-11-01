<?php
// session_start();
// require '../koneksi.php';
class crudSupplier extends koneksi
{
    public function index()
    {
        $query = "SELECT * FROM supplier";
        return $this->showData($query);
    }

    public function tambah($namaSupplier, $noTelp, $alamat)
    {
        try {
            $query = "INSERT INTO supplier (Nama_Supplier,No_Telp,Alamat,) value ('$namaSupplier','$noTelp','$alamat')";
            $result = $this->execute($query);

            if ($result == true) :
                $_SESSION['success'] = "Data berhasil ditambahkan!";
            else :
                $_SESSION['error'] = "Gagal menambahkan data.";
            endif;
            echo '<script>window.location.href="?page=dataSupplier";</script>';
            exit();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function edit($namaSupplier, $noTelp, $alamat, $id)
    {
        try {
            $query = "UPDATE supplier SET Nama_Supplier='$namaSupplier', No_Telp='$noTelp', Alamat='$alamat' WHERE id_Supplier='$id'";
            $result = $this->execute($query);

            if ($result == true) {
                $_SESSION['success'] = "Data berhasil diubah!";
            } else {
                $_SESSION['error'] = "Gagal mengubah data.";
            }
            echo '<script>window.location.href="?page=dataSupplier";</script>';
            exit();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function hapus($id)
    {
        $query = "DELETE FROM supplier WHERE Id_Supplier='$id'";
        $result = $this->execute($query);

        if ($result == true) {
            $_SESSION['success'] = "Data berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus data.";
        }
        echo '<script>window.location.href="?page=dataSupplier";</script>';
        exit();
    }
}
