<?php
require 'init.php';
$user = new user();
$user->cekUserSession();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilkoom Stock Manager</title>
    <link rel="icon" href="img/favicon.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" id="main-navbar">
        <a class="navbar-brand" href="#">Hello, <?php $username=  $_SESSION['username']; echo ucwords($username);?></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'tampil_barang.php' ? 'active' : "";?>"
                        href="tampil_barang.php">Tabel Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'tambah_barang.php' ? 'active' : "";?>"" href="
                        tambah_barang.php">Tambah Barang</a>
                </li>
            </ul>
            <div class="btn-group">
                <button class="btn btn-dark dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown">
                    Profile
                </button>
                <div class="dropdown-menu dropdown-menu-right ">
                    <!-- <h6 class="dropdown-header">Section header</h6> -->
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>