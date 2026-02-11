<?php
/**
* NIM   : 2357401007
* Nama  : Yusuf Hidayat 
* Kelas : MI23 
*/
?>

<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: user.php");
    exit;
}
$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM users WHERE id=$id");
header("Location: user.php");
exit;
?>
