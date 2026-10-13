<?php
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

if($method === 'GET'){
    if($action === 'list' || $action === ''){
        $stmt = $pdo->query('SELECT ch.*, c.nombre as casino_nombre FROM control_horarios ch JOIN casinos c ON ch.casino_id = c.id ORDER BY ch.id DESC');
        $rows = $stmt->fetchAll();
        echo json_encode($rows, JSON_UNESCAPED_UNICODE);
        exit;
    }
    if($action === 'get' && isset($_GET['id'])){
        $stmt = $pdo->prepare('SELECT * FROM control_horarios WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        echo json_encode($stmt->fetch(), JSON_UNESCAPED_UNICODE);
        exit;
    }
}

if($method === 'POST'){
    $input = $_POST;
    if(empty($input)){
        $raw = file_get_contents('php://input');
        $input = json_decode($raw, true) ?: [];
    }

    if($action === 'create'){
        $sql = 'INSERT INTO control_horarios (casino_id,fecha,tipo,hora_ingreso,hora_apertura_publico,hora_apertura_personal,hora_salida,responsable,observaciones) VALUES (?,?,?,?,?,?,?,?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $input['casino_id'] ?? null,
            $input['fecha'] ?? null,
            $input['tipo'] ?? 'casino',
            $input['hora_ingreso'] ?? null,
            $input['hora_apertura_publico'] ?? null,
            $input['hora_apertura_personal'] ?? null,
            $input['hora_salida'] ?? null,
            $input['responsable'] ?? null,
            $input['observaciones'] ?? null
        ]);
        echo json_encode(['success'=>true,'id'=>$pdo->lastInsertId()]);
        exit;
    }

    if($action === 'update' && isset($_GET['id'])){
        $sql = 'UPDATE control_horarios SET casino_id=?,fecha=?,tipo=?,hora_ingreso=?,hora_apertura_publico=?,hora_apertura_personal=?,hora_salida=?,responsable=?,observaciones=? WHERE id=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $input['casino_id'] ?? null,
            $input['fecha'] ?? null,
            $input['tipo'] ?? 'casino',
            $input['hora_ingreso'] ?? null,
            $input['hora_apertura_publico'] ?? null,
            $input['hora_apertura_personal'] ?? null,
            $input['hora_salida'] ?? null,
            $input['responsable'] ?? null,
            $input['observaciones'] ?? null,
            $_GET['id']
        ]);
        echo json_encode(['success'=>true]);
        exit;
    }

    if($action === 'delete' && isset($_GET['id'])){
        $stmt = $pdo->prepare('DELETE FROM control_horarios WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        echo json_encode(['success'=>true]);
        exit;
    }
}

http_response_code(400);
echo json_encode(['error'=>'invalid_request']);
