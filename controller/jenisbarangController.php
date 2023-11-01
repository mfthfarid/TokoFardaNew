<?php 
    class crudJenisBarang extends koneksi {
        public function index() {
            $query = "SELECT * FROM jenis_barang";
            return $this->showData($query);
        }

        public function tambah($jenisbarang)
    {
        try {
            $query = "INSERT INTO jenis_barang (Jenis_Barang) value ('$jenisbarang')";
            $result = $this->execute($query);

            if ($result == true) :
                $_SESSION['success'] = "Data berhasil ditambahkan!";
            else :
                $_SESSION['error'] = "Gagal menambahkan data.";
            endif;
            echo '<script>window.location.href="?page=dataJenisbarang";</script>';
            exit();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function edit($jenisbarang)
    {
        try {
            $query = "UPDATE jenis_barang SET Jenis_Barang='$jenisbarang', WHERE id_JenisBarang='$id'";
            $result = $this->execute($query);

            if ($result == true) {
                $_SESSION['success'] = "Data berhasil diubah!";
            } else {
                $_SESSION['error'] = "Gagal mengubah data.";
            }
            echo '<script>window.location.href="?page=dataJenisbarang";</script>';
            exit();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function hapus($id)
    {
        $query = "DELETE FROM jenis_barang WHERE id_JenisBarang='$id'";
        $result = $this->execute($query);

        if ($result == true) {
            $_SESSION['success'] = "Data berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus data.";
        }
        echo '<script>window.location.href="?page=dataJenisbarang";</script>';
        exit();
    }
}
?>
