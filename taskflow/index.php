<?php
require 'config/database.php';
$total_tarefas = $pdo->query('SELECT COUNT(*) FROM tarefas')->fetchColumn();

$andamento = $pdo->query(
    "SELECT COUNT(*) FROM tarefas WHERE status='Em andamento'"
)->fetchColumn();

$concluidas = $pdo->query(
    "SELECT COUNT(*) FROM tarefas WHERE status='Concluída'"
)->fetchColumn();

$abertos = $pdo->query(
    "SELECT COUNT(*) FROM chamados WHERE status='Aberto'"
)->fetchColumn();

$prioritarias = $pdo->query(
    "SELECT COUNT(*) FROM tarefas WHERE prioridade='Alta'"
)->fetchColumn();

$recentes = $pdo->query(
    'SELECT * FROM tarefas ORDER BY id DESC LIMIT 5'
)->fetchAll();

require 'includes/header.php';
?>

<div class="container">
    <h1>VISÃO GERAL</h1>
    <p>Dashboard - Organize atividades e acompanhe entregas.</p>

    <a href="nova_tarefa.php" class="btn btn-primary">+ Nova tarefa</a>

    <div class="row mt-4">
        <div class="col">
            <h3>Tarefas cadastradas</h3>
            <p><?php echo $total_tarefas; ?></p>
        </div>
        <div class="col">
            <h3>Em andamento</h3>
            <p><?php echo $andamento; ?></p>
        </div>
        <div class="col">
            <h3>Concluídas</h3>
            <p><?php echo $concluidas; ?></p>
        </div>
        <div class="col">
            <h3>Tarefas prioritárias (Alta)</h3>
            <p><?php echo $prioritarias; ?></p>
        </div>
        <div class="col">
            <h3>Chamados abertos</h3>
            <p><?php echo $abertos; ?></p>
        </div>
    </div>

    <hr>

    <h2>Tarefas recentes</h2>
    <a href="tarefas.php">Ver tarefas</a>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Tarefa</th>
                <th>Responsável</th>
                <th>Prioridade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentes as $tarefa): ?>
                <tr>
                    <td><?php echo htmlspecialchars($tarefa['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($tarefa['responsavel']); ?></td>
                    <td><?php echo htmlspecialchars($tarefa['prioridade']); ?></td>
                    <td><?php echo htmlspecialchars($tarefa['status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
