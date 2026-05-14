<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos Vulnerável</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Pesquisa de Produtos - Vulnerável</h1>
<p><a href="index.php">Voltar</a></p>

<form method="GET">
    <input type="text" name="busca" placeholder="Digite o nome do produto">
    <button type="submit">Pesquisar</button>
</form>

<?php
if (isset($_GET["busca"])) {
    $busca = $_GET["busca"];

    // VULNERÁVEL
    $sql = "SELECT id, nome, categoria, preco FROM produtos WHERE nome LIKE '%$busca%'";

    echo "<h3>SQL gerado:</h3><pre class='codigo'>" . htmlspecialchars($sql) . "</pre>";

    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Produto</th><th>Categoria</th><th>Preço</th></tr>";
        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr><td>{$linha['id']}</td><td>" . htmlspecialchars($linha['nome']) . "</td><td>" . htmlspecialchars($linha['categoria']) . "</td><td>R$ {$linha['preco']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='resultado erro'>Nenhum produto encontrado.</div>";
    }
}
?>

<h2>Testes didáticos</h2>
<pre class="codigo">' OR '1'='1' #
%' OR '1'='1' #
%' UNION SELECT id, nome, email, perfil FROM usuarios #</pre>
</div>
</body>
</html>
