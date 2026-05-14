<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Buscar Usuário Vulnerável</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Busca de Usuário por ID - Vulnerável</h1>
<p><a href="index.php">Voltar</a></p>

<form method="GET">
    <input type="text" name="id" placeholder="Digite o ID do usuário">
    <button type="submit">Buscar</button>
</form>

<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // VULNERÁVEL
    $sql = "SELECT id, nome, email, perfil FROM usuarios WHERE id = $id";

    echo "<h3>SQL gerado:</h3><pre class='codigo'>" . htmlspecialchars($sql) . "</pre>";

    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nome</th><th>Email</th><th>Perfil</th></tr>";
        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr><td>{$linha['id']}</td><td>" . htmlspecialchars($linha['nome']) . "</td><td>" . htmlspecialchars($linha['email']) . "</td><td>" . htmlspecialchars($linha['perfil']) . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='resultado erro'>Nenhum usuário encontrado.</div>";
    }
}
?>

<h2>Testes didáticos</h2>
<pre class="codigo">1
1 OR 1=1
1 ORDER BY 1
1 ORDER BY 2
1 ORDER BY 3
1 UNION SELECT 1, database(), user(), 'teste'</pre>
</div>
</body>
</html>
