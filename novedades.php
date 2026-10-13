<?php require_once __DIR__ . '/components/auth_check.php';
include "components/navbar.php"; ?>
<link rel="stylesheet" href="styles.css">

<div class="container">
  <h2>Registro de Novedades</h2>

  <div class="form-box">
    <label>Casino</label>
    <select data-role="salas" data-target="datosAuto"></select>

    <label>Fecha</label>
    <input type="date" id="fechaNovedad">

    <label>Hora</label>
    <input type="time" id="horaNovedad">

    <label>Promotora / Operador</label>
    <input type="text" id="promotor">

    <label>Tipo de Novedad</label>
    <select id="tipoNovedad">
      <option>Uniformidad</option>
      <option>Apertura</option>
      <option>Cierre</option>
      <option>Técnica</option>
      <option>Robo</option>
      <option>Administrativa</option>
      <option>Otra</option>
    </select>

    <label>Descripción</label>
    <textarea id="descripcionNovedad"></textarea>

    <label>Evidencia (archivo)</label>
    <input type="file" id="evidenciaNovedad">

    <label>Conclusión / Recomendación</label>
    <textarea id="conclusionNovedad"></textarea>

    <button class="btn" type="button" onclick="alert('Guardar novedad en backend (pendiente)')">Guardar Novedad</button>
  </div>

  <div id="datosAuto" class="info-box">
    <p class="small">Información de sala que se autocompleta aquí.</p>
  </div>
</div>

<script src="scripts.js"></script>
