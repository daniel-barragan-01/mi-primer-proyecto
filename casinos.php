<?php require_once __DIR__ . '/components/auth_check.php';
include "components/navbar.php"; ?>
<link rel="stylesheet" href="styles.css">

<div class="container">
  <h2>Información de Casinos</h2>

  <div class="form-box">
    <label>Seleccionar Casino</label>
    <select data-role="salas" data-target="casinoData"></select>
  </div>

  <div id="casinoData" class="info-box">
    <p class="small">Seleccione una sala para ver la información.</p>
  </div>
</div>

<script src="scripts.js"></script>
