<?php
require_once __DIR__ . '/../config/db.php';
$action = $_GET['action'] ?? '';

if($action === 'novedades_csv'){
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=novedades.csv');
    $out = fopen('php://output','w');
    fputcsv($out, ['id','casino','fecha','tipo','descripcion','responsable','evidencia','uniformidad','conclusion','created_at']);
    $stmt = $pdo->query('SELECT n.*, c.nombre as casino FROM novedades n JOIN casinos c ON n.casino_id = c.id ORDER BY n.id DESC');
    while($r = $stmt->fetch()){
        fputcsv($out, [$r['id'],$r['casino'],$r['fecha'],$r['tipo'],$r['descripcion'],$r['responsable'],$r['evidencia'],$r['uniformidad'],$r['conclusion'],$r['created_at']]);
    }
    exit;
}

if($action === 'novedades_xls'){
    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    header('Content-Disposition: attachment; filename=novedades.xls');
    $rows = [];
    $stmt = $pdo->query('SELECT n.*, c.nombre as casino FROM novedades n JOIN casinos c ON n.casino_id = c.id ORDER BY n.id DESC');
    echo "<table border=1>";
    echo "<tr><th>ID</th><th>Casino</th><th>Fecha</th><th>Tipo</th><th>Descripcion</th><th>Responsable</th></tr>";
    while($r = $stmt->fetch()){
        echo '<tr>';
        echo '<td>'.htmlspecialchars($r['id']).'</td>';
        echo '<td>'.htmlspecialchars($r['casino']).'</td>';
        echo '<td>'.htmlspecialchars($r['fecha']).'</td>';
        echo '<td>'.htmlspecialchars($r['tipo']).'</td>';
        echo '<td>'.htmlspecialchars($r['descripcion']).'</td>';
        echo '<td>'.htmlspecialchars($r['responsable']).'</td>';
        echo '</tr>';
    }
    echo "</table>";
    exit;
}

if($action === 'novedades_print'){
    // printable HTML (user can save as PDF using browser Print)
    $stmt = $pdo->query('SELECT n.*, c.nombre as casino FROM novedades n JOIN casinos c ON n.casino_id = c.id ORDER BY n.id DESC');
    ?>
    <!doctype html><html><head><meta charset="utf-8"><title>Reporte Novedades</title>
    <style>body{font-family:Arial;padding:20px} .item{margin-bottom:18px;border-bottom:1px solid #ddd;padding-bottom:8px}</style>
    </head><body>
    <h1>Reporte de Novedades</h1>
    <?php while($r = $stmt->fetch()): ?>
      <div class="item">
        <h3><?=htmlspecialchars($r['tipo'])?> — <?=htmlspecialchars($r['casino'])?></h3>
        <div><strong>Fecha:</strong> <?=htmlspecialchars($r['fecha'])?></div>
        <div><strong>Promotor:</strong> <?=htmlspecialchars($r['responsable'])?></div>
        <div><strong>Descripción:</strong><div><?=nl2br(htmlspecialchars($r['descripcion']))?></div></div>
      </div>
    <?php endwhile; ?>
    </body></html>
    <?php
    exit;
}

http_response_code(400);
echo 'Invalid action';
