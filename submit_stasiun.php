<?php
include "db.php";

function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_stasiun = input($_POST["nama_stasiun"]);
    $lokasi = input($_POST["Lokasi"]);

    $queryGetMaxKode = "SELECT MAX(Kode_Stasiun) AS max_kode FROM Stasiun";
    $resultGetMaxKode = mysqli_query($kon, $queryGetMaxKode);
    $dataMaxKode = mysqli_fetch_assoc($resultGetMaxKode);
    $nextKode = $dataMaxKode['max_kode'] + 1;

    $sql = "INSERT INTO Stasiun (Kode_Stasiun, Nama_Stasiun, Lokasi) VALUES ('$nextKode', '$nama_stasiun', '$lokasi')";

    $hasil = mysqli_query($kon, $sql);

    if ($hasil) {
        $response['status'] = 'success';
        $response['message'] = 'Data Berhasil Disimpan';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Data Gagal Disimpan';
    }
}

// Set header content type sebagai JSON
header('Content-Type: application/json');

// Mengembalikan respons dalam format JSON
echo json_encode($response);
exit();
?>
