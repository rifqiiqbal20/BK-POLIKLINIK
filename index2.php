<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once("koneksi.php");
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POLIKLINIK</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/dfabc0038b.js" crossorigin="anonymous" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<style>
    .jumbotron {
        background: url('images/bg_admin.png') ;
        width: 1080px;
        height: 1080px;
        position: relative;
        
   
    
    }

</style>
<body>
  <nav class="navbar navbar-expand-lg navbar bg-primary">
    <div class="container">
      <a class="navbar-brand text-white" href="#">ADMIN</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index2.php">Home</a>
          </li>
          <?php
          if (isset($_SESSION['username'])) {
            //menu master jika user sudah login 
            ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index2.php?page=obat">Obat</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index2.php?page=dokter">Dokter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index2.php?page=poli">Poli</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index2.php?page=pasien">Pasien</a>
            </li>
            <?php
          }
          ?>
        </ul>
        <?php
        if (isset($_SESSION['username'])) {
          // Jika pengguna sudah login, tampilkan tombol "Logout"
          ?>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="logoutUser.php">Logout (
                <?php echo $_SESSION['username'] ?>)
              </a>
            </li>
          </ul>
          <?php
        } else {
          // Jika pengguna belum login, tampilkan tombol "Login" dan "Register"
          ?>
          <ul class="navbar-nav ms-auto">

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">Login</a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="index2.php?page=loginUser">Admin</a>
                </li>
                <li>
                  <a class="dropdown-item" href="index2.php?page=loginDokter">Dokter</a>
                </li>
              </ul>
            </li>
          </ul>
          <?php
        }
        ?>
      </div>
    </div>
  </nav>


  <main role="main" class="container">
    <?php
    if (isset($_GET['page'])) {
      include($_GET['page'] . ".php");
    } else {
      echo '<div class="jumbotron">';

      if (isset($_SESSION['username'])) {
        //jika sudah login tampilkan username
        echo ", " ;
      } else {
        echo "</h2><hr>Silakan Login untuk menggunakan sistem. Jika belum memiliki akun silakan Register terlebih dahulu.";
      }
    }
    ?>
  </main>

  