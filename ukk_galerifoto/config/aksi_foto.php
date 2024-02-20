<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $albumid = $_POST['albumid'];
    $tanggalunggah = date('y-m-d');
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasiflle']['name'];
    $tmp = $_FILES['lokasifille']['tmp_name'];
    $lokasi = '../img/';
    $namafoto = rand().'-'.$foto;

    move_uploaded_file($tmp, $lokasi.$namafoto);

    $sql = mysqli_query($koneksi, "INSERT INTO foto VALUES('','$judulfoto','$deskripsifoto','$tanggalunggah','$namafoto','$albumid','$userid')");
    echo "<script>
    alert('Data Berhasil Disimpan');
    location.href='../admin/foto.php';
    </script>";

}
if (isset($_POST['edit'])) {
    $fotoid = $_POST['fotoid'];
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $albumid = $_POST['albumid'];
    $tanggalunggah = date('y-m-d');
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifille']['name'];
    $tmp = $_FILES['lokasifille']['tmp_name'];
    $lokasi = '../img/';
    $namafoto = rand().'-'.$foto;
    if ($foto == null) {
        $sql = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', albumid='$albumid' WHERE fotoid='$fotoid'");
    }
    else {
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
        $data = mysqli_fetch_array($query);
        if (is_file('../img' .$data['lokasifille'])) {
            unlink('../img' .$data['lokasifille']);
        }
        move_uploaded_file($tmp, $lokasi.$namafoto);
        $sql = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', lokasifille='$namafoto', albumid='$albumid' WHERE fotoid='$fotoid'");
    }
    echo "<script>
    alert('Data Berhasil Diperbarui');
    location.href='../admin/foto.php';
    </script>";
}
if (isset($_POST['hapus'])) {
    $fotoid = $_POST['fotoid'];
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
    $data = mysqli_fetch_array($query);
    if (is_file('../img' .$data['lokasifille'])) {
        unlink('../img' .$data['lokasifille']);
    }

    $sql = mysqli_query($koneksi, "DELETE FROM foto WHERE fotoid='$fotoid'");
    echo "<script>
    alert('Data Berhasil Dihapus');
    location.href='../admin/foto.php';
    </script>";
}