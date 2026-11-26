<?php
require 'config/database.php';

$total_tarefas = $pdo->query('SELECT COUNT(*) FROM tarefas')->fetchColumn();
$andamento = $pdo->query("SELECT COUNT(*) FROM tarefas WHERE status='Em andamento'")->fetchColumn();
$concluidas = $pdo->query("SELECT COUNT(*) FROM tarefas WHERE status='Concluída'")->fetchColumn();
$abertos = $pdo->query("SELECT COUNT(*) FROM chamados WHERE status='Aberto'")->fetchColumn();
$prioritarias = $pdo->query("SELECT COUNT(*) FROM tarefas WHERE prioridade='Alta'")->fetchColumn();
$recentes = $pdo->query('SELECT * FROM tarefas ORDER BY id DESC LIMIT 5')->fetchAll();

$pageTitle = 'Visão geral';
require 'includes/header.php';
?>

<div class="dashboard">
    <div class="head dashboard-head">
        <div>
            <p class="eyebrow">Painel principal</p>
            <h1>Visão geral</h1>
            <p class="muted">Organize atividades e acompanhe suas entregas.</p>
        </div>

        <a href="tarefas/form.php" class="btn"><span aria-hidden="true">＋</span> Nova tarefa</a>
    </div>

    <section class="stats" aria-label="Resumo das atividades">
        <article class="stat">
            <span class="stat-label">Tarefas cadastradas</span>
            <strong class="num"><?= $total_tarefas ?></strong>
        </article>
        <article class="stat">
            <span class="stat-label">Em andamento</span>
            <strong class="num"><?= $andamento ?></strong>
        </article>
        <article class="stat">
            <span class="stat-label">Concluídas</span>
            <strong class="num"><?= $concluidas ?></strong>
        </article>
        <article class="stat">
            <span class="stat-label">Prioritárias</span>
            <strong class="num"><?= $prioritarias ?></strong>
        </article>
        <article class="stat">
            <span class="stat-label">Chamados abertos</span>
            <strong class="num"><?= $abertos ?></strong>
        </article>
    </section>

    <section class="panel recent-panel">
        <div class="head recent-head">
            <div>
                <p class="eyebrow">Atualizações recentes</p>
                <h2>Tarefas recentes</h2>
            </div>
            <a href="tarefas/index.php" class="text-link">Ver todas <span aria-hidden="true">→</span></a>
        </div>

        <div class="scroll">
            <table>
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
                            <td><strong><?= htmlspecialchars($tarefa['titulo']) ?></strong></td>
                            <td><?= htmlspecialchars($tarefa['responsavel']) ?></td>
                            <td><span class="priority priority-<?= strtolower($tarefa['prioridade']) ?>"><?= htmlspecialchars($tarefa['prioridade']) ?></span></td>
                            <td><span class="status status-<?= str_replace([' ', 'í', 'Í'], ['-', 'i', 'i'], strtolower($tarefa['status'])) ?>"><?= htmlspecialchars($tarefa['status']) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php require 'includes/footer.php'; ?>
