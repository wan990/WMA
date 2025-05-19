<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Peramalan Penjualan - WMA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100"> <!-- Tambahan: flex layout -->
<main class="flex-grow-1"> <!-- Mulai main area -->

<div class="container mt-3">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded shadow-sm mb-4 px-3">
    <a class="navbar-brand fw-bold text-white" href="#">
      <i class="bi bi-graph-up-arrow"></i> WMA Forecast
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="beranda.php"><i class="bi bi-house-door-fill"></i> Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="input.php"><i class="bi bi-pencil-square"></i> Input Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="hitung.php"><i class="bi bi-calculator"></i> Hitung Peramalan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="hasil.php"><i class="bi bi-bar-chart-line-fill"></i> Hasil Peramalan</a>
        </li>
      </ul>
    </div>
  </nav>
