<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=teste;charset=utf8", "usuario", "senha");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = $pdo->prepare('DELETE FROM tarefas WHERE id = ?');
        $q->execute([$id]);

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        exit;
    }
}

header('Location: index.php');
exit;
?>
