<?php require_once __DIR__ . '/components/auth_check.php';
include "components/navbar.php"; ?>
<link rel="stylesheet" href="styles.css">

<div class="container">
  <h2>Datos de Seguridad</h2>

  <div class="form-box">
    <label>Seleccionar Casino</label>
    <select data-role="salas" data-target="seguridadData"></select>
  </div>

  <div id="seguridadData" class="info-box">
    <p class="small">Seleccione una sala para ver los datos de seguridad.</p>
  </div>
</div>

<script src="scripts.js"></script>
