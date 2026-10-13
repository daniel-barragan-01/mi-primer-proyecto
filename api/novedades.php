<?php
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

if($method === 'GET'){
    if($action === 'list' || $action === ''){
        $stmt = $pdo->query('SELECT n.*, c.nombre as casino_nombre FROM novedades n JOIN casinos c ON n.casino_id = c.id ORDER BY n.id DESC');
        $rows = $stmt->fetchAll();
        echo json_encode($rows, JSON_UNESCAPED_UNICODE);
        exit;
    }
    if($action === 'get' && isset($_GET['id'])){
        $stmt = $pdo->prepare('SELECT * FROM novedades WHERE id = ?');
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
        $sql = 'INSERT INTO novedades (casino_id,fecha,tipo,descripcion,responsable,evidencia,uniformidad,conclusion) VALUES (?,?,?,?,?,?,?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $input['casino_id'] ?? null,
            $input['fecha'] ?? null,
            $input['tipo'] ?? null,
            $input['descripcion'] ?? null,
            $input['responsable'] ?? null,
            $input['evidencia'] ?? null,
            $input['uniformidad'] ?? null,
            $input['conclusion'] ?? null
        ]);
        echo json_encode(['success'=>true,'id'=>$pdo->lastInsertId()]);
        exit;
    }

    if($action === 'update' && isset($_GET['id'])){
        $sql = 'UPDATE novedades SET casino_id=?,fecha=?,tipo=?,descripcion=?,responsable=?,evidencia=?,uniformidad=?,conclusion=? WHERE id=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $input['casino_id'] ?? null,
            $input['fecha'] ?? null,
            $input['tipo'] ?? null,
            $input['descripcion'] ?? null,
            $input['responsable'] ?? null,
            $input['evidencia'] ?? null,
            $input['uniformidad'] ?? null,
            $input['conclusion'] ?? null,
            $_GET['id']
        ]);
        echo json_encode(['success'=>true]);
        exit;
    }

    if($action === 'delete' && isset($_GET['id'])){
        $stmt = $pdo->prepare('DELETE FROM novedades WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        echo json_encode(['success'=>true]);
        exit;
    }
}

http_response_code(400);
echo json_encode(['error'=>'invalid_request']);
