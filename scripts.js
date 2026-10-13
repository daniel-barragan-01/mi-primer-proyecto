/* scripts.js - handles front-end selects and autoload from embedded sample */

const STORAGE_KEY = 'casino_control_salas_v1';

let salas = [
  {"name":"Casino Verano Cajamarca","address":"Calle 7 Numero 6-04","leader":"José Ignacio / Laura Hernández","sala":"3174324367","technicians":"Cristian Góngora(3229224008); Jhan Moscoso(3154449809); Brandon Ortiz(3162514626); Joseph Valencia(3167955818); Yuli Rengifo(3174220928)","police":"3013460530","security":{"company":"COOVICOMBEIMA","phone":"3174236686","email":"coovicombeima@gmail.com","notes":"Don Leonardo es el único autorizado para cambios de clave."},"horarios":{"lt":{"ingreso":"08:30","apertura":"09:30","cierre":"00:00","salida":"01:00"},"vs":{"ingreso":"08:30","apertura":"09:30","cierre":"00:00","salida":"01:00"},"df":{"ingreso":"10:30","apertura":"12:00","cierre":"20:00","salida":"20:30"}},"camaras":[1,8,13,16]},
  {"name":"Casino Verano Acqua","address":"Cra 9 No. 57 - 24C CC Acqua (Loc 410) Hacienda Piedra Pintada","leader":"Salomón Espinoza","sala":"3162100520","technicians":"(no techs listed)","police":"6082685012","security":{"company":"COOVICOMBEIMA","phone":"3174236686","email":"coovicombeima@gmail.com","notes":"Don Leonardo es el único autorizado para cambios de clave."},"horarios":{"lt":{"ingreso":"09:00","apertura":"10:00","cierre":"12:00","salida":"01:00"},"vs":{"ingreso":"09:00","apertura":"10:00","cierre":"01:00","salida":"02:00"},"df":{"ingreso":"12:00","apertura":"13:30","cierre":"21:00","salida":"22:00"}},"camaras":[1,5,20,11]}
];

// load from localStorage if exists
function loadLocal(){
  const raw = localStorage.getItem(STORAGE_KEY);
  if(raw){
    try{
      const parsed = JSON.parse(raw);
      if(Array.isArray(parsed) && parsed.length>0) salas = parsed;
    }catch(e){ console.warn('error parsing storage', e); }
  }
}
loadLocal();

function fillSelects(){
  const selects = document.querySelectorAll('select[data-role="salas"]');
  selects.forEach(sel=>{
    sel.innerHTML = '<option value="">-- Seleccione --</option>';
    salas.forEach((s,idx)=>{
      const opt = document.createElement('option');
      opt.value = idx;
      opt.textContent = s.name;
      sel.appendChild(opt);
    });
  });
}

function showCasinoInfo(idx, targetId){
  const el = document.getElementById(targetId);
  if(idx === '' || idx === null) { el.innerHTML = '<p class="small">Seleccione una sala para ver la información.</p>'; return; }
  const s = salas[Number(idx)];
  if(!s) return;
  const cams = Array.isArray(s.camaras) ? s.camaras.join(', ') : s.camaras || '';
  el.innerHTML = `
    <h3>${s.name}</h3>
    <p><strong>Dirección:</strong> ${s.address}</p>
    <p><strong>Líder:</strong> ${s.leader} — <span class="small">Tel: ${s.sala}</span></p>
    <p><strong>Técnicos:</strong> ${s.technicians}</p>
    <p><strong>Policía:</strong> ${s.police}</p>
    <hr/>
    <h4>Seguridad</h4>
    <p><strong>Empresa:</strong> ${s.security.company} — ${s.security.phone}</p>
    <p><strong>Email:</strong> ${s.security.email}</p>
    <p class="small">${s.security.notes || ''}</p>
    <hr/>
    <h4>Horarios</h4>
    <div><strong>Lun-Jue:</strong> Ingreso ${s.horarios.lt.ingreso} • Apertura ${s.horarios.lt.apertura} • Cierre ${s.horarios.lt.cierre} • Salida ${s.horarios.lt.salida}</div>
    <div><strong>Vie-Sab:</strong> Ingreso ${s.horarios.vs.ingreso} • Apertura ${s.horarios.vs.apertura} • Cierre ${s.horarios.vs.cierre} • Salida ${s.horarios.vs.salida}</div>
    <div><strong>Dom-Fest:</strong> Ingreso ${s.horarios.df.ingreso} • Apertura ${s.horarios.df.apertura} • Cierre ${s.horarios.df.cierre} • Salida ${s.horarios.df.salida}</div>
    <hr/>
    <p><strong>Cámaras:</strong> ${cams}</p>
  `;
}

// auto-bind selects in pages when loaded
document.addEventListener('DOMContentLoaded', ()=> {
  fillSelects();
  // attach change listeners for any select with data-role="salas"
  document.querySelectorAll('select[data-role="salas"]').forEach(sel=>{
    sel.addEventListener('change', (e)=>{
      const target = sel.getAttribute('data-target') || 'casinoData';
      showCasinoInfo(e.target.value, target);
    });
  });
});
