<!-- login.php -->

<?php
/**
 * Nama File: login.php
 * Deskripsi: Ini adalah halaman untuk login.
 * Author: Bayu Saputra & Amrizal Mustakim
 * Dibuat pada: 19/12/23
 */
session_start();

// 1. Include file db.php
include('db.php');

$err        = "";
$username   = "";
$ingataku   = isset($_POST['ingataku']) ? $_POST['ingataku'] : "";

if (isset($_COOKIE['cookie_username'])) {
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    $sql1 = "SELECT * FROM user WHERE Nama_User = '$cookie_username'";
    $q1   = mysqli_query($kon, $sql1);

    // Periksa apakah ada baris yang dikembalikan
    if (mysqli_num_rows($q1) > 0) {
        $r1 = mysqli_fetch_array($q1);

        if ($r1['Password'] == $cookie_password) {
            $_SESSION['session_username'] = $cookie_username;
            $_SESSION['session_password'] = $cookie_password;
            $_SESSION['session_role'] = $r1['Role'];
        }
    }
}

if (isset($_SESSION['session_username'])) {
    header("location:index.php");
    exit();
}

if (isset($_POST['login'])) {
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $ingataku   = isset($_POST['ingataku']) ? $_POST['ingataku'] : "";

    if ($username == '' or $password == '') {
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    } else {
        $sql1 = "SELECT * FROM user WHERE Nama_User = '$username'";
        $q1   = mysqli_query($kon, $sql1);

        // Periksa apakah ada baris yang dikembalikan
        if (mysqli_num_rows($q1) > 0) {
            $r1 = mysqli_fetch_array($q1);

            if ($r1['Password'] != md5($password)) {
                $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
            }

            if (empty($err)) {
                $_SESSION['session_username'] = $username; // server
                $_SESSION['session_password'] = md5($password);
                $_SESSION['session_role'] = $r1['Role'];

                if ($ingataku == 1) {
                    $cookie_name = "cookie_username";
                    $cookie_value = $username;
                    $cookie_time = time() + (60 * 60 * 24 * 30);
                    setcookie($cookie_name, $cookie_value, $cookie_time, "/");

                    $cookie_name = "cookie_password";
                    $cookie_value = md5($password);
                    $cookie_time = time() + (60 * 60 * 24 * 30);
                    setcookie($cookie_name, $cookie_value, $cookie_time, "/");
                }

                // 2. Periksa role setelah login
                if ($_SESSION['session_role'] == 'admin') {
                    header("location: dashboard_admin.php"); // Redirect ke halaman dashboard admin
                } elseif ($_SESSION['session_role'] == 'karyawan') {
                    header("location: stasiun.php"); // Redirect ke halaman dashboard karyawan
                } elseif ($_SESSION['session_role'] == 'user') {
                    header("location: dashboard_user.php"); // Redirect ke halaman dashboard user
                } else {
                    // Role tidak dikenali, sesuaikan logika atau tindakan yang sesuai
                    echo "Role tidak valid!";
                }
            }
        } else {
            $err .= "<li>Username <b>$username</b> tidak tersedia.</li>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
</head>

<body>
    <div class="container my-4">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Login dan Masuk Ke Sistem</div>
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
                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input id="login-remember" type="checkbox" name="ingataku" value="1" <?php if ($ingataku == '1') echo "checked" ?>> Ingat Aku
                                </label>
                            </div>
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <div class="col-sm-12 controls">
                                <input type="submit" name="login" class="btn btn-success" value="Login" />
                                <button type="button" name="register" class="btn btn-primary" onclick="location.href='registrasi.php'">Registrasi Akun</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>