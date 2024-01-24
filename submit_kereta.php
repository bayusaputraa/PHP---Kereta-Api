<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Ambil data dari formulir
    $nama_kereta = input($_POST["nama_kereta"]);
    $jenis_kereta = input($_POST["jenis_kereta"]);
    $kapasitas_kereta = input($_POST["kapasitas_kereta"]);

    // Query untuk mendapatkan Kode_Kereta terbaru
    $queryGetMaxKode = "SELECT MAX(Kode_Kereta) AS max_kode FROM Kereta";
    $resultGetMaxKode = mysqli_query($kon, $queryGetMaxKode);
    $dataMaxKode = mysqli_fetch_assoc($resultGetMaxKode);
    $nextKode = $dataMaxKode['max_kode'] + 1;

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO Kereta (Kode_Kereta, Nama_Kereta, Jenis_Kereta, Kapasitas_Kereta) 
            VALUES ('$nextKode', '$nama_kereta', '$jenis_kereta', '$kapasitas_kereta')";

    // Mengeksekusi query
    $hasil = mysqli_query($kon, $sql);

    // Mengembalikan respons ke JavaScript
    if ($hasil) {
        $response['status'] = 'success';
        $response['message'] = 'Data berhasil disimpan.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Terjadi kesalahan saat menyimpan data.';
    }

    echo json_encode($response);
} else {
    // Jika bukan metode POST, kirim respon error
    $response['status'] = 'error';
    $response['message'] = 'Metode HTTP tidak valid.';
    echo json_encode($response);
}
?>
