<?php
class hutang extends koneksi {
    public function index() {
        $query = "SELECT * FROM hutang";
        return $this->showData($query);
    }
    public function transaksiJual() {
        $query = "SELECT * FROM transaksi_jual";
        return $this->showData($query);
    }
    public function editData($idHutang, $noTelp, $alamat) {
        $query = "UPDATE hutang SET No_Telp='$noTelp', Alamat='$alamat' WHERE id_Hutang='$idHutang'";
        $result = $this->execute($query);

        if ($result) {
            $_SESSION['success'] = "Data pelanggan berhasil diperbarui!";
        } else {
            $_SESSION['error'] = "Gagal memperbarui data pelanggan!";
        }
        echo '<script>window.location.href="?page=dataHutang";</script>';
        exit();
    }

    public function editBayar($sisa, $idHutang) {
        try {
            $query = "UPDATE hutang SET Jumlah_Hutang='$sisa' WHERE id_Hutang = '$idHutang'";
            $result = $this->execute($query);

            if ($result == true) {
                $_SESSION['success'] = "Berhasil membayar hutang!";
            } else {
                $_SESSION['error'] = "Gagal membayar hutang!";
            }
            echo '<script>window.location.href="?page=dataHutang";</script>';
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function hapus($status, $kodeTransaksi, $idHutang) {
        try {
            $query = "UPDATE transaksi_jual SET Status_Pembayaran = '$status' WHERE Kode_TransaksiJual = '$kodeTransaksi'";
            $result = $this->execute($query);

            $query1 = "DELETE FROM hutang WHERE id_Hutang = '$idHutang'";
            $result1 = $this->execute($query1);

            if ($result == true && $result1 == true) {
                $_SESSION['success'] = "Data berhasil disimpan!";
            } else {
                $_SESSION['error'] = "Gagal menyimpan data.";
            }
            echo '<script>window.location.href="?page=dataHutang";</script>';
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // function updateDataInDatabase($idHutang, $sisaHutang) {
    //     $sisaHutang = $_POST['$sisaHutang'];
    
    //     $idHutang = $_POST['idEdit'];
    //     $query = "UPDATE hutang SET Jumlah_Hutang = '$sisaHutang' WHERE id_Hutang = '$idHutang'";
    //     $result = $this->execute($query);

    //     if ($result == true) {
    //         $_SESSION['success'] = "Data pelanggan berhasil diperbarui!!";
    //     } else {
    //         $_SESSION['error'] = "Gagal memperbarui data pelanggan.";
    //     }
    // }
}
?>