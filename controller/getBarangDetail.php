<?php 
    $koneksi = new mysqli("localhost", "root", "", "toko_farda_new");

    if (isset($_POST["id_barang"])) {
        $id_barang = $_POST["id_barang"];
    
        $sql = "SELECT barang.id_barang, barang.nama_barang, jenis_barang.nama_jenis, barang.id_Supplier
                FROM barang
                INNER JOIN jenis_barang ON barang.id_jenis_barang = jenis_barang.id_jenis_barang
                WHERE barang.id_barang = $id_barang";
    
        $result = $koneksi->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $data = [
                "nama_jenis" => $row["nama_jenis"],
                "id_Supplier" => $row["id_Supplier"]
            ];
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "Barang tidak ditemukan"]);
        }
    }
?>