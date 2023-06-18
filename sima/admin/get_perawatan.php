<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT tb_aset.kode_barang, tb_aset.nama_barang, tb_perawatan.tanggal, tb_perawatan.uraian_kegiatan, tb_perawatan.nama_gambar, tb_user.nama_lengkap 
FROM tb_perawatan
JOIN tb_aset ON tb_perawatan.kode_barang = tb_aset.kode_barang 
JOIN tb_user ON tb_perawatan.id_user = tb_user.id_user;";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $perawatan = $row;
        array_push($data, $perawatan);
    }
    $response = $data;
    echo json_encode($response);
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Gagal mengambil data!'
    ));
}