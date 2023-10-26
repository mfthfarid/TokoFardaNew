<?php 
    class crudBarang extends koneksi {
        public function index() {
            $query = "SELECT * FROM barang";
            return $this->showData($query);
        }
        
    }
?>