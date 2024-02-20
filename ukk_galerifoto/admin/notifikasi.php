<?php
session_start();
include '../config/koneksi.php';
$userid = $_SESSION['userid'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('anda belum login');
    location.href='../index.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sidebars.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
    

<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav me-auto">
                    <a href="home.php" class="nav-link">Home</a>
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">Foto</a>
                    <a href="notifikasi.php" class="nav-link">Notifikasi</a>

                </div>

                <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Logout</a>
            </div>
        </div>
    </nav>

<div class="container " style="width:100%; display:flex; align-items:center; justify-content:center;">
<div class="notification d-flex p-2"  >
 <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white ml-auto" style="width: 380px;">
    <div class="list-group list-group-flush border-bottom scrollarea">

      <?php

      $notifikasi = mysqli_query($koneksi,"SELECT * FROM likefoto JOIN user ON user.userid = likefoto.userid JOIN foto on foto.fotoid = likefoto.fotoid where foto.userid = '$userid' AND NOT likefoto.userid = '$userid'");
      while ($data_notif = mysqli_fetch_array($notifikasi)){?>
      <a href="#" class="list-group-item list-group-item-action py-3 lh-tight">
      
        <div class="d-flex w-100 align-items-center justify-content-between">
          <strong class="mb-1"><?php echo $data_notif['username']?> </strong>
          <small class="text-muted"><?php echo $data_notif['tanggallike']?></small>
        </div>
        <div class="col-10 mb-1 small">Menyukai Foto Anda</div>
      </a>
        <?php }?>

    </div>
        </div>                
</div>
</div>

</body>


<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/sidebars.js"></script>
</html>