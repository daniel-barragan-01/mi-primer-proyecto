<?php require_once __DIR__ . '/components/auth_check.php';
include "components/navbar.php"; ?>
<link rel="stylesheet" href="styles.css">

<div class="container">
  <h2>Control de Horarios</h2>

  <div class="form-box">
    <label>Seleccionar Casino</label>
    <select data-role="salas" data-target="horarioData"></select>

    <form id="formHorario" style="margin-top:12px;">
      <label>Fecha</label>
      <input type="date" id="fechaControl">

      <label>Ingreso Real</label>
      <input type="time" id="ingresoReal">

      <label>Apertura Personal Real</label>
      <input type="time" id="apPersonalReal">

      <label>Apertura Público Real</label>
      <input type="time" id="apPublicoReal">

      <label>Salida Personal Real</label>
      <input type="time" id="salidaReal">

      <label>Responsable</label>
      <input type="text" id="responsableHorario">

      <button class="btn" type="button" onclick="alert('Guardaría el registro en backend (pendiente)')">Guardar Registro</button>
    </form>
  </div>

  <div id="horarioData" class="info-box">
    <p class="small">Horario estándar del casino aparecerá aquí.</p>
  </div>
</div>

<script src="scripts.js"></script>
