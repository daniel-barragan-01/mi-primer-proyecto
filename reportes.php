<?php require_once __DIR__ . '/components/auth_check.php';
include "components/navbar.php"; ?>
<link rel="stylesheet" href="styles.css">

<div class="container">
  <h2>Reportes</h2>

  <div class="cards">
    <div class="card" onclick="alert('Exportar novedades a PDF (pendiente)')">Reporte de Novedades - PDF / Excel</div>
    <div class="card" onclick="alert('Exportar control horarios (pendiente)')">Control de Horarios - PDF / Excel</div>
    <div class="card" onclick="alert('Generar consolidado mensual (pendiente)')">Informe General Mensual</div>
  </div>
</div>

<script src="scripts.js"></script>
