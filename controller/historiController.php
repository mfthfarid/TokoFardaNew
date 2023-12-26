<?php
class histori extends koneksi
{
    // JUAL
    public function index() {
        $query = "SELECT detail_transaksi_jual.Kode_TransaksiJual, transaksi_jual.Kode_TransaksiJual, barang.Nama_Barang, barang.Harga_Jual, detail_transaksi_jual.Jumlah_Barang, detail_transaksi_jual.Subtotal_Barang, transaksi_jual.Status_Pembayaran, transaksi_jual.Tanggal, transaksi_jual.Total, transaksi_jual.Bayar, user.Nama_User FROM detail_transaksi_jual JOIN transaksi_jual ON detail_transaksi_jual.Kode_TransaksiJual = transaksi_jual.Kode_TransaksiJual JOIN barang ON detail_transaksi_jual.Kode_Barang = barang.Kode_Barang JOIN user ON transaksi_jual.id_user = user.Id_User";
        return $this->showData($query);
    }
    public function barang() {
        $query = "SELECT * FROM barang";
        return $this->showData($query);
    }
    public function transaksiJual() {
        $query = "SELECT * FROM transaksi_jual";
        return $this->showData($query);
    }
    public function detailJual() {
        $query = "SELECT Kode_TransaksiJual, Nama_Barang FROM detail_transaksi_jual JOIN barang ON detail_transaksi_jual.Kode_Barang = barang.Kode_Barang";
        return $this->showData($query);
    }
    public function showTransaksiJual() {
        $query = "SELECT Kode_TransaksiJual, Status_Pembayaran, Tanggal, Total, Bayar, Nama_User FROM transaksi_jual JOIN user ON transaksi_jual.id_user = user.Id_User";
        return $this->showData($query);
    }

    // BELI
    public function showTransaksiBeli() {
        $query = "SELECT Kode_TransaksiBeli, Tanggal, Total, Bayar, Nama_User FROM transaksi_beli JOIN user ON transaksi_beli.id_user = user.Id_user";
        return $this->showData($query);
    }
}
