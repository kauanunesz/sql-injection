<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criptografia Hash</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Cadastro - Criptografia hash</h1>
    <p><a href="index.php">Voltar</a></p>

    <form method="POST">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="senha" placeholder="Senha">
        <input type="password" name="confirmarSenha" placeholder="Confirmar Senha">
        <button type="submit">Entrar</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmarSenha = $_POST["confirmarSenha"];
    if ($senha !== $confirmarSenha)
    {
        echo "<div class='resultado erro'>Senhas não coincidem</div>";
        exit;
    }
    else
    {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
        $sql->bind_param("ss", $email, $senhaHash);
        
        if ($sql->execute()) {
            echo "<div class='resultado sucesso'>Cadastro realizado com sucesso!</div>";
        } else {
            if ($conn->errno == 1062) {
                echo "<div class='resultado erro'>Este email já está cadastrado.</div>";
            } else {
                echo "<div class='resultado erro'>Erro ao cadastrar usuário.</div>";
            }
        }
}
}
?>

    <h2>Teste didático</h2>
</div>

</body>
</html>
