<?php
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

if($method === 'GET'){
    if($action === 'list' || $action === ''){
        $stmt = $pdo->query('SELECT * FROM casinos ORDER BY id');
        $rows = $stmt->fetchAll();
        foreach($rows as &$r){
            if(isset($r['camaras'])) $r['camaras'] = json_decode($r['camaras'], true);
            if(isset($r['horarios'])) $r['horarios'] = json_decode($r['horarios'], true);
        }
        echo json_encode($rows, JSON_UNESCAPED_UNICODE);
        exit;
    }
    if($action === 'get' && isset($_GET['id'])){
        $stmt = $pdo->prepare('SELECT * FROM casinos WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $r = $stmt->fetch();
        if($r){
            $r['camaras'] = json_decode($r['camaras'], true);
            $r['horarios'] = json_decode($r['horarios'], true);
        }
        echo json_encode($r, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

if($method === 'POST'){
    // read posted json or form
    $input = $_POST;
    if(empty($input)){
        $raw = file_get_contents('php://input');
        $input = json_decode($raw, true) ?: [];
    }

    // create
    if($action === 'create'){
        $sql = 'INSERT INTO casinos (nombre,direccion,telefono_sala,lider_sala,technicians,policia,security_company,security_phone,security_email,security_notes,camaras,horarios) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $input['nombre'] ?? null,
            $input['direccion'] ?? null,
            $input['telefono_sala'] ?? null,
            $input['lider_sala'] ?? null,
            $input['technicians'] ?? null,
            $input['policia'] ?? null,
            $input['security_company'] ?? null,
            $input['security_phone'] ?? null,
            $input['security_email'] ?? null,
            $input['security_notes'] ?? null,
            isset($input['camaras']) ? json_encode($input['camaras'], JSON_UNESCAPED_UNICODE) : null,
            isset($input['horarios']) ? json_encode($input['horarios'], JSON_UNESCAPED_UNICODE) : null
        ]);
        echo json_encode(['success'=>true,'id'=>$pdo->lastInsertId()]);
        exit;
    }

    // update
    if($action === 'update' && isset($_GET['id'])){
        $sql = 'UPDATE casinos SET nombre=?,direccion=?,telefono_sala=?,lider_sala=?,technicians=?,policia=?,security_company=?,security_phone=?,security_email=?,security_notes=?,camaras=?,horarios=? WHERE id=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $input['nombre'] ?? null,
            $input['direccion'] ?? null,
            $input['telefono_sala'] ?? null,
            $input['lider_sala'] ?? null,
            $input['technicians'] ?? null,
            $input['policia'] ?? null,
            $input['security_company'] ?? null,
            $input['security_phone'] ?? null,
            $input['security_email'] ?? null,
            $input['security_notes'] ?? null,
            isset($input['camaras']) ? json_encode($input['camaras'], JSON_UNESCAPED_UNICODE) : null,
            isset($input['horarios']) ? json_encode($input['horarios'], JSON_UNESCAPED_UNICODE) : null,
            $_GET['id']
        ]);
        echo json_encode(['success'=>true]);
        exit;
    }

    // delete
    if($action === 'delete' && isset($_GET['id'])){
        $stmt = $pdo->prepare('DELETE FROM casinos WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        echo json_encode(['success'=>true]);
        exit;
    }
}

http_response_code(400);
echo json_encode(['error'=>'invalid_request']);
