<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Vulnerável</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Login Vulnerável</h1>
    <p><a href="index.php">Voltar</a></p>

    <form method="POST">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="senha" placeholder="Senha">
        <button type="submit">Entrar</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // VULNERÁVEL: concatena entrada do usuário diretamente no SQL.
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

    echo "<h3>SQL gerado:</h3><pre class='codigo'>" . htmlspecialchars($sql) . "</pre>";

    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        echo "<div class='resultado sucesso'>Login realizado como: <strong>" . htmlspecialchars($usuario["nome"]) . "</strong> (" . htmlspecialchars($usuario["perfil"]) . ")</div>";
    } else {
        echo "<div class='resultado erro'>Login ou senha inválidos.</div>";
    }
}
?>

    <h2>Teste didático</h2>
    <p>No campo email:</p>
    <pre class="codigo">admin@teste.com' OR '1'='1' #</pre>
    <p>Senha: qualquer coisa.</p>
</div>
</body>
</html>
