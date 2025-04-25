<?php
require 'config.php';

// Fetch tasks with user names
$stmt = $pdo->query(
  "SELECT t.id, t.title, t.due_date, t.status, u.name
   FROM tasks t JOIN users u ON t.user_id=u.id
   ORDER BY t.created_at DESC"
);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Task Manager</h1>
        <a href="add_task.php" class="btn btn-primary mb-3">Add New Task</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Assigned To</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['title']) ?></td>
                        <td><?= htmlspecialchars($task['name']) ?></td>
                        <td><?= htmlspecialchars($task['due_date']) ?></td>
                        <td><span class="badge bg-<?= $task['status'] === 'completed' ? 'success' : ($task['status'] === 'overdue' ? 'danger' : 'warning') ?>">
                            <?= htmlspecialchars($task['status']) ?>
                        </span></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($tasks)): ?>
                    <tr>
                        <td colspan="4" class="text-center">No tasks found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Example of nested subquery usage -->
        <div class="mt-4">
            <h3>Users with Above Average Task Count</h3>
            <?php
            $stmt = $pdo->query("
                SELECT u.id, u.name,
                    (SELECT COUNT(*) FROM tasks t WHERE t.user_id = u.id) AS task_count
                FROM users u
                WHERE (SELECT COUNT(*) FROM tasks t WHERE t.user_id = u.id)
                    > (
                        SELECT AVG(cnt) FROM (
                            SELECT COUNT(*) AS cnt FROM tasks GROUP BY user_id
                        ) AS sub
                    )
            ");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <ul class="list-group">
                <?php foreach($users as $user): ?>
                    <li class="list-group-item">
                        <?= htmlspecialchars($user['name']) ?> 
                        (<?= $user['task_count'] ?> tasks)
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
