<?php
class editHutang extends koneksi {
    public function index() {
        $query = "SELECT * FROM hutang";
        return $this->showData($query);
    }
    public static function editHutang($id_hutang, $koneksi) {
        // Query untuk mengambil data hutang berdasarkan ID
        $query = "SELECT * FROM hutang WHERE id_hutang = $id_hutang";
        $result = $koneksi->query($query);

        if ($result) {
            // Memeriksa apakah data hutang ditemukan
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Memeriksa apakah hutang belum lunas
                if ($row['status'] == 'Belum Lunas') {
                    // Melakukan pembayaran
                    $queryUpdate = "UPDATE hutang SET status = 'Lunas' WHERE id_hutang = $id_hutang";
                    $resultUpdate = $koneksi->query($queryUpdate);

                    if ($resultUpdate) {
                        // Pembayaran berhasil, data dihapus
                        $queryDelete = "DELETE FROM hutang WHERE id_hutang = $id_hutang";
                        $resultDelete = $koneksi->query($queryDelete);

                        if ($resultDelete) {
                            return "Pembayaran berhasil, data hutang dihapus.";
                        } else {
                            return "Pembayaran berhasil, tetapi gagal menghapus data hutang.";
                        }
                    } else {
                        return "Gagal melakukan pembayaran hutang.";
                    }
                } else {
                    return "Hutang sudah lunas.";
                }
            } else {
                return "Data hutang tidak ditemukan.";
            }
        } else {
            return "Error: " . $koneksi->error;
     }
  }
}
?>