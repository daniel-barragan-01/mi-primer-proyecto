<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$msg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$u]);
    $user = $stmt->fetch();
    if($user && password_verify($p, $user['password_hash'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: /index.php');
        exit;
    } else {
        $msg = 'Credenciales inválidas';
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Login</title><link rel="stylesheet" href="/styles.css"></head>
<body>
<div class="container" style="max-width:420px;margin-top:60px">
  <div class="form-box">
    <h2>Iniciar sesión</h2>
    <?php if($msg): ?><p style="color:#b91c1c"><?=$msg?></p><?php endif; ?>
    <form method="post">
      <label>Usuario</label>
      <input name="username" required>
      <label>Contraseña</label>
      <input type="password" name="password" required>
      <button class="btn" type="submit">Entrar</button>
    </form>
  </div>
</div>
</body></html>
