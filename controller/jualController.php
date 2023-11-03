<?php 
    class transaksiJual extends koneksi {
        public function showBarang() {
            $query = "SELECT * FROM barang where stock >= 10 AND Tgl_Expired > CURDATE()";
            return $this->execute($query);
        }    
    }
?>