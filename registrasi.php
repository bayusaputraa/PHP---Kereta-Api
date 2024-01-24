<?php
/**
 * Nama File: registrasi.php
 * Deskripsi: Ini adalah halaman untuk menambahkan atau mendaftarkan user. 
 * Author: Bayu Saputra & Amrizal Mustakim
 * Dibuat pada: 19/12/23
 */

// Include file db.php
include('db.php');

// Fungsi untuk mengamankan input pengguna
function sanitize_input($data, $kon)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($kon, $data);
}

// Inisialisasi variabel
$username = $password = "";
$username_err = $password_err = $err = "";

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validasi input username
    if (empty($_POST["username"])) {
        $username_err = "Username diperlukan";
    } else {
        $username = sanitize_input($_POST["username"], $kon);
    }

    // Validasi input password
    if (empty($_POST["password"])) {
        $password_err = "Password diperlukan";
    } else {
        $password = sanitize_input($_POST["password"], $kon);
    }

    // Jika tidak ada kesalahan, masukkan data ke database
    if (empty($username_err) && empty($password_err)) {

        // Query untuk memasukkan data ke database
        $sql = "INSERT INTO user (Nama_User, Password, Role) VALUES (?, ?, 'karyawan')";
        $stmt = mysqli_prepare($kon, $sql);

        if ($stmt) {
            // Hash password menggunakan MD5 
            $password_md5 = md5($password);

            // Bind parameter ke statement
            mysqli_stmt_bind_param($stmt, "ss", $username, $password_md5);

            // Eksekusi query
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php"); // Redirect ke halaman login setelah registrasi berhasil
                exit();
            } else {
                $err = "Error: " . $sql . "<br>" . mysqli_error($kon);
            }

            // Tutup statement
            mysqli_stmt_close($stmt);
        }
    }
}

// Tutup koneksi database
mysqli_close($kon);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="style_login.css">
</head>

<body>
    <div class="container my-4">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Registrasi Untuk Masuk Ke Sistem</div>
                </div>
                <div style="padding-top:30px" class="panel-body">
                    <?php if ($err) { ?>
                        <div id="login-alert" class="alert alert-danger col-sm-12">
                            <ul><?php echo $err ?></ul>
                        </div>
                    <?php } ?>
                    <form id="loginform" class="form-horizontal" action="" method="post" role="form">
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="username">
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <div class="col-sm-12 controls">
                                <input type="submit" name="register" class="btn btn-success" value="Register" />
                                <button type="button" name="login" class="btn btn-primary" onclick="location.href='login.php'">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
