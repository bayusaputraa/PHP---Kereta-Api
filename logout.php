<!-- loguout.php -->

<?php
/**
 * Nama File: logout.php
 * Deskripsi: Ini adalah halaman untuk menanyakan apakah admin/user yakin keluar dan mengakhiri season.
 * Author: Bayu Saputra & Amrizal Mustakim
 * Dibuat pada: 19/12/23
 */


session_start();
$_SESSION['session_username'] = "";
$_SESSION['session_password'] = "";
session_destroy();

$cookie_name = "cookie_username";
$cookie_value = "";
$time = time() - (60 * 60);
setcookie($cookie_name, $cookie_value, $time, "/");

$cookie_name = "cookie_password";
$cookie_value = "";
$time = time() - (60 * 60);
setcookie($cookie_name, $cookie_value, $time, "/");

header("location:index.php");
