<?php require_once __DIR__ . '/components/auth_check.php';
include "components/navbar.php"; ?>
<link rel="stylesheet" href="styles.css">

<div class="container">
  <div class="header">
    <div>
      <h1>Panel Principal</h1>
      <p class="small">Sistema de Control Operativo y Seguridad para Casinos.</p>
    </div>
  </div>

  <div class="cards">
    <a class="card" href="casinos.php">Información de Casinos</a>
    <a class="card" href="seguridad.php">Datos de Seguridad</a>
    <a class="card" href="horarios.php">Control de Horarios</a>
    <a class="card" href="novedades.php">Registro de Novedades</a>
    <a class="card" href="reportes.php">Generar Reportes</a>
  </div>

  <div class="footer">CasinoControl © 2025</div>
</div>

<script src="scripts.js"></script>
